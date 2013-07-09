@if (Sentry::getUser()->hasAccess('routes.create'))
	<div class="btn-toolbar">
		<div class="btn-group">
			<a href="#" class="btn btn-success icn-size-16 js-route-action" data-action="add">{{ $_icons['add'] }}</a>
		</div>
	</div>
@endif

<ul class="nav nav-tabs">
	<li class="active"><a href="#routesUser" data-toggle="tab">{{ langConcat('User_created Routes') }}</a></li>
	<li><a href="#routesCore" data-toggle="tab">{{ langConcat('Core Routes') }}</a></li>
</ul>

<div class="tab-content">
	<div id="routesUser" class="tab-pane active">
		@if (isset($routes['user']))
			<div class="row">
				<div class="col-12 col-sm-6 col-lg-4">
					<div class="control-group">
						{{ Form::text('', null, ['id' => 'searchUserRoutes', 'placeholder' => lang('Short.search', langConcat('User_created Routes'))]) }}
					</div>
				</div>
			</div>

			<div class="nv-data-table nv-data-table-striped nv-data-table-bordered" id="userRoutes">
			@foreach ($routes['user'] as $route)
				<div class="row">
					<div class="col-12 col-sm-10 col-lg-11">
						<p><strong>{{ $route->uri }}</strong></p>
						<p class="text-small">{{ $route->resource }}</p>
					</div>
					<div class="col-12 col-sm-2 col-lg-1">
						@if (Sentry::getUser()->hasAccess('routes.create'))
							<div class="btn-group pull-right hidden-sm">
								<a href="#" class="btn btn-default icn-size-16 js-route-action" data-route="{{ $route->id }}" data-action="duplicate">{{ $_icons['duplicate'] }}</a>
							</div>
							<p class="visible-sm">
								<a href="#" class="btn btn-block btn-default icn-size-16 js-route-action" data-route="{{ $route->id }}" data-action="duplicate">{{ $_icons['duplicate'] }}</a>
							</p>
						@endif
					</div>
				</div>
			@endforeach
			</div>
		@else
			{{ partial('common/alert', ['content' => lang('error.notFound', langConcat('user_created routes'))]) }}
		@endif
	</div>

	<div id="routesCore" class="tab-pane">
		@if (isset($routes['core']))
			<div class="row">
				<div class="col-12 col-sm-6 col-lg-4">
					<div class="control-group">
						{{ Form::text('', null, ['id' => 'searchCoreRoutes', 'placeholder' => lang('Short.search', langConcat('Core Routes'))]) }}
					</div>
				</div>
			</div>

			<div class="nv-data-table nv-data-table-striped nv-data-table-bordered" id="coreRoutes">
			@foreach ($routes['core'] as $route)
				<div class="row">
					<div class="col-12 col-sm-10 col-lg-11">
						<p><strong>{{ $route->uri }}</strong></p>
						<p class="text-small">{{ $route->resource }}</p>
					</div>
					<div class="col-12 col-sm-2 col-lg-1">
						@if (Sentry::getUser()->hasAccess('routes.create'))
							<div class="btn-group pull-right hidden-sm">
								<a href="#" class="btn btn-default icn-size-16 js-route-action" data-route="{{ $route->id }}" data-action="duplicate">{{ $_icons['duplicate'] }}</a>
							</div>
							<p class="visible-sm">
								<a href="#" class="btn btn-block btn-default icn-size-16 js-route-action" data-route="{{ $route->id }}" data-action="duplicate">{{ $_icons['duplicate'] }}</a>
							</p>
						@endif
					</div>
				</div>
			@endforeach
			</div>
		@else
			{{ partial('common/alert', ['content' => lang('error.notFound', langConcat('core routes'))]) }}
		@endif
	</div>
</div>