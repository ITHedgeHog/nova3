<?php namespace Nova\Settings\Http\Controllers;

use Controller;
use Nova\Settings\Settings;

class SettingsController extends Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->middleware('auth');

		$this->views('admin', 'structure|template');
	}

	public function index()
	{
		$this->authorize('manage', new Settings);

		$this->pageTitle = 'Settings';

		$this->views('settings.settings', 'page|script');

		$this->data->settings = Settings::get()->pluck('value', 'key');
	}

	public function update()
	{
		$this->renderWithTheme = false;

		$this->authorize('update', new Settings);

		updater(Settings::class)->with(request()->all())->updateAll();

		return response(200);
	}
}
