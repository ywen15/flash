@extends('templates.main')

{{-- Content --}}
@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-2">
                @include('tasks.list')
            </div>
            <div class="col-sm-9 pull-right">
                @include('tasks.upcoming')
                @include('tasks.calendar')
                @include('tasks.weekly')
            </div>
        </div>
    </div>

@stop

{{-- Javascript --}}
@section('javascript')
<script type="text/javascript">
    (function($) {
        $(document).ready(function() {
            var calendar;

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
            });
            $('.prev-day, .next-day, .today, .refresh').click(function() {
                var caller = $(this).attr('name');
                $('.date-picker').val( calendar.weekCalendar(caller).format('ddd/mmm/dd/yyyy') );
                //calendar.weekCalendar(caller);
                if(caller == 'today') {
                //    calendar.weekCalendar('now');
                }
                //update_datepicker();
            });


            function update_datepicker() {
                $('.date-picker').val( calendar.weekCalendar('getCurrentFirstDay').format('ddd/mmm/dd/yyyy') );
                $('.date-picker').change();
            }
            function getEquipments() {
                var equipments;
                $.ajax({
                    url: '/process/' + {{ $process->id }} + '/getEquipmentList',
                }).done(function(data) {
                    console.log(data);
                    equipments = data;
                });
                return equipments;
            }
        })
    })(jQuery);
</script>
@stop