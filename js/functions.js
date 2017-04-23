$(document).ready(function () {
    $('#bloqueador').click(function () {
        habilitar_nuevo();
    });
    $('#buscador').change(buscador);
    mostrar_victimas();

});
function buscador() {
    var busqueda = $('#buscador').val() === '' ? '' : $('#buscador').val();
    var categoria = $('#categoria').val();
    procesa_motes("get.php?mote_nombre=" + busqueda + "&categoria_id=" + categoria);
}
function actualiza_por_categoria() {
    procesa_motes("get.php?categoria_id=" + $('#categoria').val());
}
function procesa_motes(ruta) {
    $.get(ruta, function (data, status) {
        if (data !== '') {
            var motes = JSON.parse(data);
            var toreturn = '';
            for (var i = 0; i < motes.length; i++) {
                toreturn += '<div class="mote ' + motes[i].class + '" title="Categoria: ' +
                        motes[i].categoria + '" data-to="' + motes[i].id + '">' + motes[i].nombre + "</div>";
            }
            $('#motes').html(toreturn);
            mostrar_victimas();
        }else{
            $('#motes').html('<div class="mote"><small>Sin resultados</small></div>');
        }
        //<div class="mote general" title="Categoría: General">Batusi</div>
    });
}

function crea_nuevo() {
    var nombre = $('#nombre_nuevo').val();
    var categoria = $('#categoria_nuevo').val();
    if (nombre !== '') {
        destaca('nombre_nuevo');
        $.post("new.php", {nombre_nuevo: nombre, categoria_nuevo: categoria}, function (result) {
            result = JSON.parse(result);
            alert(result.mensaje);
            habilitar_nuevo();
            actualiza_por_categoria();
        });
    } else {
        destaca('nombre_nuevo');
    }
}
function destaca(id) {
    if ($('#' + id).attr('class').indexOf('mal') > 0) {
        $('#' + id).removeClass('mal');
    } else {
        $('#' + id).select();
        $('#' + id).addClass('mal');
    }
}
function habilitar_nuevo() {
    if ($('#bloqueador').css('display') === 'none')
        $('#bloqueador').fadeIn();
    else
        $('#bloqueador').fadeOut();
}

function mostrar_victimas(e) {
    $('.mote').each(function (i, val) {
        $(val).click(function () {
            $('.selected').removeClass('selected')
            $(val).addClass('selected');
            $.get("get_victimas.php?mote_id=" + $(this).data('to'), function (data, status) {
                var victimas = JSON.parse(data);
                var toreturn = '<small>Victimas</small>';
                for (var i = 0; i < victimas.length; i++) {
                    toreturn += '<div class="mote">' + victimas[i].nombre + "</div>";
                }
                $('#victimas').html(toreturn);
            });
        });
    });
}