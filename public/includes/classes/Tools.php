<?php

class Tools {

    static function Validar($data, $opciones){

        $mensajes = array();

        $opciones = json_decode($opciones);

        foreach ($opciones as $opcion) {
            foreach ($data as $nombre => $valor) {
                if ($opcion->campo == $nombre) {
                    foreach ($opcion->validadores as $validador) {
                        switch ($validador->tipo) {
                            case 'notEmpty':
                                if (!$valor) {
                                    $mensajes[] = new Mensaje($validador->mensaje,'error');
                                }
                            break;
                            case 'email':
                                if (!self::isEmail($valor))
                                    $mensajes[] = new Mensaje($validador->mensaje,'error');
                            break;
                        }
                    }
                }
            }
        }


        return $mensajes;

    }

    static function isEmail($email) {
        if ($email)
            return true;
    }

}
