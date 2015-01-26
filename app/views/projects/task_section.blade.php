<div class="col-md-6">
	<div class="well">
		<div class="row">
			<div class="col-sm-6">
				<h2>{{ trans('flash.task') }}</h2>
			</div>
			<div class="col-sm-6 text-right">
				{{ html_entity_decode(Form::button(HTML::span(null, array('class' => 'glyphicon glyphicon-plus')), 
												   array('class' => 'btn btn-sm btn-success', 'id' => 'addTask'))) }}
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="tasks">
					@if(isset($project))
						@foreach($project->tasks as $t)
							<div class="panel panel-info">
								<div class="panel-heading">
									<h4 class="panel-title pull-left">
										<a data-toggle="collapse" href="#taskCreator{{ $t->id }}" class="collapsed">
											{{ $t->equipment->process->name }} ({{ $t->equipment->name }}) - {{ $t->actual_time . ' ' . trans_choice('flash.hour', $t->actual_time) }} - {{ $t->status }}
										</a>
									</h4>
									<div class="col-md-2 pull-right text-right" style="padding: 0px;">
										{{ html_entity_decode(Form::button(HTML::span(null, array("class" => "glyphicon glyphicon-trash")), array("class" => "btn btn-danger btn-sm", "data-toggle" => "modal", "data-target" => "#taskDelete"))) }}
									</div>
									<div class="clearfix"></div>
								</div>
								<div id="taskCreator{{ $t->id }}" class="panel-collapse collapse">
									<div class="panel-body">
										<div class="form-group">
											{{ Form::label("equipment", trans("flash.equipment")) }}
											{{ Form::select("equipment_id", $equipments, $t->equipment_id, array("class" => "form-control")) }}
										</div>
										<div class="form-group">
											{{ Form::label("actual_time", trans("flash.duration")) }}
											{{ Form::number("actual_time", $t->actual_time, array("class" => "form-control", "min" => 0)) }}
										</div>
										<div class="form-group">
											{{ Form::label("notes", trans("flash.notes")) }}
											{{ Form::textarea("notes", $t->notes, array("class" => "form-control", "rows" => 2)) }}
										</div>
										<div class="form-group">
											{{ Form::label("status", trans("flash.status")) }}
											{{ Form::select("status", $taskStatus, $t->status, array("class" => "form-control")) }}
										</div>
									</div>
								</div>
							</div>
						@endforeach
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="taskDelete" tabindex="-1" role="dialog" aria-labelledby="taskDeleteLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="taskDeleteLabel">{{ trans('flash.delete_task') }}</h4>
			</div>
			<div class="modal-body">{{ trans('flash.confirm_delete_task') }}</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('flash.cancel') }}</button>
				<button type="button" class="btn btn-primary delete">{{ trans('flash.yes') }}</button>
			</div>
		</div>
	</div>
</div>