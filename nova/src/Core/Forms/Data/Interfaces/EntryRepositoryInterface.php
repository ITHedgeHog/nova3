<?php namespace Nova\Core\Forms\Data\Interfaces;

use User, NovaForm;

interface EntryRepositoryInterface extends BaseFormRepositoryInterface {

	public function getFormEntries(NovaForm $form);
	public function getUserEntries(User $user, $form = null);
	public function insert(NovaForm $form, $user, array $data);

}
