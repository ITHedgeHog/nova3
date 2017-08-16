@extends('layouts.app')

@section('title', 'Quick Link')

@section('content')
	<h1>Quick Link</h1>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="form-control-label">{{ _m('users', [1]) }}</label>
				<div>
					<user-picker></user-picker>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="form-control-label">{{ _m('characters', [1]) }}</label>
				<div>
					<character-picker :show-status="true"></character-picker>
				</div>
			</div>
		</div>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-primary">{{ _m('characters-add') }}</button>
		<a href="{{ route('characters.index') }}" class="btn btn-link">{{ _m('cancel') }}</a>
	</div>
@endsection

@section('js')
	<script>
		vue = {}
	</script>
@endsection