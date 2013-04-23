var lpOnComplete = function(data) {
    console.log(data);

    var ul = $("#online-users");
    ul.html("");
    $("<li />").addClass("nav-header").html('Usuarios en el mapa').appendTo(ul);
    $("<li />").addClass('nousers').html("No hay usuarios").appendTo(ul);
    if (data.length == 0) {
        $("<li />").addClass('nousers').html("No hay usuarios").appendTo(ul);
        setTimeout("lpRefresh()",500);
    } else {
        ul.find('nousers').hide();
        for (var i = 0; i < data.length; i++) {
            var li = $("<li />");
            li.attr('rel',data[i].id).data('id',data[i].id).addClass('jugador').appendTo(ul);
            var a = $("<a />").html(data[i].nombre);
            if (data[i].secuencia) {
                li.addClass('disabled');
            }
            a.appendTo(li);
            if (i+1 == data.length) {
                setTimeout("lpRefresh()",500);
            }
        }
    }
}

var lpRefresh = function() {
    $.post('ajax/online-users.php', {}, function(data){
        var ul = $("#online-users");
        var nousers = ul.find('.nousers');
        if (data.length > 0 ) {
            nousers.hide();
            for (var i = 0; i < data.length; i++) {
                var old = ul.find('.jugador[rel='+data[i].id+']');
                if (old.size() > 0) {
                    if (data[i].secuencia) {
                        old.addClass('disabled');
                    } else {
                        old.removeClass('disabled');
                    }
                    old.addClass('salvar');
                } else {
                    var li = $("<li />");
                    li.attr('rel',data[i].id).data('id',data[i].id).addClass('jugador salvar').appendTo(ul);
                    var a = $("<a />").html(data[i].nombre).appendTo(li);
                }
                if (i+1 >= data.length) {
                    ul.find('.jugador:not(.salvar)').remove();
                    ul.find('.jugador.salvar').removeClass('salvar');
                    setTimeout("lpRefresh()",500);
                }
            }
        } else {
            ul.find('.jugador:not(.salvar)').remove();
            ul.find('.jugador.salvar').removeClass('salvar');
            nousers.show();
            setTimeout("lpRefresh()",500);
        }
    }, 'json');
}

var lpStart = function() {
    $.post('ajax/online-users.php', {}, lpOnComplete, 'json');
}

$(document).ready(function(){

    lpStart();

});
