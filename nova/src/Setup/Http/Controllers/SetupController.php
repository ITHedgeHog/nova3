<?php namespace Nova\Setup\Http\Controllers;

use Artisan;
use Illuminate\Filesystem\{Filesystem, FilesystemManager};

class SetupController extends BaseController {

	public function index()
	{
		// Is Nova installed?
		$installed = nova()->isInstalled();

		// Is there an update available for Nova?
		$update = nova()->hasUpdate();

		return view('pages.setup.index', compact('installed', 'update'));
	}

	public function environment()
	{
		// Check the environment
		$env = nova()->checkEnvironment();

		// If everything checks out, head to the Setup Center
		if ($env->get('passes'))
		{
			return redirect()->route('setup.home');
		}

		return view('pages.setup.environment', compact('env'));
	}

	public function uninstall(FilesystemManager $storage, Filesystem $files)
	{
		// Clear the cache
		$storage->disk('local')->delete('installed.json');

		// Clear the routes in production
		if (app('env') == 'production')
		{
			Artisan::call('route:clear');
		}

		// Reset the database
		Artisan::call('migrate:reset', ['--force' => true]);

		// Remove the config files
		$files->delete(config_path('app.php'));
		$files->delete(config_path('database.php'));
		$files->delete(config_path('mail.php'));
		$files->delete(config_path('services.php'));
		$files->delete(config_path('session.php'));

		// Remove the SQLite database if it's there
		if ($files->exists(config('database.connections.sqlite.database')))
		{
			$files->delete(config('database.connections.sqlite.database'));
		}

		// Set the flash message
		flash()->success(config('nova.app.name')." has been removed!");

		return redirect()->route('setup.home');
	}
}
