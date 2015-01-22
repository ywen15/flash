/**
 * Global Functions
 * 
 * Functions in this file can be called from anywhere in views.
 */

function rebinder() {
	$('.projectModal').click(function() {
		$.ajax({
			url: '/project/modal/' + $(this).data('project') + '/' + $(this).data('action'),
		}).done(function(html) {
			$('#projectModal').remove();
			$('body').append(html);
			$('#projectModal').modal('toggle');
		});
	});
}