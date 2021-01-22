$(document).ready(function() {
    $( "#tablaRegistros" ).DataTable();
    $( "#fechaRegistro" ).datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $( "#fechanewRegistro" ).datepicker({
        dateFormat: 'yy-mm-dd'
    });
});

async function resetearHistoricos() {
    $('#loading-image').show();
    await actualizarHistoricos();
    $('#loading-image').hide();
    location.reload(); 
}

async function actualizarHistoricos() {
    try {
        historicos = await $.ajax({
            type: "POST",
            url: "/crud/actualizarHistoricos",
            data: {
                indicador: 'uf'
            }
        });
    } catch (error) {
        console.error(error);
    }
}

function cargarDetalles(id, valor, fecha) {

    $('#fechaRegistro').val(fecha.substr(0, 10));
    $('#valorRegistro').val(valor);
    $('#registroID').val(id);
}

async function actualizarRegistro() {
    $('#loading-image').show();
    try {
        historicos = await $.ajax({
            type: "POST",
            url: "/historicos/actualizar",
            data: {
                idRegistro: $('#registroID').val(),
                valorRegistro: $('#valorRegistro').val(),
                fechaRegistro: $('#fechaRegistro').val(),
            }
        });
    } catch (error) {
        console.error(error);
    }

    $('#fecha'+$('#registroID').val()).text($('#fechaRegistro').val())
    $('#valor'+$('#registroID').val()).text('$'+$('#valorRegistro').val())
    $('#loading-image').hide();
    $('#modalModificarUf').modal('hide');

}

async function eliminarRegistro() {
    $('#loading-image').show();
    try {
        historicos = await $.ajax({
            type: "POST",
            url: "/historicos/eliminar",
            data: {
                idRegistro: $('#registroID').val(),
            }
        });
    } catch (error) {
        console.error(error);
    }

    $('#fila'+$('#registroID').val()).hide();
    $('#loading-image').hide();
    $('#modalModificarUf').modal('hide');


}

async function ingresarRegistro() {
    $('#loading-image').show();
    try {
        historicos = await $.ajax({
            type: "POST",
            url: "/historicos/ingresar",
            data: {
                valorRegistro: $('#valornewRegistro').val(),
                fechaRegistro: $('#fechanewRegistro').val()
            }
        });
    } catch (error) {
        console.error(error);
    }
    var tablaRegistros = $('#tablaRegistros').DataTable();
    tablaRegistros.row.add([
        'UF',
        'Unidad de Fomento UF',
        'Pesos',
        $('#fechanewRegistro').val(),
        $('#valornewRegistro').val(),
        'Actualice para modificar'

    ]).draw( false);

    $('#addRow').click();

    $('#loading-image').hide();
    $('#modalIngresarRegistro').modal('hide');
}



