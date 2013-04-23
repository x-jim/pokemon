$(document).ready(function(){


    $(".zona").live('click',function(){
        $(".zona.activa").removeClass('activa');
        $(this).addClass("activa");
        var ztitulo = $("#zona_titulo_"+$(this).attr("rel"));
        if (ztitulo.val()) {
            $("#ztitulo").val(ztitulo.val());
        } else {
            $("#ztitulo").val("");
        }
        zmapa = $("#zona_map_"+$(this).attr("rel"));
        if (zmapa.val()) {
            $("#mapas").val(zmapa.val());
        } else {
            $("#mapas").val(0);
        }
        zsecuencia = $("#zona_secuencia_"+$(this).attr("rel"));
        if (zsecuencia.val()) {
            $("#secuencia").val(zsecuencia.val());
        } else {
            $("#secuencia").val(0);
        }
        $(".eliminarZona").remove();
        $("<a />").css({
            "background": "url('../img/icons/glyphicons_016_bin_11x20.png') no-repeat left center",
            "padding": "3px 5px 3px 16px",
            "font-size": "11px",
            "cursor": "pointer"
        }).addClass("eliminarZona").html("Eliminar zona").click(function(){
            if (!confirm('seguro?')) {
                return false;
            }
            var obj = $(this);
            $.ajax({
                url: "ajax/map_delete.php",
                type: "post",
                data: {id: $(".zona.activa").attr("rel")},
                success: function() {
                    $(".zona.activa").remove();
                    obj.remove();
                }
            });
        }).appendTo("#zonas_form");

    });

    $("#ztitulo").keyup(function(){
        var zona = $(".zona.activa");
        if (zona.size() > 0) {
            $("#zona_titulo_"+zona.attr("rel")).val($(this).val());
        }
    });

    $("#mapas").change(function(){
        var zona = $(".zona.activa");
        if (zona.size() > 0) {
            $("#zona_map_"+zona.attr("rel")).val($(this).val());
        }
    });

    $("#secuencia").change(function(){
        var zona = $(".zona.activa");
        if (zona.size() > 0) {
            $("#zona_secuencia_"+zona.attr("rel")).val($(this).val());
        }
    });

    $(".mapa").dblclick(function(){
        $.ajax({
            type: 'post',
            url: 'ajax/map_zona.php',
            data: {map:$("#id_map").val()},
            success: function(id) {
                $("<div />").css({
                    width: "64px",
                    height: "32px",
                    top:0,
                    left:0
                }).attr("rel",id).addClass('zona').appendTo(".mapa").trigger('click');
                $("<input />").attr({
                    "type":"hidden",
                    "id":"zona_secuencia_"+id
                }).appendTo("body");
                $("<input />").attr({
                    "type":"hidden",
                    "id":"zona_map_"+id
                }).appendTo("body");
                $("<input />").attr({
                    "type":"hidden",
                    "id":"zona_titulo_"+id
                }).appendTo("body");
            }
        });
    });

    var guardando = false;
    $("#guadar_zonas").click(function(){
        if (!guardando) {
            guardando = true;
            var obj = $(this);
            var original = obj.html();
            obj.html("Guardando...");
            var zonas = $(".zona");
            var i = 0;
            var data = [];
            zonas.each(function(){
                var zona = $(this);
                data[i] = {
                    "id":zona.attr("rel"),
                    "mapa":$("#zona_map_"+zona.attr("rel")).val(),
                    "secuencia":$("#zona_secuencia_"+zona.attr("rel")).val(),
                    "titulo":$("#zona_titulo_"+zona.attr("rel")).val(),
                    "pos_x":parseInt(zona.css("left")),
                    "pos_y":parseInt(zona.css("top")),
                    "width":zona.width(),
                    "height":zona.height()
                };
                i++;
                if (i == zonas.size()) {
                    $.ajax({
                        url: "ajax/map_save.php",
                        data: "data="+JSON.stringify(data),
                        type: "post",
                        success: function(m) {
                            if (m == 1) {
                                obj.html(original);
                            } else {
                                obj.html("Error");
                            }
                            guardando = false;
                        }
                    });
                }
            });
        }
    });

    $(document).keydown(function(event) {
        var zona = $(".zona.activa");
        var obj = $(this);
        if (zona.size() > 0) {

            if (event.ctrlKey) {
                event.preventDefault();
                //  Derecha
                if (event.which == 39) {
                    if (zona.width() < 624) {
                        zona.width(zona.width()+16);
                    }
                }
                //  Izquierda
                if (event.which == 37) {
                    if (zona.width() > 16) {
                        zona.width(zona.width()-16);
                    }
                }
                //  Abajo
                if (event.which == 40) {
                    if (zona.height() < 464) {
                        zona.height(zona.height()+16);
                    }
                }
                //  Arriba
                if (event.which == 38) {
                    if (zona.height() > 16) {
                        zona.height(zona.height()-16);
                    }
                }
            } else {

                if (event.which == 9) {
                    event.preventDefault();
                    if (event.shiftKey) {
                        var siguiente = zona.prev('.zona');
                        if (siguiente.size() > 0) {
                            siguiente.trigger('click');
                        } else {
                            $(".zona:last").trigger("click");
                        }
                    } else {
                        var siguiente = zona.next('.zona');
                        if (siguiente.size() > 0) {
                            siguiente.trigger('click');
                        } else {
                            $(".zona:first").trigger("click");
                        }
                    }

                }
                //  Derecha
                if (event.which == 39) {
                    event.preventDefault();
                    if ((parseInt(zona.css("left"))+zona.width()) < 640) {
                        zona.css("left",(parseInt(zona.css("left"))+16)+"px");
                    }
                }
                //  Izquierda
                if (event.which == 37) {
                    event.preventDefault();
                    if (parseInt(zona.css("left")) >= 16) {
                        zona.css("left",(parseInt(zona.css("left"))-16)+"px");
                    }
                }
                //  Abajo
                if (event.which == 40) {
                    event.preventDefault();
                    if ((parseInt(zona.css("top"))+zona.height()) <= 466) {
                        zona.css("top",(parseInt(zona.css("top"))+16)+"px");
                    }
                }
                //  Arriba
                if (event.which == 38) {
                    event.preventDefault();
                    if (parseInt(zona.css("top")) >= 16) {
                        zona.css("top",(parseInt(zona.css("top"))-16)+"px");
                    }
                }
            }
        }
    });


});