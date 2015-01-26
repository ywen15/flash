@extends('templates.main')

{{-- Content --}}
@section('content')

    <div id="project-create" class="row">
        <div class="col-sm-12">
            <h1>{{ trans('flash.edit_project') }}</h1>
        </div>
        <div class="col-sm-12">
            {{ Form::open(array('route' => 'project.store', 'method' => 'post', 'class' => 'form-horizontal', 'id' => 'project-creator', 'role' => 'form')) }}
                @include('projects.project_section')
                @include('projects.task_section')
                <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-danger pull-left" data-toggle="modal" data-target="#deleteProject">
                        <span class="glyphicon glyphicon-trash"></span> {{ trans('flash.delete_project') }}
                    </button>
                    <button type="button" class="btn btn-success complete" data-toggle="modal" data-target="#completeProject">
                        <span class="glyphicon glyphicon-ok"></span> {{ trans('flash.complete_project') }}
                    </button>
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> {{ trans('flash.save_project') }}</button>
                </div>
            {{ Form::close() }}
        </div>
    </div>

    <div class="modal fade" id="deleteProject" tabindex="-1" role="dialog" aria-labelledby="deleteProjectLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="deleteProjectLabel">{{ trans('flash.delete_project') }}</h4>
                </div>
                <div class="modal-body">{{ trans('flash.confirm_delete') }}</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('flash.cancel') }}</button>
                    <button type="button" class="btn btn-primary delete">{{ trans('flash.yes') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="completeProject" tabindex="-1" role="dialog" aria-labelledby="completeProjectLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="completeProjectLabel">{{ trans('flash.complete_project') }}</h4>
                </div>
                <div class="modal-body">{{ trans('flash.confirm_complete') }}</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('flash.cancel') }}</button>
                    <button type="button" class="btn btn-primary delete">{{ trans('flash.yes') }}</button>
                </div>
            </div>
        </div>
    </div>

@stop

{{-- Javascript --}}
@section('javascript')
<script type="text/javascript">
    (function($) {
        $(document).ready(function() {
            $(".date-picker").datepicker({ dateFormat: 'dd MM yy' });
            $("#customer, #rep, #pm").chosen();

            var num_tasks = 0;

            function task_html() {
                var html = '';
                html += '<div class="panel panel-info">';
                html +=     '<div class="panel-heading">';
                html +=         '<h4 class="panel-title pull-left">';
                html +=             '<a data-toggle="collapse" href="#taskCreator' + num_tasks + '" class="collapsed">{{ trans("flash.task") }}</a>';
                html +=         '</h4>';
                html +=         '<div class="col-md-2 pull-right text-right" style="padding: 0px;">';
                html +=             '{{ html_entity_decode(Form::button(HTML::span(null, array("class" => "glyphicon glyphicon-trash")), array("class" => "btn btn-danger btn-sm", "data-toggle" => "modal", "data-target" => "#taskDelete"))) }}';
                html +=         '</div>';
                html +=         '<div class="clearfix"></div>';
                html +=     '</div>';
                html +=     '<div id="taskCreator' + num_tasks + '" class="panel-collapse collapse">';
                html +=         '<div class="panel-body">';
                html +=             '<div class="form-group">';
                html +=                 '{{ Form::label("equipment", trans("flash.equipment")) }}';
                html +=                 '{{ Form::select("equipment_id", $equipments, null, array("class" => "form-control")) }}';
                html +=             '</div>';
                html +=             '<div class="form-group">';
                html +=                 '{{ Form::label("actual_time", trans("flash.duration")) }}';
                html +=                 '{{ Form::number("actual_time", 1, array("class" => "form-control", "min" => 0)) }}';
                html +=             '</div>';
                html +=             '<div class="form-group">';
                html +=                 '{{ Form::label("notes", trans("flash.notes")) }}';
                html +=                 '{{ Form::textarea("notes", null, array("class" => "form-control", "rows" => 2)) }}';
                html +=             '</div>';
                html +=             '<div class="form-group">';
                html +=                 '{{ Form::label("status", trans("flash.status")) }}';
                html +=                 '{{ Form::select("status", $taskStatus, null, array("class" => "form-control")) }}';
                html +=             '</div>';
                html +=         '</div>';
                html +=     '</div>';
                html += '</div>';
                return html;
            }

            $('#addTask').click(function() {
                $('.tasks').append(task_html());
                ++num_tasks;
            });
            $('#taskDelete').on('shown.bs.modal', function (e) {
                var self = $(this);
                $(this).find('.delete').click(function(){
                    $(e.relatedTarget).closest('.panel').remove();
                    self.modal('hide');
                });
            });
            $('#taskDelete').on('hidden.bs.modal', function (e) {
                $(this).find('.delete').unbind('click');
            });
            $('#save-project').click(function() {
                $('input[name="schedule"]').val(0);
                $('#project-creator').submit();
            });
        })
    })(jQuery);
</script>
@stop