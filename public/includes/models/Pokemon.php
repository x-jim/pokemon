<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrador
 * Date: 28/11/12
 * Time: 18:48
 * To change this template use File | Settings | File Templates.
 */
class Pokemon extends PokemonCore {

    public $mote = false;

    public function getNombre() {
        if ($this->mote) {
            return $mote;
        } else {
            return $this->nombre;
        }
    }

    private $_nivel;
    private $_exp;

}
