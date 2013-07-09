<div class="btn-toolbar">
	@if (Sentry::getUser()->hasAccess('role.create'))
		<div class="btn-group">
			<a href="{{ URL::to('admin/role/0') }}" class="btn btn-success icn-size-16">{{ $_icons['add'] }}</a>
		</div>
	@endif

	<div class="btn-group">
		<a href="{{ URL::to('admin/role/tasks') }}" class="btn btn-default icn-size-16 tooltip-top" title="{{ lang('Short.manage', langConcat('access tasks')) }}">{{ $_icons['list'] }}</a>
	</div>
</div>

@if (count($roles) > 0)
	<div class="nv-data-table nv-data-table-striped nv-data-table-bordered">
		@foreach ($roles as $r)
			<div class="row">
				<div class="col-12 col-sm-8 col-lg-9">
					<p><strong>{{ $r->name }}</strong></p>
					<p class="text-muted text-small">{{ $r->desc }}</p>
				</div>
				<div class="col-12 col-sm-4 col-lg-3">
					<div class="hidden-sm">
						<div class="btn-toolbar pull-right">
							<div class="btn-group">
								<a href="#" class="btn btn-small btn-default tooltip-top js-role-action icn-size-16" title="{{ lang('Short.view', langConcat('users with this role')) }}" data-action="view" data-id="{{ $r->id }}">{{ $_icons['view'] }}</a>
								
								@if (Sentry::getUser()->hasAccess('role.update'))
									<a href="{{ URL::to('admin/role/'.$r->id) }}" class="btn btn-small btn-default icn-size-16">{{ $_icons['edit'] }}</a>
								@endif

								@if (Sentry::getUser()->hasAccess('role.create'))
									<a href="#" class="btn btn-small btn-default js-role-action icn-size-16 tooltip-top" title="{{ lang('Short.duplicate', lang('role')) }}" data-action="duplicate" data-id="{{ $r->id }}">{{ $_icons['duplicate'] }}</a>
								@endif
							</div>

							@if (Sentry::getUser()->hasAccess('role.delete'))
								<div class="btn-group">
									<a href="#" class="btn btn-small btn-danger js-role-action icn-size-16" data-action="delete" data-id="{{ $r->id }}">{{ $_icons['remove'] }}</a>
								</div>
							@endif
						</div>
					</div>
					<div class="visible-sm">
						<div class="row">
							<div class="col-6">
								<p><a href="#" class="btn btn-block btn-default js-role-action icn-size-16" data-action="view" data-id="{{ $r->id }}">{{ $_icons['view'] }}</a></p>
							</div>
								
							@if (Sentry::getUser()->hasAccess('role.update'))
								<div class="col-6">
									<p><a href="{{ URL::to('admin/role/'.$r->id) }}" class="btn btn-block btn-default icn-size-16">{{ $_icons['edit'] }}</a></p>
								</div>
							@endif

							@if (Sentry::getUser()->hasAccess('role.create'))
								<div class="col-6">
									<p><a href="#" class="btn btn-block btn-default js-role-action icn-size-16"  data-action="duplicate" data-id="{{ $r->id }}">{{ $_icons['duplicate'] }}</a></p>
								</div>
							@endif

							@if (Sentry::getUser()->hasAccess('role.delete'))
								<div class="col-6">
									<p><a href="#" class="btn btn-block btn-danger js-role-action icn-size-16" data-action="delete" data-id="{{ $r->id }}">{{ $_icons['remove'] }}</a></p>
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
@else
	{{ partial('common/alert', ['content' => lang('error.notFound', langConcat('access roles'))]) }}
@endif