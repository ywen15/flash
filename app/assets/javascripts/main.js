/**
 * Global Functions
 * 
 * Functions in this file can be called from anywhere in views.
 */

function rebinder() {
	$('.deleteModal').click(function() {
		console.log($(this));
		$.ajax({
			url: '/project/' + $(this).data('project') + '/delete',
		}).done(function(html) {
			$('#projectDelete').remove();
			$('body').append(html);
			$('#projectDelete').modal('toggle');
		});
	});
}