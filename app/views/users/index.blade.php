@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
@stop

{{-- Content --}}
@section('content')
<h4>{{trans('pages.currentusers')}}:</h4>
@if (Sentry::getUser()->hasAccess('Admin'))
<a href="{{action('UserController@create')}}"><button type="button" class="btn btn-primary btn-sm pull-right">Create User</button></a>
@endif
<div class="row">
  <div class="col-md-10 col-md-offset-1">
	<div class="table-responsive">
		<table class="table table-striped table-hover">
			<thead>
				<th>{{trans('pages.user')}}</th>
				<th>{{trans('pages.cat')}}</th>
				<th>{{trans('pages.status')}}</th>
				<th>{{trans('pages.options')}}</th>
			</thead>
			<tbody>
				@foreach ($users as $user)
					<tr>
						<td><a href="{{ action('UserController@show', array($user->id)) }}">{{ $user->email }}</a></td>
						<td>
							@if ($user->groups()->first() && $user->groups()->first()->name == "Super Admin")
								Admin Level 1
							@elseif ($user->groups()->first() && $user->groups()->first()->name == "Admin")
								Admin Level 2
							@else
								{{$user->groups()->first() ? $user->groups()->first()->name : ''}}
							@endif
						</td>
						<td>@if ($user->status=='active')
							{{trans('pages.active')}}
						 @else
						 	{{trans('pages.notactive')}}
						 @endif
						 </td>
						
						<td>
							<button class="btn btn-default" type="button" onClick="location.href='{{ action('UserController@edit', array($user->id)) }}'">{{trans('pages.actionedit')}}</button> 
							
							<button class="btn btn-default" 
									data-token="{{ Session::getToken() }}" 
									data-toggle="modal" 
									data-target="#deleteModal" 
									data-user="{{ $user->id }}">{{trans('pages.actiondelete')}}</button></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this user?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary delete">Yes</button>
      </div>
    </div>
  </div>
</div>
@stop

{{-- Javascript --}}
@section('javascript')
<script>
function getUserInfo(id) {
	$.ajax({
		url: root+'/users/'+id+'/getinfo',
		type: 'GET',
		success: function(data) {
			$('h4.modal-title').text(data.first_name + ' ' + data.last_name + ' (' + data.email + ') ' );
		}
	});
}

$('#deleteModal').on('shown.bs.modal', function (e) {
  getUserInfo( $(e.relatedTarget).data('user') );
  var self = $(this);
  $(this).find('.delete').click(function(){
    $.ajax({
        url: root+'/users/'+$(e.relatedTarget).data('user')+'/destroy',
        type: 'GET',
        success: function(data) {
          window.location.href = "{{action('UserController@index')}}";
        }
    });
  });
});
$('#deleteModal').on('hidden.bs.modal', function (e) {
  $(this).find('.delete').unbind('click');
});

</script>
@stop