@if ($message = Session::get('success'))
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>{{ $message }}
	</div>
	{{ Session::forget('error') }}
@endif

@if ($message = Session::get('error'))
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>{{ $message }}
	</div>
	{{ Session::forget('error') }}
@endif
