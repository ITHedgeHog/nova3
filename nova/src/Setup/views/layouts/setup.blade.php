<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>@yield('title') &bull; {{ config('nova.app.name') }}</title>
		<meta name="author" content="Anodyne Productions">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<link href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
		<link href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,700" rel="stylesheet">
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
		<link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		{!! HTML::style('nova/src/Setup/views/design/css/setup.style.css') !!}
		{!! HTML::style('nova/src/Setup/views/design/css/setup.responsive.css') !!}
		{!! HTML::style('nova/src/Setup/views/design/css/setup.icons.css') !!}
		{!! HTML::style('nova/src/Setup/views/design/css/setup.hidpi2x.css', ['media' => 'only screen and (-moz-min-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2/1), only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min-device-pixel-ratio: 2)']) !!}
		{!! HTML::style('nova/src/Setup/views/design/css/setup.hidpi3x.css', ['media' => 'only screen and (-moz-min-device-pixel-ratio: 3), only screen and (-o-min-device-pixel-ratio: 3/1), only screen and (-webkit-min-device-pixel-ratio: 3), only screen and (min-device-pixel-ratio: 3)']) !!}
	</head>
	<body id="app">
		<header>
			<div class="container">
				<div class="row">
					<div class="col-sm-10">
						<span class="product">{{ config('nova.app.name') }} Setup</span>
						<span class="divider">/</span>
						<span class="process">@yield('header')</span>
					</div>
					<div class="col-sm-2">
						<div class="anodyne-logo pull-right"></div>
					</div>
				</div>
			</div>
		</header>

		<div class="container" id="app">
			<div class="row">
				<div class="col-md-3">
					<nav>
						{!! view('partials.steps-'.$_setupType) !!}
					</nav>

					<footer>
						&copy; {{ Date::now()->year }} Anodyne Productions
					</footer>
				</div>
				<div class="col-md-9">
					<main>
						<div class="content">
							{!! display_flash_message() !!}

							@yield('content')
						</div>

						<div class="controls">
							@yield('controls')
						</div>
					</main>
				</div>
			</div>
		</div>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.22/vue.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/0.7.0/vue-resource.js"></script>
		{!! HTML::script('nova/resources/js/vue-components.js') !!}
		{!! HTML::script('nova/resources/js/vue-filters.js') !!}
		{!! HTML::script('nova/resources/js/functions.js') !!}
		@yield('scripts')
	</body>
</html>