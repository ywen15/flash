<div class="row">
	<div class="col-sm-12">
		<ul class="nav nav-tabs" role="tablist">
			@foreach($processes as $p)
				<li class="{{ (isset($process) && $process->id == $p->id) ? 'active' : '' }}">
					{{ link_to('scheduler/'.$p->name, $p->name) }}
				</li>
			@endforeach
		</ul>
	</div>

	<div class="col-sm-12 upcoming">
		<div class="col-sm-12 ">
			<h5><a data-toggle="collapse" href="#upcoming-tasks">{{ trans('flash.upcoming_tasks') . HTML::span(null, array('class' => 'glyphicon glyphicon-plus')) }}</a></h5>
		</div>
		<div class="col-md-12 collapse" id="upcoming-tasks">
			@if(isset($process))
				<ul class="list-group cursor-list">
					@foreach($process->scheduled_tasks() as $t)
						<li class="list-group-item">
							{{ $t->equipment->name }} - {{ $t->project->description }} - {{ $t->project->docket }} - {{ $t->project->customer->name }} - {{ trans('flash.'.$t->status) }} - {{ $t->started_at->format('l, F d, Y') }} ({{ $t->started_at->format('gA') . ' - ' . $t->finished_at->format('gA') }})
						</li>
					@endforeach
				</ul>
			@endif
		</div>
	</div>
</div>