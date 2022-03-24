<?php

namespace Model;

class Usuario extends ActiveRecord {
   protected static $tabla = 'usuarios';
   protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono', 'email', 'password', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    public $password;
    public $admin;
    public $confirmado;
    public $token;


    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $agrs['nombre'] ?? '';
        $this->apellido = $agrs['apellido'] ?? '';
        $this->telefono = $agrs['telefono'] ?? '';
        $this->email = $agrs['email'] ?? '';
        $this->password = $agrs['password'] ?? '';
        $this->admin = $agrs['admin'] ?? '0';
        $this->confirmado = $agrs['confirmado'] ?? '0';
        $this->token = $agrs['token'] ?? '';
    }

    // Validar los datos que llena el usuario
    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas['errores'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->apellido){
            self::$alertas['errores'][] = 'El Apellido es Obligatorio';
        }
        if(!$this->telefono){
            self::$alertas['errores'][] = 'El Teléfono es Obligatorio';
        }
        if(!$this->email){
            self::$alertas['errores'][] = 'El Email es Obligatorio';
        }
        if(!$this->password){
            self::$alertas['errores'][] = 'El Password es Obligatorio';
        }
        if(strlen($this->password) < 6){
            self::$alertas['errores'][] = 'El Password debe tener al menos 6 caracteres';
        }

        return self::$alertas;
    }

    public function verificarCorreo(){
        $query = " SELECT * FROM ". self::$tabla." WHERE email = '". $this->email ."' LIMIT 1";

        $resultado = self::$db->query($query);
        
        if($resultado->num_rows){
            self::$alertas['errores'][] = 'El Usuario ya está Registrado';
        }

        return $resultado;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken(){
        $this->token = uniqid();
    }

    public function validarLogin() {
        if(!$this->email){
            self::$alertas['errores'][] = 'El Email es Obligatorio';
        }

        if(!$this->password){
            self::$alertas['errores'][] = 'El Password es Obligatorio';
        }

        return self::$alertas;
    }

    public function validarPasswordAndConfirmado($password) {
        $resultado = password_verify($password, $this->password);
        
        if(!$this->confirmado || !$resultado){
            Self::$alertas['errores'][] = 'El password es incorrecto o la cuenta no está confirmada';
        } else {
            return true;
        }
    }

    public function validarEmail(){
        if(!$this->email){
            self::$alertas['errores'][] = 'El Email es Obligatorio';
        }

        return Self::$alertas;
    }

    public function validarPassword(){
        if(!$this->password){
            self::$alertas['errores'][] = 'El Password es Obligatorio';
        }

        if(strlen($this->password) < 6){
            self::$alertas['errores'][] = 'El Password debe contener minimo 6 caracteres';
        }
    }
}