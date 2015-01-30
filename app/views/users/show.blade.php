@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
@stop

{{-- Content --}}
@section('content')
	<h4>{{trans('pages.profile')}}</h4>
	
  	<div class="well clearfix">
	    <div class="col-md-8">
		    @if ($user->first_name)
		    	<p><strong>{{trans('users.fname')}}:</strong> {{ $user->first_name }} </p>
			@endif
			@if ($user->last_name)
		    	<p><strong>{{trans('users.lname')}}:</strong> {{ $user->last_name }} </p>
			@endif
		    <p><strong>{{trans('users.email')}}</strong> {{ $user->email }}</p>
			    
			<?php $userGroups = $user->getGroups(); ?>
			<b>Account Type:</b>
		    <ul>
		    	@if (count($userGroups) >= 1)
			    	@foreach ($userGroups as $group)
						<li>
						@if ($group->name == "Super Admin")
	                        Admin Level 1
	                    @elseif ($group->name == "Admin")
	                        Admin Level 2
	                    @else
	                        {{$group->name}}
	                    @endif
						</li>
					@endforeach
				@else 
					<li>{{trans('groups.notfound')}}</li>
				@endif
		    </ul>
		</div>
		<div class="col-md-4">
			<button class="btn btn-primary" onClick="location.href='{{ action('UserController@edit', array($user->id)) }}'">{{trans('pages.actionedit')}}</button>
		</div>
	</div>
	
@stop
