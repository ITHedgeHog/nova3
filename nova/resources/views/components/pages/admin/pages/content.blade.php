<div v-show="loading">
	<div v-show="!loadingWithError">
		<h4 class="text-center">{!! HTML::image('nova/resources/images/ajax-loader.gif') !!}</h4>
	</div>
	<div v-else>
		{!! alert('danger', "There was an error retrieving your page content from the database. This can be caused by a wrong URL or an issue with the database. Please try again.", "Error!") !!}
	</div>
</div>

<div v-else>
	<phone-tablet>
		@can('create', $content)
			<p><a href="{{ route('admin.content.create') }}" class="btn btn-success btn-lg btn-block">Add Page Content</a></p>
		@endcan

		<p><a href="{{ route('admin.pages') }}" class="btn btn-default btn-lg btn-block">Pages</a></p>
	</phone-tablet>
	<desktop>
		<div class="btn-toolbar">
			@can('create', $content)
				<div class="btn-group">
					<a href="{{ route('admin.content.create') }}" class="btn btn-success">Add Page Content</a>
				</div>
			@endcan

			<div class="btn-group">
				<a href="{{ route('admin.pages') }}" class="btn btn-default">Pages</a>
			</div>
		</div>
	</desktop>

	<div class="row">
		<div class="col-md-3 col-md-push-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Filter Page Content</h3>
				</div>
				<div class="panel-body">
					<div class="form-group">
						<label class="control-label">By Key</label>
						{!! Form::text('searchKey', null, ['class' => 'form-control', 'v-model' => 'key']) !!}
					</div>

					<div class="form-group">
						<label class="control-label">By Value</label>
						{!! Form::text('searchValue', null, ['class' => 'form-control', 'v-model' => 'value']) !!}
					</div>
				</div>

				<div class="panel-footer">
					<phone-tablet>
						<a class="btn btn-default btn-lg btn-block" @click="resetFilters">Reset Filters</a>
					</phone-tablet>
					<desktop>
						<a class="btn btn-default btn-block" @click="resetFilters">Reset Filters</a>
					</desktop>
				</div>
			</div>
		</div>

		<div class="col-md-9 col-md-pull-3" v-show="contents.length == 0">
			{!! alert('warning', "No additional page content found.") !!}
		</div>

		<div class="col-md-9 col-md-pull-3" v-else>
			<div class="data-table data-table-bordered data-table-striped">
				<div class="row" v-for="content in contents | filterBy key in 'key' | filterBy value in 'value'">
					<div class="col-md-9">
						<p>{% content.preview %}</p>
						<p><strong>Key:</strong> {% content.key %}</p>
						<p><strong>Type:</strong> <span class="label label-default">{% content.type %}</span></p>
					</div>
					<div class="col-md-3">
						<div class="visible-xs visible-sm">
							<div class="row">
								@can('edit', $content)
									<div class="col-sm-6">
										<p><a href="{% content.links.edit %}" class="btn btn-default btn-lg btn-block">Edit</a></p>
									</div>
								@endcan

								@can('remove', $content)
									<div class="col-sm-6" v-show="!content.protected">
										<p><a href="#" data-id="{% content.id %}" data-action="remove" class="btn btn-danger btn-lg btn-block js-contentAction">Remove</a></p>
									</div>
								@endcan
							</div>
						</div>
						<div class="visible-md visible-lg">
							<div class="btn-toolbar pull-right">
								@can('edit', $content)
									<div class="btn-group">
										<a href="{% content.links.edit %}" class="btn btn-default">Edit</a>
									</div>
								@endcan

								@can('remove', $content)
									<div class="btn-group" v-show="!content.protected">
										<a href="#" data-id="{% content.id %}" data-action="remove" class="btn btn-danger js-contentAction">Remove</a>
									</div>
								@endcan
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@can('remove', $content)
	{!! modal(['id' => "removeContent", 'header' => "Remove Page Content"]) !!}
@endcan