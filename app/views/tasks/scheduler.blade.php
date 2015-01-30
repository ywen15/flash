@extends('templates.main')

{{-- Content --}}
@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-3">
                @include('tasks.list')
            </div>
            <div class="col-sm-9 pull-right">
                @include('tasks.upcoming')
                @include('tasks.calendar')
                @include('tasks.weekly')
            </div>
        </div>

        <div id="dialog" title="View Task"></div>
    </div>

@stop

{{-- Javascript --}}
@section('javascript')
{{ HTML::script('assets/jquery.weekpicker.js') }}
<script type="text/javascript">

    $(document).ready(function() {

        $.ajax({
            url: '/process/' + {{ $process->id }} + '/getEquipmentList',
        }).done(function(data) {
            setup_calendar(data);
        });

        function setup_calendar(equipments) {
            calendar = $('#calendar').weekCalendar({
                timeslotsPerHour: 4,
                scrollToHourMillis: 0,
                height: function(calendar) {
                    return $(window).height() - $('h1').outerHeight(true) - 200;
                },
                data: function(start, end, callback) {
                    $.ajax({
                        url: '/process/' + {{ $process->id }} + '/taskByDate',
                        type: 'POST',
                        data: { start: start.format('yyyy-mm-dd HH:MM:ss'), end: end.format('yyyy-mm-dd HH:MM:ss') },
                        success: function(events) {
                            callback(events);
                        },
                    });
                },
                users: equipments,
                showAsSeperateUser: true,
                displayOddEven: true,
                daysToShow: 1,
                use24Hour: false,
                headerSeparator: ' ',
                useShortDayNames: true,
                dateFormat: 'F d, Y'
            });
            setup_tasks();
        }

        $('input[type="hidden"]').each(function(index) {
            var target = $(this).attr('name');
            $('span[data-process="'+target+'"]').text($(this).val());
        });

        $('#day-picker').datepicker({ 
            dateFormat: 'D/M/dd/yy',
            altField: '#alternate',
            altFormat: 'M/dd/yy',
        });
        $('#day-picker').change(function() {
            calendar.weekCalendar('gotoDate', $('#alternate').val());
            showCurrentWeek($('#alternate').val());
            getWeeklyView('{{ $process->id }}');
        });
        $('.prev-day, .next-day, .today, .refresh').click(function() {
            var caller = $(this).attr('name');
            calendar.weekCalendar(caller);
            if(caller == 'today') {
                calendar.weekCalendar('now');
            }
            $('.date-picker').val( calendar.weekCalendar('getCurrentFirstDay').format('ddd/mmm/dd/yyyy') );
        });
        $(".weekRefresh").click(function() {
            getWeeklyView('{{ $process->id }}');
        });
        $(".weekly-eq").add(".week-picker").change(function() {
            getWeeklyView('{{ $process->id }}');
        });


        function getWeeklyView(process_id) {
            var dates = $('.week-picker').val().split(' - ');

            var start_date = dates[0].split('/');
            var start = new Date(start_date[2], start_date[1]-1, start_date[0]);

            var end_date = dates[1].split('/');
            var end = new Date(end_date[2], end_date[1]-1, end_date[0]);

            $.ajax({
                url: '/process/' + {{ $process->id }} + '/weekelyTask',
                type: "GET",
                data: { start: start.getTime(), end: end.getTime(), equipment: $(".weekly-eq").val() },
                success: function(data) {
                    $("#weekly").html(data);

                    $("#weekly-table .panel").click(function() {
                        if( $(this).children("span").hasClass("glyphicon-plus") ) {
                            $(this).children("span").removeClass("glyphicon-plus").addClass("glyphicon-minus");
                            $(this).children(".task-details").show();
                        }
                        else {
                            $(this).children("span").removeClass("glyphicon-minus").addClass("glyphicon-plus");
                            $(this).children(".task-details").hide();
                        }

                    });
                }
            });
        }
        function getEquipments() {
            var equipments;
            $.ajax({
                url: '/process/' + {{ $process->id }} + '/getEquipmentList',
            }).done(function(data) {
                equipments = data;
            });
            return equipments;
        }

        function setup_tasks() {
            $( ".task" ).each(function(){
                $(this).data('calEvent', {
                                            userId: $(this).data('userid'), 
                                            admin: $(this).data('admin'), 
                                            duration: $(this).data('duration'), 
                                            hasnote: $(this).data('hasnote'), 
                                            colour: $(this).data('colour'), 
                                            title: $(this).data('title'), 
                                            id: $(this).data('id'), 
                                            description: $(this).data('description')
                                        });
                $(this).data('draggable', {containment: null});
            });
            create_draggable_items();
        }

        function create_draggable_items() {
            $( ".task" ).draggable({
                helper: function(event){
                    var temp_task = $('<div class="wc-cal-event ui-corner-all" style="margin-left:'+($(event.target).data('calEvent').userId*$(".wc-day-column-inner").width()-10)+'px; width: '+$(".wc-day-column-inner").width()+';font-size: 9px;line-height: 10px;z-index: 1000;line-height: 15px; font-size: 13px; height: '+60 * $(event.target).data('calEvent').duration+'px; display: block; background-color: rgb(170, 170, 170);"><div class="wc-time ui-corner-top" style="font-size: 9px;line-height: 10px;border: 1px solid rgb(136, 136, 136); background-color: rgb(153, 153, 153);">'+$(event.target).data('calEvent').title+'</div><div class="wc-title" style="font-size: 9px;line-height: 10px;">'+$(event.target).data('calEvent').description+'</div><div class="ui-resizable-handle ui-resizable-s">=</div></div>');
                    temp_task.data('calEvent', $(event.target).data('calEvent'));
                    return temp_task;
                },
                snap: ".wc-time-slot",
                snapMode: 'inner',
                snapTolerance: 59,
                scroll: false,
                appendTo: ".wc-grid-row-events .wc-full-height-column.wc-user-0",
                containment: [$(".wc-grid-row-events .wc-full-height-column.wc-user-0").offset().left,$(".wc-grid-row-events .wc-full-height-column.wc-user-0").offset().top,$(".wc-grid-row-events .wc-full-height-column.wc-user-0").offset().left,$(".wc-grid-row-events .wc-full-height-column.wc-user-0").offset().top+1200],
                stop: function(event, ui){
                    var equipBadge = $(this).parent().parent().find('a .badge').text() - 1;
                    var processBadge = $(this).parent().parent().parent().parent().find('a:first .badge').text() - 1;
                    $(this).parent().parent().find('a .badge').text(equipBadge);
                    $(this).parent().parent().parent().parent().find('a:first .badge').text(processBadge);
                    if (processBadge == 0){
                        $(this).parent().parent().parent().parent().remove();
                    }
                    $(this).remove();
                    $(".master-tasks").text(parseFloat($(".master-tasks").text()) - 1);
                    if ($(".master-tasks").text() == 0){
                        $(".master-tasks").hide();
                    }

                    calendar.weekCalendar("refresh");
                },
                drag: function(event, ui){
                    $(event.target).data('draggable').containment = [$(".wc-grid-row-events .wc-full-height-column.wc-user-"+$(ui.helper).data('calEvent').userId).offset().left,$(".wc-grid-row-events .wc-full-height-column.wc-user-"+$(ui.helper).data('calEvent').userId).offset().top,$(".wc-grid-row-events .wc-full-height-column.wc-user-"+$(ui.helper).data('calEvent').userId).offset().left,$(".wc-grid-row-events .wc-full-height-column.wc-user-"+$(ui.helper).data('calEvent').userId).offset().top+1200];
                }
            });
        }
    })
</script>
@stop