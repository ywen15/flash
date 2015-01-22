<div class="modal fade" id="projectDelete" tabindex="-1" role="dialog" aria-labelledby="projectDeleteLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="projectDeleteLabel">{{ $project->description.' / '.$project->docket.' / '.$project->customer->name.' / '.$project->quantity }}</h4>
			</div>

			<div class="modal-body">
				{{ trans('flash.confirm_delete') }}
			</div>

			{{ Form::open(array('route' => array('project.destroy', $project->id), 'method' => 'delete', 'role' => 'form')) }}
			<div class="modal-footer">
				{{ Form::button(trans('flash.cancel'), array('type' => 'button', 'class' => 'btn btn-default')) }}
				{{ Form::submit(trans('flash.yes'), array('type' => 'button', 'class' => 'btn btn-primary')) }}
			</div>
			{{ Form::close() }}

		</div>
	</div>
</div>
