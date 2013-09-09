<?php namespace Nova\Core\Controllers\Base;

/**
 * All controllers in admin sections of Nova extend from this base controller. 
 * This class is responsible for filling the template with the information 
 * that's often section specific, including setting up the navigation.
 *
 * DO NOT EDIT THIS FILE!
 *
 * @package		Nova
 * @subpackage	Core
 * @category	Controllers
 * @author		Anodyne Productions
 * @copyright	2013 Anodyne Productions
 */

use App;
use Nova;
use View;
use Sentry;
use Session;
use Location;
use Redirect;
use ErrorCode;
use SiteContent;
use BaseController;

abstract class Admin extends BaseController {

	public function __construct()
	{
		parent::__construct();

		/**
		 * Before any of the before filters run, check to make sure the user is
		 * logged in. If they aren't, send them over to the log in page.
		 */
		if ( ! Sentry::check())
		{
			/**
			 * Before filter that redirects if the user isn't logged in.
			 */
			$this->beforeFilter(function()
			{
				// Put the intended desintation into the session
				Session::put('url.intended', App::make('url')->full());

				return Redirect::to('login/error/'.ErrorCode::LOGIN_NOT_LOGGED_IN);
			});
		}
		else
		{
			// Get a copy of the controller
			$me = $this;

			/**
			 * Before filter that populates some of the variables with data.
			 */
			$this->beforeFilter(function() use(&$me)
			{
				// Set the variables
				$me->skin		= $me->currentUser->getPreferenceItem('skin_admin');
				$me->rank		= ($me->currentUser->getPreferenceItem('rank')) ?: $me->settings->rank;
				$me->icons		= Nova::getIconIndex($me->skin);
				$me->timezone	= ($me->currentUser->getPreferenceItem('timezone')) ?: $me->settings->timezone;

				// Resolve the catalog repository interface
				$skin = $me->resolveBinding('CatalogRepositoryInterface');

				// Get the skin section info
				$me->_skinInfo = $skin->findSkinByLocation($me->skin);

				// Build the navigation
				$me->nav->setStyle($me->_skinInfo->nav)
					->setSection('admin')
					->setCategory('admin')
					->setType('main');

				if (Sentry::check())
				{
					// Has the user's role been updated since their last login?
					$lastLogin = $me->currentUser->last_login->diffInMinutes($me->currentUser->role->updated_at, false);
					$lastUpdate = $me->currentUser->updated_at->diffInMinutes($me->currentUser->role->updated_at, false);

					if ($lastLogin > 0 and $lastUpdate > 0)
					{
						# TODO: remove this once we've verified it's working right
						\Log::info("Session updated (Last Login: {$lastLogin}) (Last Update: {$lastUpdate})");

						// Clear the access info from the session
						Session::forget('role');

						// Update the access info in the session
						$me->currentUser->getPermissions();
					}
				}
			});
		}
	}

	/**
	 * Setup the layout.
	 *
	 * @return	void
	 */
	protected function setupLayout()
	{
		// Set the values to be passed to the structure
		$vars = [
			'skin'		=> $this->skin,
			'skinInfo'	=> $this->_skinInfo,
			'section'	=> 'admin',
			'settings'	=> $this->settings,
		];

		// Setup the layout and its data
		$layout				= View::make(Location::structure('admin'))->with($vars);
		$layout->title		= $this->settings->sim_name.' &bull; ';
		$layout->javascript	= false;
		
		// Setup the template and its data
		$layout->template			= View::make(Location::template('admin'))->with($vars);
		$layout->template->ajax		= false;
		$layout->template->flash	= false;
		$layout->template->content	= false;
		$layout->template->header	= false;
		$layout->template->message	= false;
		$layout->template->navmain	= $this->nav->build();
		
		// Setup the subnav and widgets
		$layout->template->navsub			= View::make(Location::partial('navsub'));
		$layout->template->navsub->menu		= false;
		$layout->template->navsub->widget1	= false;
		$layout->template->navsub->widget2	= false;
		$layout->template->navsub->widget3	= false;

		// Setup the footer
		$layout->template->footer			= View::make(Location::partial('footer'));
		$layout->template->footer->extra	= $this->content->findByKey('other.footer');

		// Pass everything back to the layout
		$this->layout = $layout;
	}

}