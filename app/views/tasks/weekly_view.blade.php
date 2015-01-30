<div class="row">
	<div class="col-md-12">
		<table id="weekly-table" class="table table-bordered">
			<thead>
				<tr>
					<td class="col-md-2">{{ $start->format('D/M/j') }}</td>
					<td class="col-md-2">{{ $start->addDay()->format('D/M/j') }}</td>
					<td class="col-md-2">{{ $start->addDay(2)->format('D/M/j') }}</td>
					<td class="col-md-2">{{ $start->addDay(3)->format('D/M/j') }}</td>
					<td class="col-md-2">{{ $start->addDay(4)->format('D/M/j') }}</td>
					<td class="col-md-1">{{ $start->addDay(5)->format('D/M/j') }}</td>
					<td class="col-md-1">{{ $start->addDay(6)->format('D/M/j') }}</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					@foreach ($tasks as $key => $task)
						<td>
						@foreach ($task as $t)
							<div class="panel panel-default" style="background-color: #{{ $t->project->rep['colour'] }}">
								<span class="glyphicon glyphicon-plus"></span>
								<strong>{{ $t->project->description }}</strong><br />
								<div class='task-details'>
									{{ $t->started_at->format('g:iA') }} - {{ $t->finished_at->format('g:iA') }}<br />
									Docket: {{ $t->project->docket }}<br />
									Rep: {{ $t->project->rep['first_name'] . ' ' . $t->project->rep['last_name'] }}<br />
									@if($t->project->pm) 
										PM: {{ $t->project->pm['first_name'] . ' ' . $t->project->pm['last_name'] }}<br />
										Status: {{ trans('flash.'.$t->status) }}<br />
										Due: {{ $t->due }}<br />
										Days Left: {{ Carbon\Carbon::now()->diffInDays($t->project()->first()->due_at, false) }} day(s)
									@endif
								</div>
							</div>
						@endforeach
						</td>
					@endforeach
				</tr>
			</tbody>
		</table>
	</div>
</div>