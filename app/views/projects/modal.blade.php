<div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="projectModalLabel">{{ $project->description.' / '.$project->docket.' / '.$project->customer->name.' / '.$project->quantity }}</h4>
			</div>

			@if($type == 'destroy')
				<div class="modal-body">
					{{ trans('flash.confirm_delete') }}
				</div>

				{{ Form::open(array('route' => array('project.'.$type, $project->id), 'method' => 'delete', 'role' => 'form')) }}
				<div class="modal-footer">
					{{ Form::button(trans('flash.cancel'), array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal')) }}
					{{ Form::submit(trans('flash.yes'), array('type' => 'button', 'class' => 'btn btn-primary')) }}
				</div>
			@elseif($type == 'reset')
				<div class="modal-body">
					{{ trans('flash.confirm_reset') }}
				</div>

				{{ Form::open(array('action' => array('ProjectController@reset', $project->id), 'method' => 'get', 'role' => 'form')) }}
				<div class="modal-footer">
					{{ Form::button(trans('flash.cancel'), array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal')) }}
					{{ Form::submit(trans('flash.yes'), array('type' => 'button', 'class' => 'btn btn-primary')) }}
				</div>
			@endif

			{{ Form::close() }}

		</div>
	</div>
</div>
