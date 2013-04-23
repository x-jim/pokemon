$(document).ready(function(){

    var size = [160,120];

    $("#form").hide();


    var tileset = $("#tileset");

    $("#cancelar").click(function(){
        $("#form").slideUp("slow",function(){
            tileset.fadeIn("slow");
        });
        return false;
    });

    tileset.css({

    });
    var cont = $("<div />");
    cont.appendTo(tileset);

    $.ajax({
        type: "post",
        url: "ajax/map.php",
        data: {size:size, capa: $('#capa').val()},
        dataType: "json",
        success: function(data){
            if (data.max_x == null) {
                data.max_x = 0;
            }
            if (data.max_y == null) {
                data.max_y = 0;
            }
            for (var i = 1; i <= parseInt(data.max_y)+1; i++) {
                for (var j = 1; j <= parseInt(data.max_x)+1; j++) {
                    var tile = $("<div />");
                    tile.data('x',j);
                    tile.data('y',i);
                    tile.width(size[0]);
                    tile.height(size[1]);
                    tile.mouseenter(function(){
                        var obj = $(this);
                        $("<div />").css({
                                        'background-image':"url('../img/map_sel.png')",
                                        'width':size[0]+"px",
                                        'height':size[1]+"px"
                                    }).appendTo(obj);
                    }).mouseleave(function(){
                        $(this).html("");
                    });
                    tile.css({
                        "position":"absolute",
                        "left": (j-1)*size[0]+"px",
                        "top": (i-1)*size[1]+"px",
                        cursor: "pointer"
                    });
                    if (data.maps[j+'-'+i] != undefined) {
                        tile.data('id',data.maps[j+'-'+i].map.id);
                        tile.css({
                            background: "url('../" + data.maps[j+'-'+i].map.imagen + "')"
                        }).click(function(){
                            window.location.href = 'map_edit.php?id='+$(this).data('id');
                        });
                    } else {
                        tile.css({
                            background: "url('../img/map_empty.png')"
                        });
                        tile.attr("title","Nuevo Mapa").click(function(){
                            var x = $(this).data('x');
                            var y = $(this).data('y');
                            tileset.fadeOut("slow", function(){
                                var form = $("#form");
                                $("#coords").val(x+'-'+y);
                                $("#coords2").val(x+'-'+y);
                                form.slideDown("slow");
                            });
                        });
                    }
                    tile.appendTo(cont);
                }
            }
        }
    });

    var addCapa = true;

    $(".capas ul li.new a").click(function(){
        if (addCapa) {
            addCapa = false;
            var nombre = prompt('Nombre de la nueva capa');
            if (nombre != null && nombre != '') {
                $.ajax({
                    url: 'ajax/map_capa_add.php',
                    type: 'post',
                    data: {nombre: nombre, carpeta: $("#carpeta").val()},
                    dataType: 'json',
                    success: function(id){
                        if (id) {
                            var li = $("<li />");
                            $("<a  />").attr('href','map.php?c=' + id).html(nombre).appendTo(li);
                            li.hide();
                            li.insertBefore('li.new:first');
                            li.slideDown('slow',function(){
                                addCapa = true;
                            });
                        } else {
                            alert('error');
                            addCapa = true;
                        }
                    }
                });
            } else {
                addCapa = true;
            }
        }
    });

});