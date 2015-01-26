<table id="project-list" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>{{ trans('flash.description') }}</th>
            <th>{{ trans('flash.docket') }}</th>
            <th>{{ trans('flash.customer') }}</th>
            <th>{{ trans('flash.pm') }}</th>
            <th>{{ trans('flash.quantity') }}</th>
            <th>{{ trans('flash.stock') }}</th>
            <th>{{ trans('flash.rep') }}</th>
            <th>{{ trans('flash.completed_at') }}</th>
            <th>{{ trans('flash.notes') }}</th>
            <th>{{ trans('flash.modify') }}</th>
        </tr>
    </thead>
</table>

@section('javascript')
<script type="text/javascript">
    (function($) {
        var projects = $('#project-list').DataTable({
            ajax: '{{ action("ProjectController@dataTable", "billing") }}',
            columns: [
                {'data': 'description'},
                {'data': 'docket'},
                {'data': 'customer'},
                {'data': 'pm'},
                {'data': 'quantity'},
                {'data': 'stock'},
                {'data': 'rep'},
                {'data': 'completed_at'},
                {'data': 'notes'},
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
