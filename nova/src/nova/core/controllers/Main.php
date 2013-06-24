<?php namespace Nova\Core\Controllers;

/**
 * Controller that handles requests for the "main" section of Nova.
 *
 * @package		Nova
 * @subpackage	Core
 * @category	Controller
 * @author		Anodyne Productions
 * @copyright	2013 Anodyne Productions
 */

use Markdown;
use SiteContent;
use MainBaseController;

class Main extends MainBaseController {

	public function __construct()
	{
		parent::__construct();

		// Get a copy of the controller
		$me = $this;

		// Do the final nav setup
		$this->beforeFilter(function() use(&$me)
		{
			if ( ! $me->_stopExecution)
			{
				if ($me->_sectionInfo->nav == 'classic')
				{
					// Set the type and category
					$me->nav->setType('sub')->setCategory('main');

					// Build the menu
					$me->layout->template->navsub->menu = $me->nav->build();
				}
			}
		});
	}

	public function getIndex()
	{
		// Set the view
		$this->_view = 'main/index';
	}

	public function getCredits()
	{
		// Set the view
		$this->_view = 'main/credits';

		// Get the permanent credits
		$this->_data->permanentCredits = Markdown::parse(SiteContent::getContentItem('credits_perm'));
	}

}