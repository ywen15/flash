<div class="panel-group" id="accordion">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title text-center">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="font-size: 16px;">{{ trans('flash.to_do_list') }}</a>
			</h4>
		</div>
		<div id="collapseOne" class="panel-collapse collapse in">
			<ul class="list-group">
				@foreach($processes as $p)
					<li class="list-group-item">
						{{ HTML::image('images/process.png') }}
						<a href="#collapse{{ $p->id }}" data-toggle="collapse">
							{{ $p->name }}
							<span class="badge pull-right" data-process="{{ $p->id }}"></span>
						</a>

						<?php $tasks = null; $process_total = 0; ?>
						<ul class="list-group collapse {{ (isset($process) && $process->id == $p->id) ? 'in' : null }}" id="collapse{{ $p->id }}">
							@foreach($p->equipments as $e)
								<?php $tasks = $e->unscheduled(); ?>
								@if(count($tasks) > 0)
									<li class="list-group-item">
										{{ HTML::image('images/equipment.png') }}
										<a href="#collapse{{ $p->id . $e->id }}" data-toggle="collapse">
											{{ $e->name }}
											<span class="badge pull-right">{{ count($tasks) }}</span>
										</a>
										<ul class="list-group collapse in" id="collapse{{ $p->id . $e->id }}">
											@foreach($tasks as $t)
												<li class="list-group-item" data-task="{{ $t->id }}">
													{{ HTML::image('images/task.png') }}
													{{ $t->project->description }} - {{ $t->project->docket }} - {{ $t->project->customer->name }}
												</li>
											@endforeach
											{{ Form::hidden('equipment-'.$e->id, count($tasks)) }}
											<?php $process_total = $process_total + count($tasks); ?>
										</ul>
									</li>
								@endif
							@endforeach
							{{ Form::hidden($p->id, $process_total) }}
						</ul>
					</li>
				@endforeach
			</ul>
		</div>
	</div>
</div>
