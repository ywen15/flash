<table id="project-list" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>{{ trans('flash.timeline') }}</th>
            <th>{{ trans('flash.days_left') }}</th>
            <th>{{ trans('flash.docket') }}</th>
            <th>{{ trans('flash.customer') }}</th>
            <th>{{ trans('flash.description') }}</th>
            <th>{{ trans('flash.quantity') }}</th>
            <th>{{ trans('flash.stock') }}</th>
            <th>{{ trans('flash.rep') }}</th>
            <th>{{ trans('flash.pm') }}</th>
            <th>{{ trans('flash.created_at') }}</th>
            <th>{{ trans('flash.due_at') }}</th>
            <th>{{ trans('flash.days_to_complete') }}</th>
            <th>{{ trans('flash.schedule') }}</th>
            <th>{{ trans('flash.task') }}</th>
            <th>{{ trans('flash.notes') }}</th>
            <th>{{ trans('flash.modify') }}</th>
        </tr>
    </thead>
</table>

@section('javascript')
<script type="text/javascript">
    (function($) {
        var projects = $('#project-list').DataTable({
            ajax: '{{ action("ProjectController@dataTable") }}',
            columns: [
                {'data': 'timeline'},
                {'data': 'days_left'},
                {'data': 'docket'},
                {'data': 'customer'},
                {'data': 'description'},
                {'data': 'quantity'},
                {'data': 'stock'},
                {'data': 'rep'},
                {'data': 'pm'},
                {'data': 'created_at'},
                {'data': 'due_at'},
                {'data': 'days_to_complete'},
                {'data': 'schedule'},
                {'data': 'task', 'visible': false},
                {'data': 'notes', 'visible': false},
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
