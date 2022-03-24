<?php

namespace Model;


class Servicios extends ActiveRecord {
    public static $tabla = 'servicios';
    public static $columnasDB = ['id', 'nombre', 'precio'];

    public $id;
    public $nombre;
    public $precio;

    public function __construct( $args = [] ){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

    public function validar() {
        if(!$this->nombre){
            self::$alertas['errores'][] = 'El nombre del servicio es obligatorio';
        }

        if(!$this->precio){
            self::$alertas['errores'][] = 'El precio del servicio es obligatorio';
        }

        if(!is_numeric($this->precio)){
            self::$alertas['errores'][] = 'El precio no es válido';
        }

        return self::$alertas;
    }


}