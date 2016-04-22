<?php

return [

	'roles' => [
		['display_name' => "Game Master", 'name' => "game-master"],
		['display_name' => "Power User", 'name' => "power-user"],
		['display_name' => "Active User", 'name' => "active-user"],
		['display_name' => "Inactive User", 'name' => "inactive-user"],
	],

	'permissions' => [
		['display_name' => "Create Pages", 'name' => "page.create", 'description' => "Create new pages or additional page content.", 'protected' => (int) true],
		['display_name' => "Edit Pages", 'name' => "page.edit", 'description' => "Edit existing pages or additional page content.", 'protected' => (int) true],
		['display_name' => "Remove Pages", 'name' => "page.remove", 'description' => "Remove existing pages or additional page content.", 'protected' => (int) true],

		['display_name' => "Create Menus", 'name' => "menu.create", 'description' => "Create new menus and menu items.", 'protected' => (int) true],
		['display_name' => "Edit Menus", 'name' => "menu.edit", 'description' => "Edit existing menus or menu items.", 'protected' => (int) true],
		['display_name' => "Remove Menus", 'name' => "menu.remove", 'description' => "Remove existing menus or menu items.", 'protected' => (int) true],

		['display_name' => "Create Roles", 'name' => "access.create", 'description' => "Create new roles and role permissions.", 'protected' => (int) true],
		['display_name' => "Edit Roles", 'name' => "access.edit", 'description' => "Edit existing roles and role permissions.", 'protected' => (int) true],
		['display_name' => "Remove Roles", 'name' => "access.remove", 'description' => "Remove existing roles and role permissions.", 'protected' => (int) true],

		['display_name' => "Create Forms", 'name' => "form.create", 'description' => "Create new forms.", 'protected' => (int) true],
		['display_name' => "Edit Forms", 'name' => "form.edit", 'description' => "Edit existing forms.", 'protected' => (int) true],
		['display_name' => "Remove Forms", 'name' => "form.remove", 'description' => "Remove existing forms.", 'protected' => (int) true],

		['display_name' => "View Form Entries", 'name' => "form-center.view", 'description' => "View form entries created from Form Center.", 'protected' => (int) true],
		['display_name' => "Edit Form Entries", 'name' => "form-center.edit", 'description' => "Edit any form entries created from Form Center.", 'protected' => (int) true],
		['display_name' => "Remove Form Entries", 'name' => "form-center.remove", 'description' => "Remove any form entries created from Form Center.", 'protected' => (int) true],

		['display_name' => "Create Users", 'name' => "user.create", 'description' => "Create new users.", 'protected' => (int) true],
		['display_name' => "Edit Users", 'name' => "user.edit", 'description' => "Edit existing users.", 'protected' => (int) true],
		['display_name' => "Remove Users", 'name' => "user.remove", 'description' => "Remove existing users.", 'protected' => (int) true],
	],

	'roleAssociations' => [
		'Game Master' => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18],
		'Power User' => [],
		'Active User' => [],
		'Inactive User' => [],
	],

];
