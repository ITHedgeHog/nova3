<?php

return [

	'roles' => [
		['name' => "Game Master"],
		['name' => "Power User"],
		['name' => "Active User"],
		['name' => "Inactive User"],
	],

	'permissions' => [
		['display_name' => "Create Pages", 'name' => "page.create", 'description' => "Create new pages or additional page content."],
		['display_name' => "Edit Pages", 'name' => "page.edit", 'description' => "Edit existing pages or additional page content."],
		['display_name' => "Remove Pages", 'name' => "page.remove", 'description' => "Remove existing pages or additional page content."],

		['display_name' => "Create Menus", 'name' => "menu.create", 'description' => "Create new menus and menu items."],
		['display_name' => "Edit Menus", 'name' => "menu.edit", 'description' => "Edit existing menus or menu items."],
		['display_name' => "Remove Menus", 'name' => "menu.remove", 'description' => "Remove existing menus or menu items."],

		['display_name' => "Create Access Roles", 'name' => "access.create"],
		['display_name' => "Edit Access Roles", 'name' => "access.edit"],
		['display_name' => "Remove Roles", 'name' => "access.remove"],
	],

	'roleAssociations' => [
		'Game Master' => [1,2,3,4,5,6,7,8,9],
		'Power User' => [],
		'Active User' => [],
		'Inactive User' => [],
	],

];