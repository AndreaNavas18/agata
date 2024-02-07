import './bootstrap';

$(function () {
	/* Loader */
	$('.loading').click(function() {
		$('div.loader').addClass('is-active');
	});


	/* Desactiva la tecla ESC */
	$(document).keydown(function(e) {
	    if (e.keyCode == 27) return false;
	});

	/* Configura el X-CSRF-TOKEN en las peticiones Ajax */
	$.ajaxSetup({
        headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});






