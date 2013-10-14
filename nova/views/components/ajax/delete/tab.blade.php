<p>{{ lang('short.deleteConfirm', lang('tab'), $name) }}</p>

{{ Form::open(['url' => 'admin/form/tabs/'.$formKey]) }}
	@if (count($tabs) > 0)
		<div class="row">
			<div class="col-lg-6">
				{{ Form::select('new_tab_id', $tabs) }}
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<p class="help-block">{{ lang('short.admin.forms.deleteUpdates', lang('tab'), lang('sections'), $name) }}</p>
			</div>
		</div>
	@else
		{{ Form::hidden('new_tab_id', 0) }}
	@endif

	{{ Form::hidden('id', $id) }}
	{{ Form::hidden('formAction', 'delete') }}
	{{ Form::button(lang('Action.delete'), ['type' => 'submit', 'class' => 'btn btn-danger']) }}
{{ Form:: close() }}