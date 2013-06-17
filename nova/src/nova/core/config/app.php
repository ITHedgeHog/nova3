<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Application Debug Mode
	|--------------------------------------------------------------------------
	|
	| When your application is in debug mode, detailed error messages with
	| stack traces will be shown on every error that occurs within your
	| application. If disabled, a simple generic error page is shown.
	|
	*/

	'debug' => true,

	/*
	|--------------------------------------------------------------------------
	| Application URL
	|--------------------------------------------------------------------------
	|
	| This URL is used by the console to properly generate URLs when using
	| the Artisan command line tool. You should set this to the root of
	| your application so that it is used when running Artisan tasks.
	|
	*/

	'url' => 'http://localhost',

	/*
	|--------------------------------------------------------------------------
	| Application Timezone
	|--------------------------------------------------------------------------
	|
	| Here you may specify the default timezone for your application, which
	| will be used by the PHP date and date-time functions. We have gone
	| ahead and set this to a sensible default for you out of the box.
	|
	*/

	'timezone' => 'UTC',

	/*
	|--------------------------------------------------------------------------
	| Application Locale Configuration
	|--------------------------------------------------------------------------
	|
	| The application locale determines the default locale that will be used
	| by the translation service provider. You are free to set this value
	| to any of the locales which will be supported by the application.
	|
	*/

	'locale' => 'en',

	/*
	|--------------------------------------------------------------------------
	| Encryption Key
	|--------------------------------------------------------------------------
	|
	| This key is used by the Illuminate encrypter service and should be set
	| to a random, 32 character string, otherwise these encrypted strings
	| will not be safe. Please do this before deploying an application!
	|
	*/

	'key' => 'YourSecretKey!!!',

	/*
	|--------------------------------------------------------------------------
	| Autoloaded Service Providers
	|--------------------------------------------------------------------------
	|
	| The service providers listed here will be automatically loaded on the
	| request to your application. Feel free to add your own services to
	| this array to grant expanded functionality to your applications.
	|
	*/

	'providers' => array(

		/**
		 * Illuminate Service Providers
		 */
		'Illuminate\Foundation\Providers\ArtisanServiceProvider',
		'Illuminate\Auth\AuthServiceProvider',
		'Illuminate\Cache\CacheServiceProvider',
		'Illuminate\Foundation\Providers\CommandCreatorServiceProvider',
		'Illuminate\Session\CommandsServiceProvider',
		'Illuminate\Foundation\Providers\ComposerServiceProvider',
		'Illuminate\Routing\ControllerServiceProvider',
		'Illuminate\Cookie\CookieServiceProvider',
		'Illuminate\Database\DatabaseServiceProvider',
		'Illuminate\Encryption\EncryptionServiceProvider',
		'Illuminate\Filesystem\FilesystemServiceProvider',
		'Illuminate\Hashing\HashServiceProvider',
		'Illuminate\Html\HtmlServiceProvider',
		'Illuminate\Foundation\Providers\KeyGeneratorServiceProvider',
		'Illuminate\Log\LogServiceProvider',
		'Illuminate\Mail\MailServiceProvider',
		'Illuminate\Foundation\Providers\MaintenanceServiceProvider',
		'Illuminate\Database\MigrationServiceProvider',
		'Illuminate\Foundation\Providers\OptimizeServiceProvider',
		'Illuminate\Pagination\PaginationServiceProvider',
		'Illuminate\Foundation\Providers\PublisherServiceProvider',
		'Illuminate\Queue\QueueServiceProvider',
		'Illuminate\Redis\RedisServiceProvider',
		//'Illuminate\Remote\RemoteServiceProvider',
		'Illuminate\Auth\Reminders\ReminderServiceProvider',
		'Illuminate\Foundation\Providers\RouteListServiceProvider',
		'Illuminate\Database\SeedServiceProvider',
		'Illuminate\Foundation\Providers\ServerServiceProvider',
		'Illuminate\Session\SessionServiceProvider',
		'Illuminate\Foundation\Providers\TinkerServiceProvider',
		//'Illuminate\Translation\TranslationServiceProvider',
		'Illuminate\Validation\ValidationServiceProvider',
		'Illuminate\View\ViewServiceProvider',
		'Illuminate\Workbench\WorkbenchServiceProvider',

		/**
		 * Nova Service Providers
		 */
		'Nova\Citadel\CitadelServiceProvider',
		'Nova\Core\Providers\UtilityServiceProvider',
		'Nova\Foundation\Translation\TranslationServiceProvider',

		'Cartalyst\Api\ApiServiceProvider',

	),

	/*
	|--------------------------------------------------------------------------
	| Service Provider Manifest
	|--------------------------------------------------------------------------
	|
	| The service provider manifest is used by Laravel to lazy load service
	| providers which are not needed for each request, as well to keep a
	| list of all of the services. Here, you may set its storage spot.
	|
	*/

	'manifest' => storage_path().'/meta',

	/*
	|--------------------------------------------------------------------------
	| Class Aliases
	|--------------------------------------------------------------------------
	|
	| This array of class aliases will be registered when this application
	| is started. However, feel free to register as many as you wish as
	| the aliases are "lazy" loaded so they don't hinder performance.
	|
	*/

	'aliases' => array(

		/**
		 * Illuminate Core Classes
		 */
		'App'             => 'Illuminate\Support\Facades\App',
		'Artisan'         => 'Illuminate\Support\Facades\Artisan',
		'Auth'            => 'Illuminate\Support\Facades\Auth',
		'Blade'           => 'Illuminate\Support\Facades\Blade',
		'Cache'           => 'Illuminate\Support\Facades\Cache',
		'ClassLoader'     => 'Illuminate\Support\ClassLoader',
		'Config'          => 'Illuminate\Support\Facades\Config',
		'Controller'      => 'Illuminate\Routing\Controllers\Controller',
		'Cookie'          => 'Illuminate\Support\Facades\Cookie',
		'Crypt'           => 'Illuminate\Support\Facades\Crypt',
		'DB'              => 'Illuminate\Support\Facades\DB',
		'Eloquent'        => 'Illuminate\Database\Eloquent\Model',
		'Event'           => 'Illuminate\Support\Facades\Event',
		'File'            => 'Illuminate\Support\Facades\File',
		'Form'            => 'Illuminate\Support\Facades\Form',
		'Hash'            => 'Illuminate\Support\Facades\Hash',
		'HTML'            => 'Illuminate\Support\Facades\HTML',
		'Input'           => 'Illuminate\Support\Facades\Input',
		'Lang'            => 'Illuminate\Support\Facades\Lang',
		'Log'             => 'Illuminate\Support\Facades\Log',
		'Mail'            => 'Illuminate\Support\Facades\Mail',
		'Paginator'       => 'Illuminate\Support\Facades\Paginator',
		'Password'        => 'Illuminate\Support\Facades\Password',
		'Queue'           => 'Illuminate\Support\Facades\Queue',
		'Redirect'        => 'Illuminate\Support\Facades\Redirect',
		'Redis'           => 'Illuminate\Support\Facades\Redis',
		'Request'         => 'Illuminate\Support\Facades\Request',
		//'Response'        => 'Illuminate\Support\Facades\Response',
		'Route'           => 'Illuminate\Support\Facades\Route',
		'Schema'          => 'Illuminate\Support\Facades\Schema',
		'Seeder'          => 'Illuminate\Database\Seeder',
		'Session'         => 'Illuminate\Support\Facades\Session',
		//'SSH'             => 'Illuminate\Support\Facades\SSH',
		'Str'             => 'Illuminate\Support\Str',
		'URL'             => 'Illuminate\Support\Facades\URL',
		'Validator'       => 'Illuminate\Support\Facades\Validator',
		'View'            => 'Illuminate\Support\Facades\View',

		/**
		 * Nova Base Controllers
		 */
		'BaseController'		=> 'Nova\Core\Controllers\Base\Core',
		'MainBaseController'	=> 'Nova\Core\Controllers\Base\Main',
		'LoginBaseController'	=> 'Nova\Core\Controllers\Base\Login',
		'AdminBaseController'	=> 'Nova\Core\Controllers\Base\Admin',
		'AjaxBaseController'	=> 'Nova\Core\Controllers\Base\Ajax',
		'WikiBaseController'	=> 'Nova\Wiki\Controllers\Base\Wiki',
		'ForumBaseController'	=> 'Nova\Forum\Controllers\Base\Forum',

		/**
		 * Nova Classes
		 */
		'API'			=> 'Cartalyst\Api\Facades\API',
		'Date'			=> 'Carbon\Carbon',
		'Email'			=> 'Nova\Core\Lib\Email',
		'Location'		=> 'Nova\Core\Facades\Location',
		'Markdown'		=> 'Nova\Core\Facades\Markdown',
		'Media'			=> 'Nova\Core\Lib\Media',
		'Model'			=> 'Nova\Foundation\Database\Eloquent\Model',
		'Nav'			=> 'Nova\Core\Lib\Nav',
		'Sentry' 		=> 'Cartalyst\Sentry\Facades\Laravel\Sentry',
		'Status'		=> 'Nova\Core\Lib\Status',
		'SystemEvent'	=> 'Nova\Core\Facades\SystemEvent',
		'Utility'		=> 'Nova\Core\Facades\Utility',

		'Input'			=> 'Cartalyst\Api\Facades\Input',
		'Request'		=> 'Cartalyst\Api\Facades\Request',
		'Response'		=> 'Cartalyst\Api\Facades\Response',

		/**
		 * Nova Interfaces
		 */
		'CacheInterface'			=> 'Nova\Core\Contracts\CacheInterface',
		'MediaInterface'			=> 'Nova\Core\Contracts\MediaInterface',
		'QuickInstallInterface'		=> 'Nova\Core\Contracts\QuickInstallInterface',
		'SearchInterface'			=> 'Nova\Core\Contracts\SearchInterface',

		/**
		 * Nova Model Entities
		 */
		'AccessRole'				=> 'Nova\Core\Models\Entities\Access\Role',
		'AccessRoleTask'			=> 'Nova\Core\Models\Entities\Access\RoleTask',
		'AccessTask'				=> 'Nova\Core\Models\Entities\Access\Task',

		'NovaApp'					=> 'Nova\Core\Models\Entities\Application',
		'NovaAppResponse'			=> 'Nova\Core\Models\Entities\Application\Response',
		'NovaAppReviewer'			=> 'Nova\Core\Models\Entities\Application\Reviewer',
		'NovaAppRule'				=> 'Nova\Core\Models\Entities\Application\Rule',

		'Award'						=> 'Nova\Core\Models\Entities\Award',
		'AwardCategory'				=> 'Nova\Core\Models\Entities\Award\Category',
		'AwardRecipient'			=> 'Nova\Core\Models\Entities\Award\Recipient',
		
		'ModuleCatalog'				=> 'Nova\Core\Models\Entities\Catalog\Module',
		'RankCatalog'				=> 'Nova\Core\Models\Entities\Catalog\Rank',
		'SkinCatalog'				=> 'Nova\Core\Models\Entities\Catalog\Skin',
		'SkinSectionCatalog'		=> 'Nova\Core\Models\Entities\Catalog\SkinSection',
		'WidgetCatalog'				=> 'Nova\Core\Models\Entities\Catalog\Widget',

		'Character'					=> 'Nova\Core\Models\Entities\Character',
		'CharacterPosition'			=> 'Nova\Core\Models\Entities\Character\Positions',
		'CharacterPromotion'		=> 'Nova\Core\Models\Entities\Character\Promotion',

		'NovaForm'					=> 'Nova\Core\Models\Entities\Form',
		'NovaFormData'				=> 'Nova\Core\Models\Entities\Form\Data',
		'NovaFormField'				=> 'Nova\Core\Models\Entities\Form\Field',
		'NovaFormSection'			=> 'Nova\Core\Models\Entities\Form\Section',
		'NovaFormTab'				=> 'Nova\Core\Models\Entities\Form\Tab',
		'NovaFormValue'				=> 'Nova\Core\Models\Entities\Form\Value',

		'Mission'					=> 'Nova\Core\Models\Entities\Mission',
		'MissionGroup'				=> 'Nova\Core\Models\Entities\Mission\Group',
		'MissionNote'				=> 'Nova\Core\Models\Entities\Mission\Note',

		'Post'						=> 'Nova\Core\Models\Entities\Post',
		'PostAuthor'				=> 'Nova\Core\Models\Entities\Post\Author',
		'PostLock'					=> 'Nova\Core\Models\Entities\Post\Lock',
		'PostParticipant'			=> 'Nova\Core\Models\Entities\Post\Participant',

		'Rank'						=> 'Nova\Core\Models\Entities\Rank',
		'RankGroup'					=> 'Nova\Core\Models\Entities\Rank\Group',
		'RankInfo'					=> 'Nova\Core\Models\Entities\Rank\Info',

		'User'						=> 'Nova\Core\Models\Entities\User',
		'UserLoa'					=> 'Nova\Core\Models\Entities\User\Loa',
		'UserPrefs'					=> 'Nova\Core\Models\Entities\User\Preferences',
		'UserSuspend'				=> 'Nova\Core\Models\Entities\User\Suspend',

		'Announcement'				=> 'Nova\Core\Models\Entities\Announcement',
		'Ban'						=> 'Nova\Core\Models\Entities\Ban',
		'Comment'					=> 'Nova\Core\Models\Entities\Comment',
		'Dept'						=> 'Nova\Core\Models\Entities\Department',
		'Manifest'					=> 'Nova\Core\Models\Entities\Manifest',
		'Media'						=> 'Nova\Core\Models\Entities\Media',
		'Message'					=> 'Nova\Core\Models\Entities\Message',
		'MessageRecipient'			=> 'Nova\Core\Models\Entities\MessageRecipient',
		'Moderation'				=> 'Nova\Core\Models\Entities\Moderation',
		'NavModel'					=> 'Nova\Core\Models\Entities\Nav',
		'PersonalLog'				=> 'Nova\Core\Models\Entities\PersonalLog',
		'Position'					=> 'Nova\Core\Models\Entities\Position',
		'Settings'					=> 'Nova\Core\Models\Entities\Settings',
		'SimType'					=> 'Nova\Core\Models\Entities\SimType',
		'SiteContent'				=> 'Nova\Core\Models\Entities\SiteContent',
		'System'					=> 'Nova\Core\Models\Entities\System',
		'SystemEventModel'			=> 'Nova\Core\Models\Entities\SystemEvent',
		'SystemRoute'				=> 'Nova\Core\Models\Entities\SystemRoute',

		/**
		 * Nova Model Event Handlers
		 */
		'AccessRoleEventHandler'	=> 'Nova\Core\Models\Events\Access\Role',
		'AccessTaskEventHandler'	=> 'Nova\Core\Models\Events\Access\Task',

		'FormEventHandler'			=> 'Nova\Core\Models\Events\Form',
		'FormFieldEventHandler'		=> 'Nova\Core\Models\Events\Form\Field',
		'FormSectionEventHandler'	=> 'Nova\Core\Models\Events\Form\Section',
		'FormTabEventHandler'		=> 'Nova\Core\Models\Events\Form\Tab',

		'RankGroupHandler'			=> 'Nova\Core\Models\Events\Rank\Group',
		'RankInfoHandler'			=> 'Nova\Core\Models\Events\Rank\Info',
		
		'AppHandler'				=> 'Nova\Core\Models\Events\Application',
		'BaseEventHandler'			=> 'Nova\Core\Models\Events\Base',
		'CharacterHandler'			=> 'Nova\Core\Models\Events\Character',
		'CommentHandler'			=> 'Nova\Core\Models\Events\Comment',
		'PositionHandler'			=> 'Nova\Core\Models\Events\Position',
		'RankHandler'				=> 'Nova\Core\Models\Events\Rank',
		'SettingsHandler'			=> 'Nova\Core\Models\Events\Settings',
		'SiteContentHandler'		=> 'Nova\Core\Models\Events\SiteContent',
		'SystemRouteHandler'		=> 'Nova\Core\Models\Events\SystemRoute',
		'UserHandler'				=> 'Nova\Core\Models\Events\User',

		/**
		 * Nova Model Validators
		 */
		'AccessRoleValidator'		=> 'Nova\Core\Models\Validators\Access\Role',
		'AccessTaskValidator'		=> 'Nova\Core\Models\Validators\Access\Task',

		'FormValidator'				=> 'Nova\Core\Models\Validators\Form',
		'FormTabValidator'			=> 'Nova\Core\Models\Validators\Form\Tab',

		'BaseValidator'				=> 'Nova\Core\Models\Validators\Base',
		'SystemRouteValidator'		=> 'Nova\Core\Models\Validators\SystemRoute',
		'UserValidator'				=> 'Nova\Core\Models\Validators\User',

	),

);