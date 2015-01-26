/**
 * Global Functions
 * 
 * Functions in this file can be called from anywhere in views.
 */

function rebinder() {
	if(window.location.hash) {
		var hash = window.location.hash.substr(window.location.hash.lastIndexOf('#'));
		var project = $('#project-list').find(".project-tl[data-project='" + hash.substr(1) + "']");
		if(project.length) {
			setTimeout(function() {
				project.click()
			}, 10);

			$('html, body').animate({
				scrollTop: project.offset().top
			}, 500);
		}
	}

	$('.projectModal').click(function() {
		$.ajax({
			url: '/project/modal/' + $(this).data('project') + '/' + $(this).data('action'),
		}).done(function(html) {
			$('#projectModal').remove();
			$('body').append(html);
			$('#projectModal').modal('toggle');
		});
	});

	/** Project timeline **/
	$(".project-tl").click(function() {
		var self = this;
		var btn = $(self).find('span.glyphicon');

		if(btn.hasClass('glyphicon-plus')) {
			btn.removeClass('glyphicon-plus').addClass('glyphicon-minus');
			$.ajax({
				url: '/project/' + $(self).data('project') + '/timeline',
			}).done(function(data) {
				$(self).closest('tr').after(data);
			});
		}
		else {
			btn.removeClass('glyphicon-minus').addClass('glyphicon-plus');
			$('#timeline-' + $(self).data('project')).remove();
		}
	});
}

/** Inline notes editing **/
function showNotes(el) {
	var content = el.text();
	var html  = "<textarea cols='40' rows='3'>";
		html += content;
		html += "</textarea><br />";
		html += "<button type='button' class='btn btn-sm btn-primary' onclick='updateNotes(this)'>Save</button>";
		html += "<button type='button' class='btn btn-sm btn-default' onclick='cancelNotes(this)'>Cancel</button>";
	el.html(html);
}

function cancelNotes(el) {
	setTimeout(function() {
		$(el).parent().html($(el).siblings("textarea").val());
	}, 10);
}

function updateNotes(el) {
	$.ajax({
		url: '/project/' + $(el).parent().data('project') + '/saveNotes',
		type: 'POST',
		data: { notes: $(el).siblings('textarea').val() } 
	}).always(function() {
		window.location = window.location.href;
	});
}

function notes_editor() {
	$('.notes').click(function(e) {
		e.stopPropagation();
		if($(this).find('span').children().length == 0)	showNotes($(this).find('span'));
	});
}

/** Inline due date editor **/
function showDueDate(el) {
	var value = el.text();
	el.text('');
	var input  =  "<div class='control-group'>";
		input +=    "<div class='controls'>";
		input +=      "<input type='text' class='date-picker form-control' value='"+ value +"' />";
		input +=      "<button type='button' class='btn btn-sm btn-primary' onclick='updateDueDate(this)'>Save</button> ";
		input +=      "<button type='button' class='btn btn-sm btn-default' onclick='cancelDueDate(this)'>Cancel</button>";
		input +=    "</div>";
		input +=  "</div>";
	el.append(input);
	$(".date-picker").datepicker({ dateFormat: 'D/M/dd/yy' });
}

function cancelDueDate(el) {
	var target = $(el).closest('.dueDate');
	var html = "<span id='" + target.children().attr('id') + "'>" + $(el).siblings('input').val() + "</span>";
	setTimeout(function(){
		target.html(html);
	}, 10);
}

function updateDueDate(el) {
	$.ajax({
		url: '/project/' + $(el).parentsUntil('td').last().data('project') + '/saveDueDate',
		type: 'POST',
		data: { dueDate: $(el).siblings('input').val() } 
	}).always(function() {
		window.location = window.location.href;
	});
}

function due_date_editor() {
	$('.dueDate').click(function(e) {
		e.stopPropagation();
		if($(this).find('span').children().length == 0) showDueDate($(this).find('span'));
	});
}