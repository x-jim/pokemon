Pokemon PHP
===========

Descripción
-----------

![alt text](https://raw.github.com/ahoulgrave/pokemon/master/doc/start.png "Map")

Este juego está desarrollándose con PHP, y JQuery.

La historia está en desarrollo, y por ahora sólo está desarrollada la estructura, los mapas (con su editor), los items y las secuencias. Ésto nos permite trabajar en la historia mientras se sigue trabajando en el juego

Las peticiones asíncronas están hechas con [Long Polling] [1].

Administrador de mapas
----------------------
![alt text](https://raw.github.com/ahoulgrave/pokemon/master/doc/map_editor.jpg "Map Editor")

Los mapas son imágenes de 640x480px, con tiles de 16x16px, y cargadas en el editor de mapas, que está en administracion/map.php

Llaves
------

A medida que el usuario vaya pasando por los mapas, y las secuencias/escenas, irá adquiriendo *llaves*, que irán condicionando al usuario para acceder a diferentes partes de la historia. Éstas ayudarán a manejar la lógica del juego.

Scripting en mapas
------------------

![alt text](https://raw.github.com/ahoulgrave/pokemon/master/doc/map_editor_2.jpg "Map Editor")

Los mapas pueden llevar **zonas de acción**, que van a llevar al jugador a través de secuencias y mapas.

Para agregar una zona de acción en el mapa, en la página de edición del editor de mapas, hay que hacer **doble click** en el mapa. Va a aparecer un rectángulo rojo. Con las flechas del teclado se pueden mover, y abajo del mapa están las opciones de la zona de acción.

Los mapas, en el editor, también pueden llevar ciertas instrucciones, en un array literal de objetos de dos propiedades: **action** (String) y **params** (Object)

Valores de *action*:

* **req**:
  * params:
    * *llave* (String): Nombre de la llave requerida para ingresar al mapa.
    * *mapa* (Int): Número de mapa al que irá el usuario si no tiene la llave requerida


Por el momento sólo existe esta acción, porque fue lo que hemos requerido hasta el momento. *req* validará al usuario antes de ingresar al mapa.

Secuencias y Escenas
--------------------

![alt text](https://raw.github.com/ahoulgrave/pokemon/master/doc/secuencia.jpg "Secuencia")

Una secuencia es un conjunto de escenas, en un cierto orden, en el cuál interactúa el jugador. Éstas llevan un texto, y una imagen.

Las mismas pueden llevar instrucciones a ejecutar cuando un jugador entra a una escena, y pueden haber tantas como se necesiten. La notación es muy parecida a la de los mapas.

Lista de acciones disponibles:

* **additem**: da un item al jugador
  * params:
    * item (Int): Número de item
    * cantidad (Int): Cantidad del item en cuestión
* **addllave**: da una llave al jugador
  * params:
    * llave (String): Nombre de la llave en cuestión
* **continue**
  * params:
    * escena (Int): Número de escena de la secuencia en la que está el jugador

Ejemplo:
    
    [
      {
        "action":"additem",
        "params":{
          "item":20,
          "cantidad":2
        }
      },
      {
        "action":"additem",
        "params":{
          "item":21,
          "cantidad":1
        }
      }
    ]

En este ejemplo, se le da al jugador dos items [#20], y un item [#21].

*item* indica el *id* del item en la base de datos, y *cantidad* la cantidad de ese item que recibirá el jugador


También pueden establecerse ciertas opciones de interacción con el usuario:

* **choices**: muestra una serie de opciones para que el jugador elija
  * params:
    * opciones (Array): Lista de opciones a elegir por el jugador. Cada elemento de la lista debe tener un objeto con dos propiedades:
      * *escena* (Int): Número de escena a la que irá el jugador si elige la opción
      * *titulo* (String): Etiqueta de la opción
* **input_text**: le da al jugador un campo de texto que debe rellenar para continuar.
  * params:
    * opcion (String): Nombre clave del valor que deberás invocar para imprimir el texto que ingresó el usuario
* **fin**: indica que luego de esta escena, el jugador retornará al mapa

Ejemplo: dar al usuario opciones para que elija:

    [
      {
        "action": "choices",
        "params": {
          "opciones": [
              {
                "escena": 6,
                "titulo": "Si"
              },
              {
                "escena": 7,
                "titulo": "No"
              }
            ]
        }
      }
    ]
    
El resultado queda así:

![alt text](https://raw.github.com/ahoulgrave/pokemon/master/doc/choices.jpg "Choices")

Otro ejemplo: Pedir al usuario que ingrese un texto:

    [
      {
        "action": "input_text",
        "params": {
          "opcion": "NOMBRE_RIVAL"
        }
      }
    ]

El resultado quedaría así:

![alt text](https://raw.github.com/ahoulgrave/pokemon/master/doc/input_text.jpg "Input Text")

Para acceder a la opción, en la descripción de la escena, escribe *\__OPCION__*.  Es decir, para acceder al texto que ingresó el usuario en el ejemplo, simplemente deberás escribir *\__NOMBRE_RIVAL__*



También hay otra acción aplicable a una escena, que es **req**. Sirve para indicar que el usuario debe cumplir ciertos requerimientos para acceder a la escena. Tiene dos parámetros, que son *llave* y *escena*

* **llave** indica la llave que requerirá tener el usuario para acceder a la escena
* **escena** indica el número de escena al que accederá el usuario de no tener la llave correspondiente

Ejemplo:

    [
      {
        "action":"req",
        "params":{
          "llave":"LLAVE_DE_PRUEBA",
          "escena":10
        }
      }
    ]


Esto quiere decir que si el usuario no tiene la llave *LLAVE_DE_PRUEBA*, no se le mostrará la escena que contiene esta instrucción, si no que será llevado a la escena *10*

[1]: http://es.wikipedia.org/wiki/Tecnolog%C3%ADa_Push#Long_polling        "Long polling"
