<?php

class Entrenador {

    public $id;
    public $nombre;
    public $email;
    public $iniciado = 0;
    public $en_secuencia = 0;
    public $map;
    public $secuencia = false;
    public $escena = false;


    function __construct() {
        $this->_medallas = array();
        $this->_items = array();
        $this->_pokemons = array();
        $this->_llaves = array();
    }

    public function setPasswd($passwd) {
        $this->_passwd = $passwd;
    }

    public function getPasswd() {
        return $this->_passwd;
    }

    public function setMedallas($medallas) {
        $this->_medallas = $medallas;
    }

    public function getMedallas() {
        return $this->_medallas;
    }

    public function tieneMedallas() {
        if (count($this->getMedallas())) {
            return true;
        }
    }

    public function setItems($items)
    {
        $this->_items = $items;
    }

    public function getItems()
    {
        return $this->_items;
    }

    public function tieneItems() {
        if (count($this->getItems())) {
            return true;
        }
    }

    public function setPokemons($pokemons)
    {
        $this->_pokemons = $pokemons;
    }

    public function getPokemons()
    {
        return $this->_pokemons;
    }

    public function tienePokemons() {
        if (count($this->getPokemons())) {
            return true;
        }
    }

    public function addPokemon(Pokemon $pokemon) {
        $this->_pokemons[] = $pokemon;
    }

    public function mapFromRs($rs) {
        $this->id = $rs->fields('id');
        $this->nombre = $rs->fields('nombre');
        $this->email = $rs->fields('email');
        $this->iniciado = $rs->fields('iniciado');
        $this->en_secuencia = $rs->fields('en_secuencia');
        $this->map = $rs->fields('map');
        $this->secuencia = $rs->fields('secuencia');
        $this->escena = $rs->fields('escena');
    }

    public function setLlaves($llaves)
    {
        $this->_llaves = $llaves;
    }

    public function getLlaves()
    {
        return $this->_llaves;
    }

    public function addLlave($llave) {
        $this->_llaves[] = $llave;
    }

    public function hasLlave($llave) {
        if (in_array($llave,$this->getLlaves())) {
            return true;
        }
    }

    private $_passwd;
    private $_medallas;
    private $_items;
    private $_pokemons;
    private $_llaves;

}
