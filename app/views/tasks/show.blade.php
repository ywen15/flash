<div class="row" style="font-family: helvetica;">
	<div class="col-md-12">
		<h3 style="margin:0px;padding-bottom:5px;"><b>Project Specs</b></h3>
		<table class="indv-task">
			<tr>
				<td><b>Docket:</b></td>
				<td>{{ $task->project->docket }}</td>
			</tr>
			<tr>
				<td><b>Customer:</b></td>
				<td>{{ $task->project->customer->name }}</td>
			</tr>
			<tr>
				<td><b>Project Manager:</b></td>
				<td>
				@if ($task->project->pm)
					{{-- $task->project->pm->first_name . $task->project->pm->last_name --}}
				@endif
				</td>
			</tr>
			<tr>
				<td><b>Quantity:</b></td>
				<td>{{ $task->project->quantity }}</td>
			</tr>
			@if ($task->project->stock)
			<tr>
				<td><b>Stock:</b></td>
				<td>{{ $task->project->stock }}</td>
			</tr>
			@endif
			@if ($task->project->notes)
			<tr>
				<td><b>Notes:</b></td>
				<td>{{ $task->project->notes }}</td>
			</tr>
			@endif
			<tr>
				<td><b>Rep:</b></td>
				<td>{{-- $task->project->rep->first_name . $task->project->rep->last_name --}}</td>
			</tr>
		</table>

		<h3 style="margin:0px;padding:5px 0px;"><b>Task</b></h3>
		<table class="indv-task">
			<tr>
				<td><b>Process:</b></td>
				<td>{{ $task->equipment->process->name }}</td>
			</tr>
			<tr>
				<td><b>Equipment:</b></td>
				<td>{{ $task->equipment->name }}</td>
			</tr>
			<tr>
				<td><b>Duration:</b></td>
				<td>{{ $task->actual_time . trans_choice('flash.hour', $task->actual_time) }}</td>
			</tr>
			@if ($task->notes)
			<tr>
				<td><b>Notes:</b></td>
				<td>{{ $task->notes }}</td>
			</tr>
			@endif
			<tr>
				<td><b>Status:</b></td>
				<td>
				
					{{ Form::select('status', $taskStatus, $task->status, array('class' => 'form-control status', 'id' => 'status')) }}

				</td>
			</tr>
		</table>
	</div>
</div>

<script>
$(".status").change(function(){
	var self = $(this);
	$.ajax({
		url: '/task/' + {{ $task->id }} + '/saveStatus',
		type: 'POST',
		data: { id: '{{$task->id}}', status: self.val() },
		success: function(data) {
			calendar.weekCalendar('refresh');
			//populate_tasks();
		}
	});
});
</script>
