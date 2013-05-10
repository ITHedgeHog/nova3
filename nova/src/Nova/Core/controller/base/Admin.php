<?php namespace Nova\Core\Controller\Base;

/**
 * All controllers in admin sections of Nova extend from this base controller. 
 * This class is responsible for filling the template with the information 
 * that's often section specific, including setting up the navigation.
 *
 * DO NOT EDIT THIS FILE!
 *
 * @package		Nova
 * @subpackage	Core
 * @category	Controller
 * @author		Anodyne Productions
 * @copyright	2013 Anodyne Productions
 */

use View;
use Sentry;
use Utility;
use Location;
use Redirect;
use SiteContent;
use BaseController;
use SkinSectionCatalog;

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
				return Redirect::to('login/index/'.\Nova\Core\Controller\Login::NOT_LOGGED_IN);
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
				// Get the current user
				$user = Sentry::getUser();

				// Set the variables
				$me->skin		= $user->getPreferenceItem('skin_admin');
				$me->rank		= ($user->getPreferenceItem('rank')) ?: $me->settings->rank;
				$me->timezone	= ($user->getPreferenceItem('timezone')) ?: $me->settings->timezone;
				$me->icons		= Utility::getIconIndex($me->skin);

				// Get the skin section info
				$me->_sectionInfo = SkinSectionCatalog::getItem($me->skin, 'skin');

				// Build the navigation
				$me->nav->setStyle($me->_sectionInfo->nav)
					->setSection('admin')
					->setCategory('admin')
					->setType('main');
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
			'section'	=> 'admin',
			'settings'	=> $this->settings,
		];

		// Setup the layout and its data
		$layout				= View::make(Location::file('admin', $this->skin, 'structure'))->with($vars);
		$layout->title		= $this->settings->sim_name.' :: ';
		$layout->javascript	= false;
		
		// Setup the template and its data
		$layout->template			= View::make(Location::file('admin', $this->skin, 'template'))->with($vars);
		$layout->template->ajax		= false;
		$layout->template->flash	= false;
		$layout->template->content	= false;
		$layout->template->header	= false;
		$layout->template->message	= false;
		$layout->template->navmain	= $this->nav->build();
		
		// Setup the subnav and widgets
		$layout->template->navsub			= View::make(Location::file('navsub', $this->skin, 'partial'));
		$layout->template->navsub->menu		= false;
		$layout->template->navsub->widget1	= false;
		$layout->template->navsub->widget2	= false;
		$layout->template->navsub->widget3	= false;

		// Setup the footer
		$layout->template->footer			= View::make(Location::file('footer', $this->skin, 'partial'));
		$layout->template->footer->extra	= SiteContent::getContentItem('footer');

		// Pass everything back to the layout
		$this->layout = $layout;
	}

}