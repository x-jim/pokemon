<?php

class Item extends ItemCore {

    public $cantidad;

    public function mapFromRs($rs) {
        $this->id = $rs->fields('id');//    ID del item, no del item del entrenador
        $this->cantidad = $rs->fields('cantidad');
        $icono = new Icono();
        $icono->mapFromArray(array(
            'id' => $rs->fields('icono_id'),
            'x' => $rs->fields('icono_x'),
            'y' => $rs->fields('icono_y')
        ));
        $this->setIcono($icono);
        $this->nombre = $rs->fields('nombre');
    }

}
