<tr id="timeline-{{ $project->id }}" class="project-timeline" role="row">
	<td>
		<div class="progress">
			<?php $completed = 0; ?>
			@foreach($project->tasks as $task)
				@if($task->status == 'pending')
					<div class="progress-bar progress-bar-blank" style="width: {{ intval($task->actual_time) / $duration * 100 }}%">
				@elseif($task->status == 'complete')
					<?php $completed = $completed + intval($task->actual_time) ?>
					<div class="progress-bar progress-bar-success" style="width: {{ intval($task->actual_time) / $duration * 100 }}%">
				@elseif($task->status == 'in-progress')
					<div class="progress-bar progress-bar-warning" style="width: {{ intval($task->actual_time) / $duration * 100 }}%">
				@elseif($task->status == 'approved')
					<div class="progress-bar progress-bar-primary" style="width: {{ intval($task->actual_time) / $duration * 100 }}%">
				@endif
				{{ $task->actual_time.'-'.$duration }}
					{{ $task->equipment->process->name . ': ' . $task->equipment->name . '<br />' }}
					{{ trans('flash.duration') . ': ' . $task->actual_time . ' ' . trans_choice('flash.hour', $task->actual_time) . '<br />' }}
					{{ Form::select('status', $taskStatus, $task->status, array('data-task' => $task->id)) . '<br />' }}
					@if($task->finished_at)
						{{ HTML::image('images/on_schedule.png') }}
						{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $task->finished_at)->format('D/M j/g A') }}
					@else
						{{ HTML::image('images/off_schedule.png') }}
					@endif
				</div> 
			@endforeach
		</div>

		<div class="pull-right">
			{{ round($completed / $duration * 100, 2) . trans('flash.percent_complete') }}
		</div>
	</td>
</tr>

@section('javascript')
<script type="text/javascript">
    (function($) {
        $(document).ready(function() {
            $(".project-timeline td").attr("colspan", $("#project-list thead tr").children().length);
            var task;

            $("select[name='status']").change(function() {
            	$.ajax({
            		url: '/task/' + $(this).data('task') + '/saveStatus',
            		type: 'POST',
            		data: { status: this.value }
            	}).always(function(data) {
            		window.location = window.location.href.split('#')[0] + '#{{ $project->id }}';
            		window.location.reload();
            	});
            });
        })
    })(jQuery);
</script>
