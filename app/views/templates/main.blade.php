<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>
			@section('title')
				{{ trans('flash.site_title') }}
			@show
		</title>
		<!-- CSS -->
		<?= stylesheet_link_tag() ?>
		<!--[if lt IE 9]>
			{{ HTML::script('packages/html5shiv/dist/html5shiv.min.js') }}
		<![endif]-->
	</head>
	<body>
		<!-- Navigation bar -->
		@include('templates.nav')
		<!-- Container -->
		<div class="container">
			<!-- Dispaly notifications if any -->
			@include('templates.notification')
			<!-- Content -->
			@yield('content')
		</div>
		<!-- Footer -->
		@include('templates.footer')

		<!-- Scripts -->
		<?= javascript_include_tag() ?>

		<!-- Page specific js -->
		@yield('javascript')
	</body>
</html>