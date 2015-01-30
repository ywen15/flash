
var startDate;
var endDate;

var selectCurrentWeek = function() {
    window.setTimeout(function () {
        $('.week-picker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
    }, 1);
}

var showCurrentWeek = function(input) {
    if(input) {
        var tmp = input.split('/');
        var date = new Date(input);
    }
    else {
        var date = new Date();
    }
    var day = (date.getDay() == 0) ? 6 : date.getDay() - 1;

    startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - day);
    endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - day + 6);
    var dateFormat = 'dd/mm/yy';
    $('.week-picker').val($.datepicker.formatDate( dateFormat, startDate ) + ' - ' + $.datepicker.formatDate( dateFormat, endDate ));
}

$('.week-picker').datepicker( {
    showOtherMonths: true,
    selectOtherMonths: true,
    firstDay: 1,
    onSelect: function(dateText, inst) { 
        var date = $(this).datepicker('getDate');
        var day = (date.getDay() == 0) ? 6 : date.getDay() - 1;
        startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - day);
        endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - day + 6);
        var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
        $('.week-picker').val($.datepicker.formatDate( dateFormat, startDate, inst.settings ) + ' - ' + $.datepicker.formatDate( dateFormat, endDate, inst.settings ));
        
        selectCurrentWeek();
        $('.week-picker').change();
    },
	beforeShow: function(input, inst) {
		if( $(input).hasClass('week-picker') ) {
			$('#ui-datepicker-div').addClass('week-view');
		}
	},
    beforeShowDay: function(date) {
    	
        var cssClass = '';
        if(date >= startDate && date <= endDate)
            cssClass = 'ui-datepicker-current-day';
        return [true, cssClass];
    },
    onChangeMonthYear: function(year, month, inst) {
        selectCurrentWeek();
    }
});



if($('.week-picker').size() > 0) {
    $('.week-view .ui-datepicker-calendar').on('mousemove', 'tr', function() { $(this).find('td a').addClass('ui-state-hover'); });
    $('.week-view .ui-datepicker-calendar').on('mouseleave', 'tr', function() { $(this).find('td a').removeClass('ui-state-hover'); });
}

if($('.week-picker').val() == '') {
    showCurrentWeek();
};
