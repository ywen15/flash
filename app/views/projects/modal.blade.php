<div class="modal fade" id="projectModal" tabindex="-1" role="dialog" aria-labelledby="projectModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="projectModalLabel">{{ $project->description.' / '.$project->docket.' / '.$project->customer->name.' / '.$project->quantity }}</h4>
			</div>

			<div class="modal-body">
			@if($type == 'destroy')
					{{ trans('flash.confirm_delete') }}
				</div>
				{{ Form::open(array('route' => array('project.'.$type, $project->id), 'method' => 'delete', 'role' => 'form')) }}
			@elseif($type == 'reset')
					{{ trans('flash.confirm_reset') }}
				</div>
				{{ Form::open(array('action' => array('ProjectController@reset', $project->id), 'method' => 'get', 'role' => 'form')) }}
			@elseif($type == 'complete')
					{{ trans('flash.confirm_complete') }}
				</div>
				{{ Form::open(array('action' => array('ProjectController@complete', $project->id), 'method' => 'get', 'role' => 'form')) }}
			@elseif($type == 'bill')
				{{ Form::open(array('action' => array('ProjectController@bill', $project->id), 'method' => 'get', 'role' => 'form', 'class' => 'form-horizontal')) }}
					<div class="form-group">
						<label for="reference" class="control-label col-sm-3">{{ trans('flash.reference') }}</label>
						<div class="col-sm-8">
							{{ Form::text('reference', null, array('class' => 'form-control', 'id' => 'reference')) }}
						</div>
					</div>
					<div class="form-group">
						<label for="order_amount" class="control-label col-sm-3">{{ trans('flash.order_amount') }}</label>
						<div class="col-sm-8">
							{{ Form::text('order_amount', null, array('class' => 'form-control', 'id' => 'order_amount')) }}
						</div>
					</div>
					<div class="form-group">
						<label for="shipping" class="control-label col-sm-3">{{ trans('flash.shipping') }}</label>
						<div class="col-sm-8">
							{{ Form::text('shipping', null, array('class' => 'form-control', 'id' => 'shipping')) }}
						</div>
					</div>
					<div class="form-group">
						<label for="hst" class="control-label col-sm-3">{{ Form::checkbox('taxable', 1, true) . ' ' . trans('flash.hst') }}</label>
						<div class="col-sm-8">
							{{ Form::text('hst', null, array('class' => 'form-control', 'id' => 'hst', 'readonly' => 'readonly')) }}
						</div>
					</div>
					<div class="form-group">
						<label for="total" class="control-label col-sm-3">{{ trans('flash.total') }}</label>
						<div class="col-sm-8">
							{{ Form::text('total', null, array('class' => 'form-control', 'id' => 'total', 'disabled' => 'disabled')) }}
						</div>
					</div>
			@endif

			<div class="modal-footer">
				{{ Form::button(trans('flash.cancel'), array('type' => 'button', 'class' => 'btn btn-default', 'data-dismiss' => 'modal')) }}
				{{ Form::submit( ($type == 'bill') ? trans('flash.add_archive') : trans('flash.yes'), array('type' => 'button', 'class' => 'btn btn-primary')) }}
			</div>

			{{ Form::close() }}

		</div>
	</div>
</div>

@section('javascript')
<script type="text/javascript">
    (function($) {
         $(document).ready(function() {
            $('#order_amount, #shipping, #hst').bind('input change', function() {
            	var sum = parseFloat($('#order_amount').val() ? $('#order_amount').val() : 0) + parseFloat($('#shipping').val() ? $('#shipping').val() : 0 || 0);

            	$('input[name="taxable"]').is(':checked') ? $('#hst').val( parseFloat(sum*0.13).toFixed(2) ) : $('#hst').val(0);
            	$('#total').val( (sum + parseFloat($('#hst').val())).toFixed(2) );
            });
            $('input[name="taxable"]').click(function() {
            	$('#hst').change();
            });
        })
    })(jQuery);
</script>
