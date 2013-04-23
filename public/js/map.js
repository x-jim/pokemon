$(document).ready(function(){

    var mapa = $(".mapa");

    $(".mapa a").tooltip();

    var regiones = [
        [
            {x:0,y:0},
            {x:640,y:0},
            {x:320,y:240}
        ],
        [
            {x:640,y:0},
            {x:320,y:240},
            {x:640,y:480}
        ],
        [
            {x:320,y:240},
            {x:640,y:480},
            {x:0,y:480}
        ],
        [
            {x:0,y:0},
            {x:320,y:240},
            {x:0,y:480}
        ]
    ];

    function loadMap() {
        var mapa = $(".mapa");
        mapa.html("");
        var cargando = $("<div />").css({
            "width": mapa.css("width"),
            "height": "380px",
            "position":"absolute",
            "background":"url('img/black.png')",
            "top":0,
            "left":0,
            "display":"none",
            "padding-top":"100px",
            "font-size":"12px",
            "color":"#FFFFFF",
            "text-align":"center"
        });
        cargando.html("Cargando mapa...")
        cargando.appendTo(mapa);
        cargando.fadeIn("slow", function(){
            $.ajax({
                type: "POST",
                url: "ajax/map.php",
                data: { name: "John", location: "Boston" },
                dataType: "json",
                success: function(data){
                    cargando.fadeOut("slow", function(){
                        cargando.remove();
                    });
                    var zonas = data.zonas;
                    for (var i = 0; i < zonas.length; i++) {
                        var a = $("<a />");
                        if (zonas[i].titulo !== null) {
                            a.attr("title",zonas[i].titulo);
                            a.tooltip();
                        }
                        a.css({
                            "left":zonas[i].x+"px",
                            "top":zonas[i].y+"px",
                            "width":zonas[i].width+"px",
                            "height":zonas[i].height+"px"
                        });

                        if (zonas[i].mapa != false) {
                            a.addClass('gomap');
                            if (isPointInPoly(regiones[0],{x:zonas[i].x,y:zonas[i].y})) {
                                a.data('dir',"arriba");
                                a.addClass("arriba");
                                a.attr("title","Subir").tooltip({placement:"bottom"});
                            }
                            if (isPointInPoly(regiones[1],{x:zonas[i].x,y:zonas[i].y})) {
                                a.data('dir',"derecha");
                                a.addClass("derecha");
                                a.attr("title","Derecha").tooltip({placement:"left"});
                            }
                            if (isPointInPoly(regiones[2],{x:zonas[i].x,y:zonas[i].y})) {
                                a.data('dir',"abajo");
                                a.addClass("abajo");
                                a.attr("title","Bajar").tooltip({placement:"top"});
                            }
                            if (isPointInPoly(regiones[3],{x:zonas[i].x,y:zonas[i].y})) {
                                a.data('dir',"izquierda");
                                a.addClass("izquierda");
                                a.attr("title","Izquierda").tooltip({placement:"right"});
                            }
                            a.data('to',zonas[i].mapa);

                            a.click(function(){
                                var to = $(this).data('to');
                                var dir = $(this).data('dir');
                                var cargando = $("<div />").css({
                                    "width": mapa.css("width"),
                                    "height": "380px",
                                    "position":"absolute",
                                    "background":"url('img/black.png')",
                                    "top":0,
                                    "left":0,
                                    "display":"none",
                                    "padding-top":"100px",
                                    "font-size":"12px",
                                    "color":"#FFFFFF",
                                    "text-align":"center"
                                });
                                cargando.html("Viajando...");
                                cargando.appendTo(mapa);
                                cargando.fadeIn("slow",function(){
                                    $.ajax({
                                        type:"POST",
                                        url: "ajax/move.php",
                                        data: {to:to},
                                        dataType: "json",
                                        success: function(msj){
                                            cargando.fadeOut("slow", function(){
                                                cargando.remove();
                                                if (msj.error) {
                                                    alert(msj.error);
                                                } else if (msj.secuencia) {
                                                    window.location.href = 'oak.php';
                                                } else {
                                                    var wrapper = $("<div />");
                                                    wrapper.css({
                                                        "width": mapa.css("width"),
                                                        "height": mapa.css("height"),
                                                        "overflow":"hidden",
                                                        "position":"relative"
                                                    });
                                                    wrapper.detach().insertBefore(mapa);
                                                    mapa.html("").appendTo(wrapper);
                                                    var nmapa = $("<div />");
                                                    nmapa.css({
                                                        "background-image":"url('"+msj.imagen+"')",
                                                        "position":"absolute"
                                                    });

                                                    var currentAnimation = {};

                                                    if (dir == "arriba") {
                                                        nmapa.css({
                                                            "top":"-480px",
                                                            "left":"0"
                                                        });
                                                        currentAnimation = {
                                                            top: "+=480"
                                                        };
                                                    } else if (dir == "derecha") {
                                                        nmapa.css({
                                                            "top":"0",
                                                            "left":"640px"
                                                        });
                                                        currentAnimation = {
                                                            left: "-=640"
                                                        };
                                                    } else if (dir == "abajo") {
                                                        nmapa.css({
                                                            "top":"480px",
                                                            "left":"0"
                                                        });
                                                        currentAnimation = {
                                                            top: "-=480"
                                                        };
                                                    } else if (dir == "izquierda") {
                                                        nmapa.css({
                                                            "top":"0",
                                                            "left":"-640px"
                                                        });
                                                        currentAnimation = {
                                                            left: "640"
                                                        };
                                                    }

                                                    var slider = $("<div />").css({
                                                        "position":"relative"
                                                    });
                                                    slider.appendTo(wrapper);
                                                    mapa.detach().appendTo(slider);
                                                    nmapa.addClass("mapa").appendTo(slider);

                                                    slider.animate(currentAnimation, 1000, function(){
                                                        mapa.remove();
                                                        nmapa.detach().css({
                                                            "position":"relative",
                                                            "top":"0",
                                                            "left":"0"
                                                        }).insertBefore(wrapper);
                                                        wrapper.remove();
                                                        loadMap();
                                                    });
                                                }
                                            });
                                        }
                                    });
                                });
                            });
                        } else if (zonas[i].secuencia != false) {
                            a.data('quest',zonas[i].secuencia);
                            a.click(function(){
                                var quest = $(this).data('quest');
                                $.ajax({
                                    url:"ajax/quest.php",
                                    type: "post",
                                    data: {"quest":quest},
                                    success: function(data) {
                                        if (data.error) {
                                            alert(data.error);
                                        } else {
                                            window.location.href = 'oak.php';
                                        }
                                    }
                                });
                            });
                        }
                        a.appendTo(mapa);
                        a = null;
                    }
                }
            });
        });
    }

    loadMap();

});