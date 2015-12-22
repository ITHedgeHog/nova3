<?php

$options = [
	'prefix'		=> 'setup',
	'namespace'		=> 'Nova\Setup\Http\Controllers'
];

Route::group($options, function ()
{
	Route::get('env', 'SetupController@environment')->name('setup.env');
	Route::get('/', 'SetupController@index')->name('setup.home');
	Route::get('update', 'UpdateController@index')->name('setup.update');
	Route::post('uninstall', 'SetupController@uninstall')->name('setup.uninstall');
});

$installOptions = array_merge($options, [
	'prefix' => 'setup/install'
]);

Route::group($installOptions, function ()
{
	Route::get('/', 'InstallController@index')->name('setup.install');

	Route::get('config-database', 'ConfigDbController@info')->name('setup.install.config.db');
	Route::get('config-database/success', 'ConfigDbController@success')->name('setup.install.config.db.success');
	Route::get('config-database/write', 'ConfigDbController@write')->name('setup.install.config.db.write');
	Route::post('config-database/check', 'ConfigDbController@check')->name('setup.install.config.db.check');

	Route::get('config-email', 'ConfigEmailController@info')->name('setup.install.config.email');
	Route::get('config-email/success', 'ConfigEmailController@success')->name('setup.install.config.email.success');
	Route::post('config-email/write', 'ConfigEmailController@write')->name('setup.install.config.email.write');

	Route::get('nova', 'InstallController@installLanding')->name('setup.install.nova');
	Route::get('nova/success', 'InstallController@novaSuccess')->name('setup.install.nova.success');
	Route::post('nova', 'InstallController@install');

	Route::get('user', 'InstallController@user')->name('setup.install.user');
	Route::get('user/success', 'InstallController@userSuccess')->name('setup.install.user.success');
	Route::post('user', 'InstallController@createUser')->name('setup.install.user.store');

	Route::get('settings', 'InstallController@settings')->name('setup.install.settings');
	Route::get('settings/success', 'InstallController@settingsSuccess')->name('setup.install.settings.success');
	Route::post('settings', 'InstallController@updateSettings')->name('setup.install.settings.store');
});
