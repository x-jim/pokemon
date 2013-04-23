<?php

class Icono {

    public $id;
    public $imagen = 'items.png';
    public $x;
    public $y;
    public $w = 23;
    public $h = 23;

    public function render() {
        return '<i style="background: url(\'img/' . $this->imagen . '\') no-repeat ' . ($this->x*-1) . 'px ' . ($this->y*-1) . 'px;width:' . $this->w . 'px;height:' . $this->h . 'px;display:inline-block;"></i>';
    }

    public function mapFromRs($rs) {
        $this->id = $rs->fields('id');
        $this->x = $rs->fields('x');
        $this->y = $rs->fields('y');
    }

    public function mapFromArray($array) {
        $this->id = $array['id'];
        $this->x = $array['x'];
        $this->y = $array['y'];
    }

}
