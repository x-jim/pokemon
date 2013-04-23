<?php

class Mensaje {

    public $tipo = 'info';
    public $titulo;
    public $mensaje;

    function __construct($mensaje = false, $tipo = false, $titulo = false)
    {
        $this->mensaje = $mensaje;
        if ($tipo)
            $this->tipo = $tipo;
        $this->titulo = $titulo;
    }


}
