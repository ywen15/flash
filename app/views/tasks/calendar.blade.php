<div class="row calendar">
	<div class="col-sm-3">
		<div class="btn-group">
			<button type="button" name="prev" class="btn btn-default prev-day"><span class="glyphicon glyphicon-chevron-left"></span></button>
			<button type="button" name="today" class="btn btn-default today">{{ trans('flash.today') }}</button>
			<button type="button" name="next" class="btn btn-default next-day"><span class="glyphicon glyphicon-chevron-right"></span></button>
		</div>
	</div>

	<div class="col-sm-6">
		<button type="button" name="refresh" class="btn btn-default refresh" style="width: 100%;"><span class="glyphicon glyphicon-refresh"></span></button>
	</div>

	<div class="col-sm-3">
		<div class="input-group">
			<span class="input-group-addon" style="background:#fff">
				<span class="glyphicon glyphicon-calendar"></span>
			</span>
			<input type="text" class="form-control date-picker" id="day-picker" value="{{ Carbon\Carbon::now()->format('D/M/d/Y') }}">
			<input type="hidden" id="alternate" value="">
		</div>
	</div>
</div>

<div class="row">
	<div id="calendar"></div>
</div>