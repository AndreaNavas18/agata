	/* Loader */
	$('.loading').click(function() {
		$('#global-loader').show()
	});

	/* Tooltip */
	// $('[data-toggle="tooltip"]').tooltip({ boundary: 'window' });

	/* Datepicker */
	$('input.fecha').datepicker({ /* yyyy-mm-dd */
		autoclose: true,
		format: 'yyyy-mm-dd',
		language: 'es',
		todayBtn: 'linked'
	}).on('hide', function(e) {
	    e.stopPropagation();
	});
	$('input.fecha-yyyy-mm').datepicker({ /* yyyy-mm */
		autoclose: true,
		format: 'yyyy-mm',
		language: 'es',
		minViewMode: 'months',
		startView: 'months',
		todayBtn: 'linked'
	}).on('hide', function(e) {
	    e.stopPropagation();
	});
	$('input.fecha-mm-dd').datepicker({ /* mm-dd */
		autoclose: true,
		format: 'mm-dd',
		language: 'es',
		minViewMode: 'days',
		startView: 'days',
		todayBtn: 'linked'
	}).on('hide', function(e) {
	    e.stopPropagation();
	});
	$('input.fecha-yyyy').datepicker({ /* yyyy */
		autoclose: true,
		format: 'yyyy',
		language: 'es',
		minViewMode: 'years',
		startView: 'years',
		todayBtn: 'linked'
	}).on('hide', function(e) {
	    e.stopPropagation();
	});
	$('input.fecha-mm').datepicker({ /* mm */
		autoclose: true,
		format: 'mm',
		language: 'es',
		minViewMode: 'months',
		startView: 'months',
		todayBtn: 'linked'
	}).on('hide', function(e) {
	    e.stopPropagation();
	});
	$('input.fecha-dd').datepicker({ /* dd */
		autoclose: true,
		format: 'dd',
		language: 'es',
		minViewMode: 'days',
		startView: 'days',
		todayBtn: 'linked'
	}).on('hide', function(e) {
	    e.stopPropagation();
    });

    /* Bootstrap Select */
    $('.selectpicker').selectpicker({
        actionsBox: true,
        container: 'body',
	    deselectAllText: 'Ninguno',
	    dropupAuto: false,
	    liveSearch: true,
	    selectAllText: 'Todos',
	    selectedTextFormat: 'count',
        size: 7
    });

    $(window).on("load", function(e) {
        $("#global-loader").fadeOut("slow");
    })

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

    /* Retroceso */
    window.addEventListener('pageshow', function ( event ) {
	  	var historyTraversal = event.persisted ||
	        (typeof window.performance != 'undefined' &&
	            window.performance.navigation.type === 2);
	  	if (historyTraversal) {
	  		openLoader();
	    	window.location.reload();
	  	}
	});

	/* Modales */
	$(document).on('show.bs.modal', '.modal', function () {
        if (!$(this).parent().hasClass('note-editor')) {
            $(this).parent().appendTo('body');
        }
	});


function openLoader() {
	$('#global-loader').show();
}

function closeLoader() {
	$('#global-loader').hide();
}

function formatoNumeroEntero(el) {
    var v = el.value;
    v = v.replace(/[^0-9]/g,"");
    $('input#'+el.id).val(v);
    var rgx = /(\d+)(\d{10})/;
    while (rgx.test(v)) { v = v.replace(rgx, '$1'); }
    $('input#'+el.id).val(v);
}

function formatoCosto(el) {
    var v = el.value;
    v = v.replace(/[^0-9]/g,"");
    $('input#'+el.id).val(v);
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(v)) { v = v.replace(rgx, '$1.$2'); }
    $('input#'+el.id).val(v);
}


$('.showModal').on('click', function(event)
{
    $('.notificacionesModal').html('');
	$('.formLimpiar').find("*").removeClass("is-invalid");
    $('.formLimpiar').find("*").removeClass("error");
    $('#'+$(this).attr('data-modal')).modal('show');
});

function soloNumeros(e, input) {
    var key = e.charCode;
    var size = input.value.length;
    if (size > 0) {
        if (!(key >= 48 && key <= 57)) {
            return e.preventDefault();
        }
    } else {
        if (!((key >= 48 && key <= 57) || key == 45)) {
            return e.preventDefault();
        }
    }
}

function validarHora(hora) {
	if(hora!='') {
		regex = /[0-9]{2}\:[0-9]{2}/;
		horaValidada= hora.match(regex);
		if (horaValidada==null) {
			return false;
		}
	}
	return true;
}


$(document).ready(function() {
    $('form#formStore').submit(function(e) {
        e.preventDefault();
        var $form = $('#formStore')[0];
        if ($form.checkValidity()) {
            openLoader();
            $form.submit();
        }
        else {
            closeLoader();
        }
    });
    $('form#formUpdate').submit(function(e) {
        e.preventDefault();
        var $form = $('#formUpdate')[0];
        if ($form.checkValidity()) {
            openLoader();
            $form.submit();
        }
        else {
            closeLoader();
        }
    });
    $('form#formSearch').submit(function(e) {
        e.preventDefault();
        var $form = $('#formSearch')[0];
        if ($form.checkValidity()) {
            openLoader();
            $form.submit();
        }
        else {
            closeLoader();
        }
    });
});

