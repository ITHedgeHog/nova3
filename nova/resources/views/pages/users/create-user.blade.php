@extends('layouts.app')

@section('title', _m('user-add'))

@section('content')
	<h1>{{ _m('user-add') }}</h1>

	{!! Form::open(['route' => 'users.store']) !!}
		<div class="row">
			<div class="col-md-4">
				<div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
					<label class="form-control-label sr-only">{{ _m('name') }}</label>
					{!! Form::text('name', null, ['class' => 'form-control'.($errors->has('name') ? ' form-control-danger' : ''), 'placeholder' => _m('name')]) !!}
					{!! $errors->first('name', '<p class="form-control-feedback">:message</p>') !!}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
					<label class="form-control-label sr-only">{{ _m('email-address') }}</label>
					{!! Form::email('email', null, ['class' => 'form-control'.($errors->has('email') ? ' form-control-danger' : ''), 'placeholder' => _m('email-address')]) !!}
					{!! $errors->first('email', '<p class="form-control-feedback">:message</p>') !!}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label class="form-control-label sr-only">{{ _m('nickname') }}</label>
					{!! Form::text('nickname', null, ['class' => 'form-control', 'placeholder' => _m('nickname')]) !!}
					<small class="form-text text-muted">{{ _m('user-nickname-explain') }}</small>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
				<fieldset>
					<legend>{{ _m('authorize-roles') }}</legend>

					<div class="row">
						@foreach ($roles as $role)
							<div class="col-md-4 mb-3">
								<div class="form-check">
									<label class="form-check-label">
										{!! Form::checkbox('roles[]', $role->id, null, ['class' => 'form-check-input']) !!}
										
										{{ $role->name }}
										
										<i class="fa fa-fw fa-question-circle text-muted" data-toggle="popover" data-trigger="hover" data-placement="top" title="{{ _m('authorize-role-can') }}" data-content="{{ $role->present()->includedPermissions }}"></i>
									</label>
								</div>
							</div>
						@endforeach
					</div>
				</fieldset>
			</div>
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-primary">{{ _m('user-add') }}</button>
			<a href="{{ route('users.index') }}" class="btn btn-link">{{ _m('cancel') }}</a>
		</div>
	{!! Form::close() !!}
@endsection