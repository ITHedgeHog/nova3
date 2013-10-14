<div class="btn-toolbar">
	<div class="btn-group">
		<a href="{{ URL::to('admin/form/tabs/'.$formKey) }}" class="btn btn-default icn-size-16">{{ $_icons['back'] }}</a>
	</div>
</div>

{{ Form::model($tab, ['url' => 'admin/form/tabs/'.$formKey]) }}
	<div class="row">
		<div class="col-sm-6 col-lg-4">
			<div class="form-group">
				<label class="control-label">{{ lang('Name') }}</label>
				{{ Form::text('name', null, ['class' => 'form-control js-name-change']) }}
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-2 col-lg-2">
			<label class="control-label">{{ lang('Order') }}</label>
			{{ Form::text('order', null, ['class' => 'form-control']) }}
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<p class="help-block">{{ lang('short.admin.forms.order') }}</p>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4 col-lg-4">
			<label class="control-label">{{ langConcat('Link id') }}</label>
			{{ Form::text('link_id', null, ['class' => 'form-control']) }}
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<p class="help-block">{{ lang('short.admin.forms.tabLinkId') }}</p>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4 col-lg-2">
			<div class="form-group">
				<label class="control-label">{{ lang('Display') }}</label>
				<div>
					<label class="radio-inline">{{ Form::radio('status', Status::ACTIVE) }} {{ lang('Yes') }}</label>
					<label class="radio-inline">{{ Form::radio('status', Status::INACTIVE) }} {{ lang('No') }}</label>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12">
			{{ Form::token() }}
			{{ Form::hidden('id') }}
			{{ Form::hidden('formAction', $action) }}
			{{ Form::button(lang('Action.submit'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
		</div>
	</div>
{{ Form::close() }}