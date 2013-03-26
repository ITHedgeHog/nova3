<?php
/**
 * Nova's ajax controller.
 *
 * @package		Nova
 * @category	Controller
 * @author		Anodyne Productions
 * @copyright	2012 Anodyne Productions
 */

namespace Nova;

class Controller_Ajax_Add extends Controller_Base_Ajax
{
	/**
	 * Ban a user.
	 *
	 * @return	void
	 */
	public function action_arc_banuser($id)
	{
		if (\Sentry::check() and \Sentry::user()->hasAccess('ban.create'))
		{
			// get the user
			$user = \Model_User::find(\Security::xss_clean($id));

			// create the ban
			\Model_Ban::createItem(array(
				'level' => 1,
				'email' => $user->email,
			));

			\SystemEvent::add('user', '[[event.admin.arc.ban_user|{{1}}|{{'.$user->email.'}}]]');

			echo '<p class="alert alert-success">'.lang('[[short.flash.success|action.ban|action.created]]', 1).'</p>';
			echo '<div class="form-actions"><button class="btn close-dialog">'.lang('action.close', 1).'</button></div>';
		}
	}

	/**
	 * Add a field value to the database.
	 *
	 * @return	string
	 */
	public function action_formfield_value()
	{
		if (\Sentry::check() and \Sentry::user()->hasAccess('form.update'))
		{
			// get the values
			$content = \Security::xss_clean(\Input::post('content'));
			$field = \Security::xss_clean(\Input::post('field'));
			$order = \Security::xss_clean(\Input::post('order'));

			// create a new object and populate it with data
			$item = \Model_Form_Value::forge();
			$item->content = $content;
			$item->value = $content;
			$item->order = $order;
			$item->field_id = $field;

			// save the record
			$record = $item->save();

			\SystemEvent::add('user', '[[event.admin.form.field_update|{{'.$record->field->label.'}}|{{'.$record->field->form_key.'}}]]');

			if ($record)
			{
				echo '<tr id="value_'.$item->id.'"><td>'.$item->content.'</td><td class="span2"><div class="btn-toolbar pull-right"><div class="btn-group"><a href="#" class="btn btn-mini value-action tooltip-top" title="'.lang('action.edit', 1).'" data-action="update" data-id="'.$item->id.'"><div class="icn icn-50" data-icon="p"></div></a></div><div class="btn-group"><a href="#" class="btn btn-mini value-action tooltip-top" title="'.lang('action.delete', 1).'" data-action="delete" data-id="'.$item->id.'"><div class="icn icn-50" data-icon="x"></div></a></div></div></td><td class="span1 reorder"></td></tr>';
			}
		}
	}

	/**
	 * Runs the QuickInstall for a module.
	 *
	 * @return	void
	 */
	public function action_module($module)
	{
		if (\Sentry::check() and \Sentry::user()->hasAccess('catalog.create'))
		{
			// Do the quick install
			\Model_Catalog_Module::install($module);

			\SystemEvent::add('user', '[[event.admin.catalog.module_create|{{'.$module.'}}]]');

			echo '<p class="alert alert-success">'.lang('[[short.flash.success|module|action.installed]]').'</p>';
			echo '<div class="form-actions"><button class="btn close-dialog">'.lang('action.close', 1).'</button></div>';
		}
	}

	/**
	 * Duplicate a rank set.
	 *
	 * @param	int		the ID of the rank set being duplicated
	 * @return	void
	 */
	public function action_rankgroup_duplicate($id)
	{
		if (\Sentry::check() and \Sentry::user()->hasAccess('rank.create'))
		{
			$data['id'] = $id;
			$data['rank'] = \Model_Settings::getItems('rank');
			$data['genre'] = \Config::get('nova.genre');

			// read the directory for the dropdown
			$bases = \File::read_dir(APPPATH.'assets/common/'.$data['genre'].'/ranks/'.$data['rank'].'/base');

			if (is_array($bases) and count($bases) > 0)
			{
				// the first item should be empty
				$data['bases'][''] = '';

				// loop through the images
				foreach ($bases as $key => $location)
				{
					if (is_array($location))
					{
						// make sure the directory separators are right
						$key = str_replace('\\', '/', $key);

						// loop through the sub directory
						foreach ($location as $l)
						{
							// strip the image extension
							$image = substr_replace($l, '', strpos($l, '.'));

							// the image without extension is the value, with extension is displayed
							$data['bases'][$key.$image] = $key.$l;
						}
					}
					else
					{
						// strip the image extension
						$image = substr_replace($location, '', strpos($location, '.'));

						// the image without extension is the value, with extension is displayed
						$data['bases'][$image] = $location;
					}
				}
			}

			echo \View::forge(\Location::file('add/rankgroup_duplicate', \Utility::getSkin('admin'), 'ajax'), $data);
		}
	}

	/**
	 * Create a rank info record.
	 *
	 * @return	void
	 */
	public function action_rankinfo()
	{
		if (\Sentry::check() and \Sentry::user()->hasAccess('rank.create'))
		{
			// set the data
			$data['id'] = 0;
			$data['action'] = 'create';

			$data['name'] = '';
			$data['short_name'] = '';
			$data['order'] = '';
			$data['group'] = '';
			$data['display'] = 1;

			echo \View::forge(\Location::file('update/rankinfo', \Utility::getSkin('admin'), 'ajax'), $data);
		}
	}

	/**
	 * Duplicate an access role.
	 *
	 * @param	int		The ID of the role being duplicated
	 * @return	void
	 */
	public function action_role_duplicate($id)
	{
		if (\Sentry::check() and \Sentry::user()->hasAccess('role.create'))
		{
			// ID of the role to duplicate
			$data['id'] = \Security::xss_clean($id);

			// Get the original role
			$original = \Model_Access_Role::find($data['id']);

			// Get the name from the original role
			$data['name'] = $original->name;

			echo \View::forge(\Location::file('add/role_duplicate', \Utility::getSkin('admin'), 'ajax'), $data);
		}
	}

	/**
	 * Create a user record.
	 *
	 * @return	void
	 */
	public function action_user()
	{
		if (\Sentry::check() and \Sentry::user()->hasAccess('user.create'))
		{
			echo \View::forge(\Location::file('add/user', \Utility::getSkin('admin'), 'ajax'));
		}
	}
}
