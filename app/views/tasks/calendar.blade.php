<div class="row calendar">
	<div class="col-sm-3">
		<div class="btn-group">
			<button type="button" class="btn btn-default prev-day"><span class="glyphicon glyphicon-chevron-left"></span></button>
			<button type="button" class="btn btn-default today">{{ trans('flash.today') }}</button>
			<button type="button" class="btn btn-default next-day"><span class="glyphicon glyphicon-chevron-right"></span></button>
		</div>
	</div>

	<div class="col-sm-6">
		<button type="button" class="btn btn-default refresh" style="width: 100%;"><span class="glyphicon glyphicon-refresh"></span></button>
	</div>

	<div class="col-sm-3">
		<div class="input-group">
			<span class="input-group-addon" style="background:#fff">
				<span class="glyphicon glyphicon-calendar"></span>
			</span>
			<input type="text" class="form-control date-picker" value="{{ Carbon\Carbon::now()->format('D/M/d/Y') }}">
		</div>
	</div>
</div>

<div class="row">
	<div id="calendar"></div>
</div>