<?php namespace Nova\Core\Forms\Data\Contracts;

use User, NovaForm;

interface FormRepositoryContract extends BaseFormRepositoryContract {

	public function getByKey($key, array $with = []);
	public function getFormCenterForms(array $with = []);
	public function getParentTabs(NovaForm $form, array $relations = [], $allTabs = false);
	public function getTabs(NovaForm $form, array $relations = [], $allTabs = false);
	public function getUnboundFields(NovaForm $form, array $relations = [], $allFields = false);
	public function getUnboundSections(NovaForm $form, array $relations = [], $allSections = false);
	public function getValidationRules(NovaForm $form);

}