<?php

class Secuencia {

    public $id;
    public $nombre;


    function __construct() {
        $this->setEscenas(array());
    }

    public function setEscenas($escenas) {
        $this->_escenas = $escenas;
    }

    public function getEscenas() {
        return $this->_escenas;
    }

    public function setEscena($escena)
    {
        $this->_escena = $escena;
    }

    public function getEscena()
    {
        return $this->_escena;
    }

    public function getCurrentEscena() {
        foreach ($this->getEscenas() as $escena) {
            if ($escena->id == $this->getEscena()) {
                return $escena;
            }
        }
    }

    public function mapFromRs($rs) {
        $this->id = $rs->fields('id');
        $this->nombre = $rs->fields('nombre');
    }

    public function tieneEscenas() {
        if (count($this->getEscenas())) {
            return true;
        }
    }

    public function getNextEscena() {
        $escenas = $this->getEscenas();
        $escena = $this->getCurrentEscena();
        $i = 0;
        foreach ($this->getEscenas() as $e) {
            if($i == 1) {
                return $e;
            }
            if ($e->id == $escena->id) {
                $i = 1;
            }
        }
    }

    private $_escenas;
    private $_escena;

}
