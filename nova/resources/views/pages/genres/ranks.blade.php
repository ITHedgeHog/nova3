@extends('layouts.app')

@section('title', _m('genre-ranks'))

@section('content')
	<h1>{{ _m('genre-ranks') }}</h1>

	<div class="card-deck">
		<a href="{{ route('ranks.groups.index') }}" class="card">
			<div class="card-block">
				<div class="text-center text-subtle mb-4">{!! icon('list', 'fa-5x') !!}</div>
				<h4 class="card-title text-center">{{ _m('genre-rank-groups') }}</h4>
				<p class="card-text">{{ _m('genre-rank-groups-explain') }}</p>
			</div>
		</a>

		<a href="{{ route('ranks.info.index') }}" class="card">
			<div class="card-block">
				<div class="text-center text-subtle mb-4">{!! icon('info', 'fa-5x') !!}</div>
				<h4 class="card-title text-center">{{ _m('genre-rank-info') }}</h4>
				<p class="card-text">{{ _m('genre-rank-info-explain') }}</p>
			</div>
		</a>

		<a href="{{ route('ranks.items.index') }}" class="card">
			<div class="card-block">
				<div class="text-center text-subtle mb-4">{!! icon('star', 'fa-5x') !!}</div>
				<h4 class="card-title text-center">{{ _m('genre-rank-items') }}</h4>
				<p class="card-text">{{ _m('genre-rank-items-explain') }}</p>
			</div>
		</a>
	</div>
@endsection