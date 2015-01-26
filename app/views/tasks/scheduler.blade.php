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
            var calendar = $('#calendar').weekCalendar({
                timeslotsPerHour: 4,
                scrollToHourMillis: 0,
                height: function(calendar) {
                    return $(window).height() - $('h1').outerHeight(true) - 200;
                },
                data: function(start, end, callback) {
                    $.ajax({
                        url: '/process/' + {{ $process->id }} + '/taskByDate',
                        type: 'POST',
                        dataType: 'json',
                        data: { start: start, end: end },
                        success: function(events) {
                            callback(events);
                        }
                    });
                },
                //users: users,
                showAsSeperateUser: true,
                displayOddEven: true,
                daysToShow: 1,
                use24Hour: false,
                headerSeparator: ' ',
                useShortDayNames: true,
                dateFormat: 'F d, Y'
            });

            $('input[type="hidden"]').each(function(index) {
                var target = $(this).attr('name');
                $('span[data-process="'+target+'"]').text($(this).val())
            });

            $(".date-picker").datepicker({ dateFormat: 'D/M/dd/yy' });

            $('.prev-day').click(function() {
                calendar.weekCalendar('prev');
                update_datepicker();
            });
            $('.next-day').click(function() {
                calendar.weekCalendar('next');
                update_datepicker();
            });
            $('.today').click(function() {
                calendar.weekCalendar('today');
                calendar.weekCalendar('now');
                update_datepicker();
            });
            $('.refresh').click(function() {
                calendar.weekCalendar('refresh');
            });

            function update_datepicker() {
                $('.date-picker').val( calendar.weekCalendar('getCurrentFirstDay').format('ddd/mmm/dd/yyyy') );
                $('.date-picker').change();
            }
        })
    })(jQuery);
</script>
@stop