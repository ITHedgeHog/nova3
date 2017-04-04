<?php namespace Nova\Foundation\Http\Controllers;

use Str;
use stdClass;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class NovaController extends Controller
{
	use DispatchesJobs, ValidatesRequests;

	public $app;
	public $data;
	public $page;
	public $user;
	public $theme;
	public $views;
	public $content;
	public $metadata;
	public $settings;
	public $templateData;
	public $structureData;

	public $isAdmin = false;
	public $isAjax = false;

	public function __construct()
	{
		$this->app				= app();
		$this->data				= new stdClass;
		$this->metadata			= collect();
		$this->templateData 	= new stdClass;
		$this->structureData	= new stdClass;

		// Setup the views collection
		$this->views = collect([
			'scripts'	=> [],
			'structure'	=> 'public',
			'styles'	=> [],
			'template'	=> 'public',
		]);

		// Bind a reference to the current controller so that we can use that
		// data from within the template rendering middleware
		$this->app->instance('nova.controller', $this);

		// Setup the controller
		$this->setupController();

		// Setup the metadata
		$this->setMetadata();

		// Set up the user on the controller instance
		$this->middleware(function ($request, $next) {
			$this->user = user();

			return $next($request);
		});

		// Make sure Nova is installed
		$this->middleware('nova.installed');

		// Process the controller and render it to the response
		$this->middleware('nova.render');
	}

	/**
	 * We don't use Laravel's AuthorizesRequest trait because we want to do a
	 * few special things to make sure unauthorized requests are logged in a
	 * few different places.
	 */
	protected function authorize($ability, $arguments = [], $message = null)
	{
		if ($this->user->cannot($ability, $arguments)) {
			$this->errorUnauthorized($message);
		}
	}

	public function errorNotFound($message = null)
	{
		$logMessage = ($this->user)
			? $this->user->name
			: "An unauthenticated user";

		$logMessage.= " attempted to access ".request()->fullUrl();

		app('log')->warning($logMessage);

		if (request()->ajax()) {
			return response()->json([
				'status'	=> 404,
				'message'	=> $message,
			]);
		}

		abort(404, $message);
	}

	public function errorUnauthorized($message = null)
	{
		$logMessage = ($this->user)
			? $this->user->name
			: "An unauthenticated user";

		$logMessage.= " attempted to access ".request()->fullUrl();

		app('log')->warning($logMessage);

		nova_event();

		if (request()->ajax()) {
			return response()->json([
				'status'	=> 403,
				'message'	=> $message,
			]);
		}

		abort(403, $message);
	}

	public function errorUnauthenticated($message = null)
	{
		$request = request();

		$logMessage = "An unauthenticated user attempted to access {$request->fullUrl()} from {$request->getClientIp()}";

		app('log')->warning($logMessage);

		nova_event();

		if ($request->ajax()) {
			return response()->json([
				'status'	=> 401,
				'message'	=> $message,
			]);
		}

		abort(401, $message);
	}

	final public function page()
	{
		$this->views->put('scripts', ['bootstrap-tabdrop', 'basic-page']);
		$this->views->put('styles', ['tabdrop']);

		if ($this->page->access and $this->page->access->count() > 0) {
			// Make sure the user is authenticated
			if (! $this->user) {
				return $this->errorUnauthenticated("You must log in to continue");
			}

			// Set the method that we'll call on the user object to check access
			$method = (Str::contains($this->page->access_type, 'role')) ? 'hasRole' : 'can';

			// Are we matching for ALL items or ANY item?
			$isStrict = (bool) Str::contains($this->page->access_type, 'strict');

			// Make sure we have an array of access items
			//$accessItems = explode(',', $this->page->access);

			foreach ($this->page->access as $access) {
				if ($isStrict) {
					if (! $this->user->{$method}($access['key'])) {
						return $this->errorUnauthorized("You do not have permission to view the {$this->page->name} page.");
					}
				} else {
					if ($this->user->{$method}($access['key'])) {
						break;
					}

					return $this->errorUnauthorized("You do not have permission to view the {$this->page->name} page.");
				}
			}
		}
	}

	protected function setMetadata()
	{
		if (nova()->isInstalled()) {
			$this->metadata = collect([
				'author' => $this->settings->get('metadata_author'),
				'description' => $this->settings->get('metadata_description'),
				'keywords' => $this->settings->get('metadata_keywords'),

				// OpenGraph tags for Facebook
				'og:type' => 'website',
				'og:url' => request()->fullUrl(),
				'og:title' => '',
				'og:description' => $this->settings->get('metadata_description'),
				'og:image' => '',

				// Twitter tags
				'twitter:card' => 'summary',
				'twitter:site' => $this->settings->get('metadata_twitter'),
				'twitter:title' => '',
				'twitter:description' => $this->settings->get('metadata_description'),
				'twitter:image' => '',
			]);

			view()->share('_metadata', $this->metadata);
		}
	}

	protected function setupController()
	{
		if (nova()->isInstalled()) {
			$this->page = app('nova.pages')
				->where('key', request()->route()->getName())
				->first();
			$this->content = app('nova.pageContent');
			$this->settings = app('nova.settings');

			view()->share('_page', $this->page);
			view()->share('_user', $this->user);
			view()->share('_icons', theme()->getIconMap());
			view()->share('_content', $this->content);
			view()->share('_settings', $this->settings);
		}
	}
}