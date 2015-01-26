<div class="col-md-6">
	<div class="well">
		<h2>{{ trans('flash.project') }}</h2>
		<div class="form-group">
			{{ Form::label('description', trans('flash.description')) }}
			{{ Form::text('description', isset($project) ? $project->description : null, array('class' => 'form-control', 'id' => 'description')) }}
		</div>
		<div class="form-group">
			{{ Form::label('docket', trans('flash.docket')) }}
			{{ Form::text('docket', isset($project) ? $project->docket : null, array('class' => 'form-control', 'id' => 'docket')) }}
		</div>
		<div class="form-group">
			{{ Form::label('customer', trans('flash.customer')) }}
			{{ Form::select('customer_id', $customers, isset($project) ? $project->customer_id : null, array('class' => 'form-control', 'id' => 'customer')) }}
		</div>
		<div class="form-group">
			{{ Form::label('quantity', trans('flash.quantity')) }}
			{{ Form::text('quantity', isset($project) ? $project->quantity : null, array('class' => 'form-control', 'id' => 'quantity')) }}
		</div>
		<div class="form-group">
			{{ Form::label('stock', trans('flash.stock')) }}
			{{ Form::textarea('stock', isset($project) ? $project->stock : null, array('class' => 'form-control', 'id' => 'stock', 'rows' => '2')) }}
		</div>
		<div class="form-group">
			{{ Form::label('notes', trans('flash.notes')) }}
			{{ Form::textarea('notes', isset($project) ? $project->notes : null, array('class' => 'form-control', 'id' => 'notes', 'rows' => '2')) }}
		</div>
		<div class="form-group">
			{{ Form::label('rep', trans('flash.rep')) }}
			{{ Form::select('rep_id', $users, isset($project) ? $project->rep_id : null, array('class' => 'form-control', 'id' => 'rep')) }}
		</div>
		<div class="form-group">
			{{ Form::label('pm', trans('flash.pm')) }}
			{{ Form::select('pm_id', $users, isset($project) ? $project->pm_id : null, array('class' => 'form-control', 'id' => 'pm')) }}
		</div>
		<div class="form-group">
			{{ Form::label('due_at', trans('flash.due_at')) }}
			{{ Form::text('due_at', isset($project) ? Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $project->due_at)->format('d F Y') : Carbon\Carbon::now()->addWeekdays(5)->format('d F Y'), array('class' => 'form-control date-picker', 'id' => 'due_at')) }}
		</div>
		<div class="form-group">
			{{ Form::hidden('schedule', true) }}
		</div>
	</div>
</div>