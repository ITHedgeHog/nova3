@extends('layouts.app')

@section('content')
	<h1>{{ $user->present()->name }}</h1>

	@can('updateProfile', $user)
		<mobile>
			<p><a href="{{ route('profile.edit', $user) }}" class="btn btn-secondary btn-block">{{ _m('user-profile-update') }}</a></p>
		</mobile>

		<desktop>
			<div class="btn-toolbar">
				<div class="btn-group">
					<a href="{{ route('profile.edit', $user) }}" class="btn btn-secondary">{{ _m('user-profile-update') }}</a>
				</div>
			</div>
		</desktop>
	@endcan

	<ul>
		<li>Show last 10 story entries</li>
		<li>Show last sign in</li>
		<li>Show some stats</li>
		<li>Show social media links</li>
		<li>Show all characters tied to the account</li>
	</ul>
@endsection