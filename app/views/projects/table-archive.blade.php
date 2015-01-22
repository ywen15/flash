<table id="project-list" class="table table-striped table-bordered data-table">
    <thead>
        <tr>
            <th>{{ trans('flash.description') }}</th>
            <th>{{ trans('flash.docket') }}</th>
            <th>{{ trans('flash.customer') }}</th>
            <th>{{ trans('flash.pm') }}</th>
            <th>{{ trans('flash.quantity') }}</th>
            <th>{{ trans('flash.stock') }}</th>
            <th>{{ trans('flash.rep') }}</th>
            <th>{{ trans('flash.order_total') }}</th>
            <th>{{ trans('flash.shipping') }}</th>
            <th>{{ trans('flash.hst') }}</th>
            <th>{{ trans('flash.total') }}</th>
            <th>{{ trans('flash.completed_at') }}</th>
            <th>{{ trans('flash.billed_at') }}</th>
            <th>{{ trans('flash.reference') }}</th>
            <th>{{ trans('flash.modify') }}</th>
        </tr>
    </thead>
</table>

@section('javascript')
<script type="text/javascript">
    (function($) {
        var projects = $('#project-list').DataTable({
            ajax: '{{ action("ProjectController@dataTable", "archive") }}',
            columns: [
                {'data': 'description'},
                {'data': 'docket'},
                {'data': 'customer'},
                {'data': 'pm', 'visible': false},
                {'data': 'quantity'},
                {'data': 'stock'},
                {'data': 'rep', 'visible': false},
                {'data': 'order_amount'},
                {'data': 'shipping'},
                {'data': 'hst', 'visible': false},
                {'data': 'total'},
                {'data': 'completed_at'},
                {'data': 'billed_at'},
                {'data': 'reference'},
                {'data': 'modify'}
            ],
            initComplete: function(settings, json) {
                rebinder();
            }
        });

        $(document).ready(function() {
            //
        })
    })(jQuery);
</script>
