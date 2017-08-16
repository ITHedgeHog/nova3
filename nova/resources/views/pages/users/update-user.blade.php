@extends('layouts.app')

@section('title', _m('users-update'))

@section('content')
	<h1>{{ _m('users-update') }}</h1>

	{!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'patch']) !!}
		<div class="row">
			<div class="col-md-4">
				<div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
					<label class="form-control-label">{{ _m('name') }}</label>
					{!! Form::text('name', null, ['class' => 'form-control'.($errors->has('name') ? ' form-control-danger' : '')]) !!}
					{!! $errors->first('name', '<p class="form-control-feedback">:message</p>') !!}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
					<label class="form-control-label">{{ _m('email-address') }}</label>
					{!! Form::email('email', null, ['class' => 'form-control'.($errors->has('email') ? ' form-control-danger' : '')]) !!}
					{!! $errors->first('email', '<p class="form-control-feedback">:message</p>') !!}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label class="form-control-label">{{ _m('users-nickname') }}</label>
					{!! Form::text('nickname', null, ['class' => 'form-control']) !!}
					<small class="form-text text-muted">{{ _m('users-nickname-explain') }}</small>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label class="form-control-label">{{ _m('users-gender') }}</label>
					<div>
						{!! Form::select('gender', $genders, null, ['class' => 'custom-select']) !!}
					</div>
					<small class="form-text text-muted">{{ _m('users-gender-explain') }}</small>
				</div>
			</div>
		</div>

		<div class="row">
			@if ($user->characters->count() > 0)
				<div class="col-md-4">
					<div class="form-group">					
						<label class="form-control-label">{{ _m('users-primary-character') }}</label>
						<div>
							@if ($user->primaryCharacter)
								<character-picker :items="{{ $user->characters }}"
												  field-name="primary_character"
												  :selected="{{ $user->primaryCharacter }}"
												  :show-status="true">
								</character-picker>
							@else
								<character-picker :items="{{ $user->characters }}"
												  field-name="primary_character"
												  :show-status="true">
								</character-picker>
							@endif
						</div>
					</div>
				</div>
			@else
				<div class="col-md-6">
					<div class="form-group">
						<label class="form-control-label">{{ _m('users-primary-character') }}</label>
						<div class="alert alert-warning">
							{{ _m('users-error-no-characters') }} <a href="{{ route('characters.link') }}" class="alert-link">{{ _m('users-error-assign-character') }}</a>
						</div>
					</div>
				</div>
			@endif
		</div>

		<fieldset>
			<legend>{{ _m('image', [1]) }}</legend>
			<media-manager :item="{{ $user }}" type="user" :allow-multiple="false"></media-manager>
		</fieldset>

		<div class="row">
			<div class="col-md-8">
				<fieldset>
					<legend>{{ _m('authorize-roles') }}</legend>

					<div class="row">
						@foreach ($roles as $role)
							<div class="col-md-4 mb-3">
								<label class="custom-control custom-checkbox">
									{!! Form::checkbox('roles[]', $role->id, null, ['class' => 'custom-control-input']) !!}
									<span class="custom-control-indicator"></span>

									<span class="custom-control-description">{{ $role->name }}</span>

									<span class="ml-1"
										  data-toggle="popover"
										  data-trigger="hover"
										  data-placement="top"
										  title="{{ _m('authorize-roles-can') }}"
										  data-content="{{ $role->present()->includedPermissions }}">
										{!! icon('question', 'text-muted') !!}
									</span>
								</label>
							</div>
						@endforeach
					</div>
				</fieldset>
			</div>
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-primary mr-2">{{ _m('users-update') }}</button>
			<a href="{{ route('users.index') }}" class="btn btn-link">{{ _m('cancel') }}</a>
		</div>
	{!! Form::close() !!}
@endsection