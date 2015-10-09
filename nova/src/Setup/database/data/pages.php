<?php

return [
	[
		'name'				=> "Homepage",
		'key'				=> "home",
		'uri'				=> "/",
		'default_resource'	=> "Nova\\Foundation\\Http\\Controllers\\MainController@page",
		'menu_id'			=> 1,
	],

	[
		'name'				=> "Log In",
		'key'				=> "login",
		'uri'				=> "login",
		'default_resource'	=> "Nova\\Core\\Auth\\Http\\Controllers\\AuthController@getLogin",
		'menu_id'			=> 1,
	],
	[
		'verb'				=> "POST",
		'name'				=> "Do Log In",
		'key'				=> "login.do",
		'uri'				=> "login",
		'default_resource'	=> "Nova\\Core\\Auth\\Http\\Controllers\\AuthController@postLogin",
	],
	[
		'name'				=> "Log Out",
		'key'				=> "logout",
		'uri'				=> "logout",
		'default_resource'	=> "Nova\\Core\\Auth\\Http\\Controllers\\AuthController@getLogout",
	],
	[
		'name'				=> "Forgot Password",
		'key'				=> "password.email",
		'uri'				=> "password",
		'default_resource'	=> "Nova\\Core\\Auth\\Http\\Controllers\\PasswordController@getEmail",
	],
	[
		'verb'				=> "POST",
		'name'				=> "Send Password Reminder",
		'key'				=> "password.email.send",
		'uri'				=> "password",
		'default_resource'	=> "Nova\\Core\\Auth\\Http\\Controllers\\PasswordController@postEmail",
	],
	[
		'name'				=> "Reset Password",
		'key'				=> "password.reset",
		'uri'				=> "password/reset/{token}",
		'default_resource'	=> "Nova\\Core\\Auth\\Http\\Controllers\\PasswordController@getReset",
	],
	[
		'verb'				=> "POST",
		'name'				=> "Do Password Reset",
		'key'				=> "password.reset.do",
		'uri'				=> "password/reset",
		'default_resource'	=> "Nova\\Core\\Auth\\Http\\Controllers\\PasswordController@postReset",
	],

	[
		'name'				=> "Page Manager",
		'key'				=> "admin.pages",
		'uri'				=> "admin/pages",
		'default_resource'	=> "Nova\\Core\\Pages\\Http\\Controllers\\PageController@index",
		'menu_id'			=> 2,
	],
	[
		'name'				=> "Create Page",
		'key'				=> "admin.pages.create",
		'uri'				=> "admin/pages/create",
		'default_resource'	=> "Nova\\Core\\Pages\\Http\\Controllers\\PageController@create",
		'menu_id'			=> 2,
	],
	[
		'verb'				=> "POST",
		'name'				=> "Store Page",
		'key'				=> "admin.pages.store",
		'uri'				=> "admin/pages/create",
		'default_resource'	=> "Nova\\Core\\Pages\\Http\\Controllers\\PageController@store",
	],
	[
		'name'				=> "Edit Page",
		'key'				=> "admin.pages.edit",
		'uri'				=> "admin/pages/{pageId}/edit",
		'default_resource'	=> "Nova\\Core\\Pages\\Http\\Controllers\\PageController@edit",
		'menu_id'			=> 2,
	],
	[
		'verb'				=> "PUT",
		'name'				=> "Update Page",
		'key'				=> "admin.pages.update",
		'uri'				=> "admin/pages/{pageId}",
		'default_resource'	=> "Nova\\Core\\Pages\\Http\\Controllers\\PageController@update",
	],
	[
		'name'				=> "Remove Page Pop-up",
		'key'				=> "admin.pages.remove",
		'uri'				=> "admin/pages/{pageId}/remove",
		'default_resource'	=> "Nova\\Core\\Pages\\Http\\Controllers\\PageController@remove",
	],
	[
		'verb'				=> "DELETE",
		'name'				=> "Remove Page",
		'key'				=> "admin.pages.destroy",
		'uri'				=> "admin/pages/{pageId}",
		'default_resource'	=> "Nova\\Core\\Pages\\Http\\Controllers\\PageController@destroy",
	],
	[
		'verb'				=> "POST",
		'name'				=> "Check for Duplicate Page Keys",
		'key'				=> "admin.pages.checkKey",
		'uri'				=> "admin/pages/check-key",
		'default_resource'	=> "Nova\\Core\\Pages\\Http\\Controllers\\PageController@checkPageKey",
	],
	[
		'verb'				=> "POST",
		'name'				=> "Check for Duplicate Page URIs",
		'key'				=> "admin.pages.checkUri",
		'uri'				=> "admin/pages/check-uri",
		'default_resource'	=> "Nova\\Core\\Pages\\Http\\Controllers\\PageController@checkPageUri",
	],

	[
		'name'				=> "Page Content Manager",
		'key'				=> "admin.content",
		'uri'				=> "admin/content",
		'default_resource'	=> "Nova\\Core\\Pages\\Http\\Controllers\\PageContentController@index",
		'menu_id'			=> 2,
	],
	[
		'name'				=> "Create Page Content",
		'key'				=> "admin.content.create",
		'uri'				=> "admin/content/create",
		'default_resource'	=> "Nova\\Core\\Pages\\Http\\Controllers\\PageContentController@create",
		'menu_id'			=> 2,
	],
	[
		'verb'				=> "POST",
		'name'				=> "Store Page Content",
		'key'				=> "admin.content.store",
		'uri'				=> "admin/content/create",
		'default_resource'	=> "Nova\\Core\\Pages\\Http\\Controllers\\PageContentController@store",
	],
	[
		'name'				=> "Edit Page Content",
		'key'				=> "admin.content.edit",
		'uri'				=> "admin/content/{contentId}/edit",
		'default_resource'	=> "Nova\\Core\\Pages\\Http\\Controllers\\PageContentController@edit",
		'menu_id'			=> 2,
	],
	[
		'verb'				=> "PUT",
		'name'				=> "Update Page Content",
		'key'				=> "admin.content.update",
		'uri'				=> "admin/content/{contentId}",
		'default_resource'	=> "Nova\\Core\\Pages\\Http\\Controllers\\PageContentController@update",
	],
	[
		'name'				=> "Remove Page Content Pop-up",
		'key'				=> "admin.content.remove",
		'uri'				=> "admin/content/{contentId}/remove",
		'default_resource'	=> "Nova\\Core\\Pages\\Http\\Controllers\\PageContentController@remove",
	],
	[
		'verb'				=> "DELETE",
		'name'				=> "Remove Page Content",
		'key'				=> "admin.content.destroy",
		'uri'				=> "admin/content/{contentId}",
		'default_resource'	=> "Nova\\Core\\Pages\\Http\\Controllers\\PageContentController@destroy",
	],
	[
		'verb'				=> "POST",
		'name'				=> "Check for Duplicate Page Content Keys",
		'key'				=> "admin.content.checkKey",
		'uri'				=> "admin/content/check-key",
		'default_resource'	=> "Nova\\Core\\Pages\\Http\\Controllers\\PageContentController@checkContentKey",
	],

	[
		'name'				=> "Menu Manager",
		'key'				=> "admin.menus",
		'uri'				=> "admin/menus",
		'default_resource'	=> "Nova\\Core\\Menus\\Http\\Controllers\\MenuController@index",
		'menu_id'			=> 2,
	],
	[
		'name'				=> "Create Menu",
		'key'				=> "admin.menus.create",
		'uri'				=> "admin/menus/create",
		'default_resource'	=> "Nova\\Core\\Menus\\Http\\Controllers\\MenuController@create",
		'menu_id'			=> 2,
	],
	[
		'verb'				=> "POST",
		'name'				=> "Store Menu",
		'key'				=> "admin.menus.store",
		'uri'				=> "admin/menus/create",
		'default_resource'	=> "Nova\\Core\\Menus\\Http\\Controllers\\MenuController@store",
	],
	[
		'name'				=> "Edit Menu",
		'key'				=> "admin.menus.edit",
		'uri'				=> "admin/menus/{menuId}/edit",
		'default_resource'	=> "Nova\\Core\\Menus\\Http\\Controllers\\MenuController@edit",
		'menu_id'			=> 2,
	],
	[
		'verb'				=> "PUT",
		'name'				=> "Update Menu",
		'key'				=> "admin.menus.update",
		'uri'				=> "admin/menus/{menuId}",
		'default_resource'	=> "Nova\\Core\\Menus\\Http\\Controllers\\MenuController@update",
	],
	[
		'name'				=> "Remove Menu Pop-up",
		'key'				=> "admin.menus.remove",
		'uri'				=> "admin/menus/{menuId}/remove",
		'default_resource'	=> "Nova\\Core\\Menus\\Http\\Controllers\\MenuController@remove",
	],
	[
		'verb'				=> "DELETE",
		'name'				=> "Remove Menu",
		'key'				=> "admin.menus.destroy",
		'uri'				=> "admin/menus/{menuId}",
		'default_resource'	=> "Nova\\Core\\Menus\\Http\\Controllers\\MenuController@destroy",
	],
	[
		'verb'				=> "POST",
		'name'				=> "Check for Duplicate Menu Keys",
		'key'				=> "admin.menus.checkKey",
		'uri'				=> "admin/menus/check-key",
		'default_resource'	=> "Nova\\Core\\Menus\\Http\\Controllers\\MenuController@checkMenuKey",
	],
	[
		'verb'				=> "POST",
		'name'				=> "Create Menu Key From Name",
		'key'				=> "admin.menus.generateKey",
		'uri'				=> "admin/menus/generate-key",
		'default_resource'	=> "Nova\\Core\\Menus\\Http\\Controllers\\MenuController@generateMenuKey",
	],
	[
		'name'				=> "Manage Pages with This Menu",
		'key'				=> "admin.menus.pages",
		'uri'				=> "admin/menus/{menuKey}/pages",
		'default_resource'	=> "Nova\\Core\\Menus\\Http\\Controllers\\MenuController@pages",
		'menu_id'			=> 2,
	],
	[
		'verb'				=> "PUT",
		'name'				=> "Update Menus for Pages",
		'key'				=> "admin.menus.pages.update",
		'uri'				=> "admin/menus/{menuKey}/pages",
		'default_resource'	=> "Nova\\Core\\Menus\\Http\\Controllers\\MenuController@updatePages",
	],

	/**
	 * Menu Items
	 */
	[
		'name'				=> "Manage Menu Items",
		'key'				=> "admin.menus.items",
		'uri'				=> "admin/menu-items/{menuId}",
		'default_resource'	=> "Nova\\Core\\Menus\\Http\\Controllers\\MenuItemController@index",
		'menu_id'			=> 2,
	],
	[
		'name'				=> "Create Menu Item",
		'key'				=> "admin.menus.items.create",
		'uri'				=> "admin/menu-items/{menuId}/create",
		'default_resource'	=> "Nova\\Core\\Menus\\Http\\Controllers\\MenuItemController@create",
		'menu_id'			=> 2,
	],
	[
		'verb'				=> "POST",
		'name'				=> "Store Menu Item",
		'key'				=> "admin.menus.items.store",
		'uri'				=> "admin/menu-items/create",
		'default_resource'	=> "Nova\\Core\\Menus\\Http\\Controllers\\MenuItemController@store",
	],
	[
		'verb'				=> "POST",
		'name'				=> "Store Menu Item Divider",
		'key'				=> "admin.menus.items.storeDivider",
		'uri'				=> "admin/menu-items/create-divider",
		'default_resource'	=> "Nova\\Core\\Menus\\Http\\Controllers\\MenuItemController@storeDivider",
	],
	[
		'name'				=> "Edit Menu Item",
		'key'				=> "admin.menus.items.edit",
		'uri'				=> "admin/menu-items/{menuItemId}/edit",
		'default_resource'	=> "Nova\\Core\\Menus\\Http\\Controllers\\MenuItemController@edit",
		'menu_id'			=> 2,
	],
	[
		'verb'				=> "PUT",
		'name'				=> "Update Menu Item",
		'key'				=> "admin.menus.items.update",
		'uri'				=> "admin/menu-items/{menuItemId}",
		'default_resource'	=> "Nova\\Core\\Menus\\Http\\Controllers\\MenuItemController@update",
	],
	[
		'name'				=> "Remove Menu Item Pop-up",
		'key'				=> "admin.menus.items.remove",
		'uri'				=> "admin/menu-items/{menuItemId}/remove",
		'default_resource'	=> "Nova\\Core\\Menus\\Http\\Controllers\\MenuItemController@remove",
	],
	[
		'verb'				=> "DELETE",
		'name'				=> "Remove Menu Item",
		'key'				=> "admin.menus.items.destroy",
		'uri'				=> "admin/menu-items/{menuItemId}",
		'default_resource'	=> "Nova\\Core\\Menus\\Http\\Controllers\\MenuItemController@destroy",
	],
	[
		'verb'				=> "POST",
		'name'				=> "Reorder Menu Items",
		'key'				=> "admin.menu.items.reorder",
		'uri'				=> "admin/menu-items/reorder",
		'default_resource'	=> "Nova\\Core\\Menus\\Http\\Controllers\\MenuItemController@reorder",
	],

	/**
	 * Roles
	 */
	[
		'name'				=> "Manage Roles",
		'key'				=> "admin.access.roles",
		'uri'				=> "admin/access/roles",
		'default_resource'	=> "Nova\\Core\\Access\\Http\\Controllers\\RoleController@index",
		'menu_id'			=> 2,
	],
	[
		'name'				=> "Create Role",
		'key'				=> "admin.access.roles.create",
		'uri'				=> "admin/access/roles/create",
		'default_resource'	=> "Nova\\Core\\Access\\Http\\Controllers\\RoleController@create",
		'menu_id'			=> 2,
	],
	[
		'verb'				=> "POST",
		'name'				=> "Store Role",
		'key'				=> "admin.access.roles.store",
		'uri'				=> "admin/access/roles/create",
		'default_resource'	=> "Nova\\Core\\Access\\Http\\Controllers\\RoleController@store",
	],
	[
		'name'				=> "Edit Role",
		'key'				=> "admin.access.roles.edit",
		'uri'				=> "admin/access/roles/{roleId}/edit",
		'default_resource'	=> "Nova\\Core\\Access\\Http\\Controllers\\RoleController@edit",
		'menu_id'			=> 2,
	],
	[
		'verb'				=> "PUT",
		'name'				=> "Update Role",
		'key'				=> "admin.access.roles.update",
		'uri'				=> "admin/access/roles/{roleId}",
		'default_resource'	=> "Nova\\Core\\Access\\Http\\Controllers\\RoleController@update",
	],
	[
		'name'				=> "Remove Role Pop-up",
		'key'				=> "admin.access.roles.remove",
		'uri'				=> "admin/access/roles/{roleId}/remove",
		'default_resource'	=> "Nova\\Core\\Access\\Http\\Controllers\\RoleController@remove",
	],
	[
		'verb'				=> "DELETE",
		'name'				=> "Remove Role",
		'key'				=> "admin.access.roles.destroy",
		'uri'				=> "admin/access/roles/{roleId}",
		'default_resource'	=> "Nova\\Core\\Access\\Http\\Controllers\\RoleController@destroy",
	],
	[
		'verb'				=> "POST",
		'name'				=> "Duplicate Role",
		'key'				=> "admin.access.roles.duplicate",
		'uri'				=> "admin/access/roles/{roleId}/duplicate",
		'default_resource'	=> "Nova\\Core\\Access\\Http\\Controllers\\RoleController@duplicate",
	],

	/**
	 * Permissions
	 */
	[
		'name'				=> "Manage Permissions",
		'key'				=> "admin.access.permissions",
		'uri'				=> "admin/access/permissions",
		'default_resource'	=> "Nova\\Core\\Access\\Http\\Controllers\\PermissionController@index",
		'menu_id'			=> 2,
	],
	[
		'name'				=> "Create Permission",
		'key'				=> "admin.access.permissions.create",
		'uri'				=> "admin/access/permissions/create",
		'default_resource'	=> "Nova\\Core\\Access\\Http\\Controllers\\PermissionController@create",
		'menu_id'			=> 2,
	],
	[
		'verb'				=> "POST",
		'name'				=> "Store Permission",
		'key'				=> "admin.access.permissions.store",
		'uri'				=> "admin/access/permissions/create",
		'default_resource'	=> "Nova\\Core\\Access\\Http\\Controllers\\PermissionController@store",
	],
	[
		'name'				=> "Edit Permission",
		'key'				=> "admin.access.permissions.edit",
		'uri'				=> "admin/access/permissions/{permissionId}/edit",
		'default_resource'	=> "Nova\\Core\\Access\\Http\\Controllers\\PermissionController@edit",
		'menu_id'			=> 2,
	],
	[
		'verb'				=> "PUT",
		'name'				=> "Update Permission",
		'key'				=> "admin.access.permissions.update",
		'uri'				=> "admin/access/permissions/{permissionId}",
		'default_resource'	=> "Nova\\Core\\Access\\Http\\Controllers\\PermissionController@update",
	],
	[
		'name'				=> "Remove Permission Pop-up",
		'key'				=> "admin.access.permissions.remove",
		'uri'				=> "admin/access/permissions/{permissionId}/remove",
		'default_resource'	=> "Nova\\Core\\Access\\Http\\Controllers\\PermissionController@remove",
	],
	[
		'verb'				=> "DELETE",
		'name'				=> "Remove Permission",
		'key'				=> "admin.access.permissions.destroy",
		'uri'				=> "admin/access/permissions/{permissionId}",
		'default_resource'	=> "Nova\\Core\\Access\\Http\\Controllers\\PermissionController@destroy",
	],
	[
		'verb'				=> "POST",
		'name'				=> "Check for Duplicate Permission Keys",
		'key'				=> "admin.access.permissions.checkKey",
		'uri'				=> "admin/access/permissions/check-key",
		'default_resource'	=> "Nova\\Core\\Access\\Http\\Controllers\\PermissionController@checkPermissionKey",
	],
	[
		'verb'				=> "POST",
		'name'				=> "Check for Duplicate Role Keys",
		'key'				=> "admin.access.roles.checkKey",
		'uri'				=> "admin/access/roles/check-key",
		'default_resource'	=> "Nova\\Core\\Access\\Http\\Controllers\\RoleController@checkRoleKey",
	],
];
