<div v-cloak>
	<mobile>
		<p><a href="{{ route('admin.forms') }}" class="btn btn-default btn-lg btn-block">{!! icon('arrow-back') !!}<span>Back to Forms</span></a></p>
	</mobile>
	<desktop>
		<div class="btn-toolbar">
			<div class="btn-group">
				<a href="{{ route('admin.forms') }}" class="btn btn-default">{!! icon('arrow-back') !!}<span>Back to Forms</span></a>
			</div>
		</div>
	</desktop>

	{!! Form::open(['route' => 'admin.forms.store', 'class' => 'form-horizontal']) !!}
		<div class="form-group{{ ($errors->has('name')) ? ' has-error' : '' }}">
			<label class="col-md-2 control-label">Form Name</label>
			<div class="col-md-5">
				{!! Form::text('name', null, ['class' => 'form-control input-lg', 'v-model' => 'name', '@change' => 'updateName']) !!}
				{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
			</div>
		</div>

		<div class="form-group{{ ($errors->has('key')) ? ' has-error' : '' }}">
			<label class="col-md-2 control-label">Form Key</label>
			<div class="col-md-5">
				{!! Form::text('key', null, ['class' => 'form-control input-lg', 'v-model' => 'key', '@change' => 'updateKey']) !!}
				{!! $errors->first('key', '<p class="help-block">:message</p>') !!}
			</div>
		</div>

		<div class="form-group{{ ($errors->has('orientation')) ? ' has-error' : '' }}">
			<label class="col-md-2 control-label">Orientation</label>
			<div class="col-md-5">
				<div>
					<div class="radio">
						<label>{!! Form::radio('orientation', 'vertical', false, ['v-model' => 'orientation']) !!} Vertical</label>
					</div>
					<div class="radio">
						<label>{!! Form::radio('orientation', 'horizontal', false, ['v-model' => 'orientation']) !!} Horizontal</label>
					</div>
				</div>
				{!! $errors->first('orientation', '<p class="help-block">:message</p>') !!}
			</div>
		</div>

		<div class="form-group{{ ($errors->has('status')) ? ' has-error' : '' }}">
			<label class="col-md-2 control-label">Status</label>
			<div class="col-md-5">
				<div>
					<div class="radio">
						<label>{!! Form::radio('status', Status::ACTIVE, true, ['v-model' => 'status']) !!} {{ ucwords(Status::toString(Status::ACTIVE)) }}</label>
					</div>
					<div class="radio">
						<label>{!! Form::radio('status', Status::INACTIVE, false, ['v-model' => 'status']) !!} {{ ucwords(Status::toString(Status::INACTIVE)) }}</label>
					</div>
				</div>
				{!! $errors->first('status', '<p class="help-block">:message</p>') !!}
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-10 col-md-offset-2">
				<h3>Form Center</h3>

				<p>Form Center is an easy way for users to fill out forms that you've created without needing to write any of the code yourself. All entries submitted for a Form Center form will be stored in the database and available to administrators for review.</p>
			</div>
		</div>

		<div class="form-group{{ ($errors->has('use_form_center')) ? ' has-error' : '' }}">
			<label class="col-md-2 control-label">Use Form Center</label>
			<div class="col-md-5">
				<div>
					<div class="radio">
						<label>{!! Form::radio('use_form_center', (int) true, true, ['v-model' => 'useFormCenter']) !!} Yes</label>
					</div>
					<div class="radio">
						<label>{!! Form::radio('use_form_center', (int) false, false, ['v-model' => 'useFormCenter']) !!} No</label>
					</div>
				</div>
				{!! $errors->first('use_form_center', '<p class="help-block">:message</p>') !!}
			</div>
		</div>

		<div v-show="useFormCenter == true">
			<div class="form-group{{ ($errors->has('allow_multiple_submissions')) ? ' has-error' : '' }}">
				<label class="col-md-2 control-label">Allow Multiple Submissions</label>
				<div class="col-md-5">
					<div>
						<div class="radio">
							<label>{!! Form::radio('allow_multiple_submissions', (int) true, true, ['v-model' => 'allowMultipleSubmissions']) !!} Yes</label>
						</div>
						<div class="radio">
							<label>{!! Form::radio('allow_multiple_submissions', (int) false, false, ['v-model' => 'allowMultipleSubmissions']) !!} No</label>
						</div>
					</div>
					<p class="help-block">Do you want users to be able to submit this form multiple times?</p>
					{!! $errors->first('allow_multiple_submissions', '<p class="help-block">:message</p>') !!}
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-2 control-label">Restrictions</label>
				<div class="col-md-8 col-lg-6">
					<div class="data-table data-table-striped data-table-bordered">
						<div class="row">
							<div class="col-sm-2 col-md-3"><p><strong>Type</strong></p></div>
							<div class="col-sm-8 col-md-6"><p><strong>Value</strong></p></div>
							<div class="col-sm-2 col-md-3"></div>
						</div>
						<div class="row" v-for="restriction in restrictions">
							<div class="col-sm-2 col-md-3">
								<p>@{{ restriction.type | capitalize }}</p>
							</div>
							<div class="col-sm-8 col-md-6">
								<p>{!! Form::select('restrictionValues[@{{ restriction.type }}]', $accessRoles, null, ['class' => 'form-control', 'v-model' => 'restriction.value', 'placeholder' => "No restriction"]) !!}</p>
							</div>
							<div class="col-sm-2 col-md-3">
								<p><a @click="clearRestriction(restriction)" class="btn btn-block btn-danger">{!! icon('close') !!}<span>Clear</span></a></p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="col-md-8 col-md-offset-2">
					<h3>Resources</h3>

					<p>Resources tell Nova what to do when action is taken on a a form entry (such as creating a new entry, updating an existing entry, or deleting an entry). In most cases, the defaults provided will do. You should only make changes to the resources when you know exactly what you're doing!</p>
				</div>
			</div>

			<div class="form-group{{ ($errors->has('resource_store')) ? ' has-error' : '' }}">
				<label class="col-md-2 control-label">Creation Resource</label>
				<div class="col-md-5">
					{!! Form::select('resource_store', $resourcesCreate, 'admin.form-center.storeEntry', ['class' => 'form-control input-lg', 'v-model' => 'resourceStore']) !!}
					{!! $errors->first('resource_store', '<p class="help-block">:message</p>') !!}
				</div>
			</div>

			<div class="form-group{{ ($errors->has('resource_update')) ? ' has-error' : '' }}">
				<label class="col-md-2 control-label">Update Resource</label>
				<div class="col-md-5">
					{!! Form::select('resource_update', $resourcesUpdate, 'admin.form-center.updateEntry', ['class' => 'form-control input-lg', 'v-model' => 'resourceUpdate']) !!}
					{!! $errors->first('resource_update', '<p class="help-block">:message</p>') !!}
				</div>
			</div>

			<div class="form-group{{ ($errors->has('resource_destroy')) ? ' has-error' : '' }}">
				<label class="col-md-2 control-label">Delete Resource</label>
				<div class="col-md-5">
					{!! Form::select('resource_destroy', $resourcesDelete, 'admin.form-center.destroyEntry', ['class' => 'form-control input-lg', 'v-model' => 'resourceDestroy']) !!}
					{!! $errors->first('resource_destroy', '<p class="help-block">:message</p>') !!}
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-5 col-md-offset-2">
				<mobile>
					<p>{!! Form::button("Add Form", ['class' => 'btn btn-primary btn-lg btn-block', 'type' => 'submit']) !!}</p>
				</mobile>
				<desktop>
					<div class="btn-toolbar">
						<div class="btn-group">
							{!! Form::button("Add Form", ['class' => 'btn btn-primary btn-lg', 'type' => 'submit']) !!}
						</div>
					</div>
				</desktop>
			</div>
		</div>
	{!! Form::close() !!}
</div>