<?php namespace Nova\Core\Forms\Http\Controllers;

use NovaFormTab,
	BaseController,
	FormRepositoryContract,
	FormTabRepositoryContract,
	EditFormTabRequest, CreateFormTabRequest, RemoveFormTabRequest;

class TabController extends BaseController {

	protected $repo;
	protected $formRepo;

	public function __construct(FormTabRepositoryContract $repo, 
			FormRepositoryContract $forms)
	{
		parent::__construct();

		$this->isAdmin = true;

		$this->views->put('structure', 'admin');
		$this->views->put('template', 'admin');

		$this->repo = $repo;
		$this->formRepo = $forms;

		$this->middleware('auth');
	}

	public function all($formKey)
	{
		$form = $this->data->form = $this->formRepo->getByKey($formKey, ['tabs']);
		$tab = $this->data->tab = new NovaFormTab;

		$this->authorize('manage', $tab, "You do not have permission to manage form tabs.");

		$this->views->put('page', 'admin/forms/tabs');
		$this->views->put('scripts', [
			'Sortable.min',
			'admin/forms/tabs',
		]);
		$this->views->put('styles', ['uikit/components/icon']);

		$this->data->tabs = $this->repo->getParentTabs($form, [], true);

		$this->data->orderUpdateUrl = route('admin.forms.tabs.updateOrder');
	}

	public function create($formKey)
	{
		$form = $this->data->form = $this->formRepo->getByKey($formKey);

		$this->authorize('create', new NovaFormTab, "You do not have permission to create form tabs.");

		$this->views->put('page', 'admin/forms/tab-create');
		$this->views->put('scripts', ['admin/forms/tab-create']);

		$this->data->parentTabs = ['0' => "No parent tab"];
		$this->data->parentTabs+= $this->repo->listParentTabs($form);

		$this->data->linkCheckUrl = route('admin.forms.tabs.checkLink');
	}

	public function store(CreateFormTabRequest $request, $formKey)
	{
		$this->authorize('create', new NovaFormTab, "You do not have permission to create form tabs.");

		$tab = $this->repo->create($request->all());

		flash()->success("Form Tab Created!", "You can begin designing the tab layout with sections and fields.");

		return redirect()->route('admin.forms.tabs', [$formKey]);
	}

	public function edit($formKey, $tabId)
	{
		$form = $this->data->form = $this->formRepo->getByKey($formKey);

		$tab = $this->data->tab = $this->repo->getById($tabId);

		$this->authorize('edit', $tab, "You do not have permission to edit form tabs.");

		$this->views->put('page', 'admin/forms/tab-edit');
		$this->views->put('scripts', ['admin/forms/tab-edit']);

		$this->data->parentTabs = ['0' => "No parent tab"];
		$this->data->parentTabs+= $this->repo->listParentTabs();

		$this->data->linkCheckUrl = route('admin.forms.tabs.checkLink');
	}

	public function update(EditFormTabRequest $request, $formKey, $tabId)
	{
		$this->authorize('edit', new NovaFormTab, "You do not have permission to edit form tabs.");

		$tab = $this->repo->update($tabId, $request->all());

		flash()->success("Form Tab Updated!");

		return redirect()->route('admin.forms.tabs', [$formKey]);
	}

	public function remove($formKey, $tabId)
	{
		$this->isAjax = true;

		$tab = $this->repo->getById($tabId);

		if ( ! $tab)
		{
			$body = alert('danger', "Form tab could not be found.");
		}
		else
		{
			$form = $this->formRepo->getByKey($formKey);

			$tabs = ['0' => "No tab"];
			$tabs+= $this->repo->listAll('name', 'id');

			$body = (policy($tab)->remove($this->user, $tab))
				? view(locate('page', 'admin/forms/tab-remove'), compact('form', 'tab', 'tabs'))
				: alert('danger', "You do not have permission to remove form tabs.");
		}

		return partial('modal-content', [
			'header' => "Remove Form Tab",
			'body' => $body,
			'footer' => false,
		]);
	}

	public function destroy(RemoveFormTabRequest $request, $formKey, $tabId)
	{
		$tab = $this->repo->getById($tabId);

		$this->authorize('remove', $tab, "You do not have permission to remove form tabs.");

		if ($request->has('remove_tab_content'))
		{
			$this->repo->removeTabContent($tab);
		}
		else
		{
			$this->repo->reassignTabContent($tab, $request->get('new_tab'));
		}

		$tab = $this->repo->delete($tab);

		flash()->success("Form Tab Removed!");

		return redirect()->route('admin.forms.tabs', [$formKey]);
	}

	public function checkTabLink()
	{
		$this->isAjax = true;

		$form = $this->formRepo->getByKey(request('formKey'));

		$count = $this->repo->countLinkIds($form, request('linkId'));

		if ($count > 0)
		{
			return json_encode(['code' => 0]);
		}

		return json_encode(['code' => 1]);
	}

	public function updateTabOrder()
	{
		$this->isAjax = true;

		$tab = new NovaFormTab;

		if (policy($tab)->edit($this->user, $tab))
		{
			foreach (request('tabs') as $order => $id)
			{
				$updatedTab = $this->repo->updateOrder($id, $order);
			}
		}
	}

}
