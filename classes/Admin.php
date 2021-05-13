<?php

use App\ActiveRecord;

class Admin extends ActiveRecord{
    protected static $table = 'usuario';
    protected static $columnasDB = ['id_usuario', 'email', 'password'];

    public $id_usuario; 
    public $email;
    public $password;

    public function __construct($args =[]){
        $this->id_usuario = $args['$id_usuario'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';

    }

    public function validar(){
        if(!$this->email){
            self::$errores[] = 'El Email es Obligatório';
        }

        if(!$this->password){
            self::$errores[] = 'El password es Obligatório';
        }

        return self::$errores;
    }
   
    public function exiteUsuario(){
       // revisamos si el usuario esite 
       
       $query ="SELECT * FROM ". self::$table . " WHERE email = '";
       $query .= $this->email . "' LIMIT 1";

       $resultado = self::$db->query($query);

       if(!$resultado->num_rows){
            self::$errores[] = 'El Usuario no existe.';
            return;
       }
       return $resultado;

       //ImprimirObjecto($resultado);
    }

    public function comprobarPassword($resultado){
        $usuario = $resultado->fetch_object();

        $autenticado = password_verify($this->password,  $usuario->password);

        if(!$autenticado){
            self::$errores[] = 'El password es Incorrecto.';
        }
        return $autenticado;

       // ImprimirObjecto($usuario);
    }

    public function autenticasUsuario(){
        session_start();

        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: admin');

    }

}