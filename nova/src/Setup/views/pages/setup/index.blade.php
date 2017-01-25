@extends('layouts.setup-landing')

@inject('setup', 'nova.setup')

@section('title')
	Setup Center
@stop

@section('header')
	Setup Center
@stop

@section('content')
	@if ( ! $installed)
		<div class="row">
			<div class="col-lg-6">
				<div class="card text-center animate flipInX">
					<div class="card-block">
						<h1>Fresh Install</h1>
						<div>
							@icon('nova/src/Setup/views/design/images/new_releases')
						</div>
						<p><a href="{{ route('setup.install') }}" class="btn btn-primary btn-lg btn-block">Install {{ config('nova.app.name') }}</a></p>
					</div>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="card text-center animate flipInX">
					<div class="card-block">
						<h1>Upgrade from Nova 2</h1>
						<div>
							@icon('nova/src/Setup/views/design/images/exit_to_app')
						</div>
						<p><a href="#" class="btn btn-link btn-lg btn-block disabled">Not Available</a></p>
					</div>
				</div>
			</div>
		</div>
	@else
		<div class="row">
			<div class="col-lg-6">
				<div class="card text-center animate flipInX">
					<div class="card-block">
						<h1>Update {{ config('nova.app.name') }}</h1>
						<div>
							@icon('nova/src/Setup/views/design/images/cloud_done')
						</div>
						<p><a href="#" class="btn btn-link btn-lg btn-block disabled">Not Available</a></p>
					</div>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="card text-center animate flipInX">
					<div class="card-block">
						<h1>Uninstall</h1>
						<div>
							@icon('nova/src/Setup/views/design/images/delete')
						</div>
						{!! Form::open(['route' => 'setup.uninstall']) !!}
							<p>{!! Form::button('Remove '.config('nova.app.name'), ['type' => 'submit', 'class' => 'btn btn-danger btn-lg btn-block']) !!}</p>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	@endif
@stop