<?php

class Foto
{

    private $_id;
    private $_foto;
    private $_orden;
    private $_carpeta;
    
    public function __construct($_carpeta = 'uploads/') {
        $this->setCarpeta($_carpeta);
    }
    
    public function getCarpeta() {
        return $this->_carpeta;
    }

    public function setCarpeta($_carpeta) {
        $this->_carpeta = $_carpeta;
    }
    
    public function getId() {
        return $this->_id;
    }

    public function setId($_id) {
        $this->_id = $_id;
    }

    public function getFoto($carpeta = false) {
        if ($carpeta) {
            return $this->getCarpeta() . $this->_foto;
        }
        return $this->_foto;
    }

    public function setFoto($_foto) {
        $this->_foto = $_foto;
    }

    public function getOrden() {
        return $this->_orden;
    }

    public function setOrden($_orden) {
        $this->_orden = $_orden;
    }

    public function map($array) {
        if (is_array($array)) {
            $this->setId($array['id']);
            $this->setFoto($array['foto']);
            $this->setOrden($array['orden']);
        }
    }
    
    public function mapFromRow ($rs) {
        $array = array(
            'id' => $rs->fields('id'),
            'foto' => $rs->fields('foto'),
            'orden' => $rs->fields('orden')
        );
        $this->map($array);
    }
    
    public static function rowToArray(Zend_Db_Table_Row $row) {
        $array = array();
        $array['id'] = $row->id;
        $array['foto'] = $row->foto;
        $array['orden'] = $row->orden;
        return $array;
    }
    
    public function getThumb($w = 200, $h = 250, $opciones = false)
    {
        /*$src = $this->getFoto();
        $src = str_replace(array('/','&',' ',':'), "-", $src);*/
        
        $src = APPLICATION_PATH."/" . $this->getCarpeta() .$this->getFoto();
        $ws = ($w)?$w:'200';
        $hs = ($h)?$h:'250';
        $final = $this->getCarpeta() .$ws."x".$hs.'/'.$this->getFoto();
        $finalr = $final;
        //echo $src;
        if(!file_exists($finalr))
        {
            $handle = new Upload($src);
            if($handle->uploaded)
            {
                $handle->file_safe_name = FALSE;
                $handle->image_resize = true;
                $handle->file_auto_rename = false;
                if($w && !$h)
                {
                     $handle->image_x = $w;
                     $handle->image_ratio_y = true;
                }
                elseif(!$w && $h)
                {
                     $handle->image_y = $h;
                     $handle->image_ratio_y = true;
                }
                else
                {
                    $handle->image_ratio = true;
                    $handle->image_y = $h;
                    $handle->image_x = $w;
                }
                $handle->image_ratio_crop = true;
                if ($opciones && is_array($opciones) && !empty($opciones)) {
                    foreach ($opciones as $opcion => $valor) {
                        $handle->{$opcion} = $valor;
                    }
                }
                if (!$handle->Process(APPLICATION_PATH.'/' . $this->getCarpeta() .$ws."x".$hs.'/')) {
                    //echo $handle->error.'(' . APPLICATION_PATH.'/' . $this->getCarpeta() .$ws."x".$hs.'/' . ')';
                }
        
            } else {
				echo $handle->error;
			}
            //var_dump($handle);
        }
        return $final;
    }
    
}

