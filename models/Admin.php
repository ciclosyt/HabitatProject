<?php

namespace Model;

class Admin extends ActiveRecord
{
    protected static $nombreTabla = 'admin';
    //protected static $columnasDB = ['id_usuario', 'email', 'password'];
    //protected static $columnasDB = ['id', 'email', 'password'];
    protected static $columnasDB = ['id', 'email', 'password', 'pwd1', 'pwd1'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['$id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->pwd1 = $args['pwd1'] ?? '';
        $this->pwd2 = $args['pwd2'] ?? '';
    }

    public function validar()
    {
        if (!$this->email) {
            self::$errores[] = 'El Email es Obligatório';
        }

        if (!$this->password) {
            self::$errores[] = 'El password es Obligatório';
        }

        return self::$errores;
    }

    public function exiteUsuario()
    {
        // revisamos si el usuario esite 

        $query = "SELECT * FROM " . self::$nombreTabla . " WHERE email = '";
        $query .= $this->email . "' LIMIT 1";
        //deputarCod($query);

        $resultado = self::$db->query($query);

        if (!$resultado->num_rows) {
            self::$errores[] = 'El Usuario no existe.';
            return;
        }
        return $resultado;
    }

    // VALIDACIOES PWD
    public function updatePWD($email, $pwd)
    {
        $query = "UPDATE " . static::$nombreTabla . " SET password = '${pwd}' WHERE email = '${email}'";

        //deputarCod($query);
        $resultado = self::$db->query($query);

        return $resultado;
    }

    public static function findUser($email)
    {
        // Obtener los datos del inmueble
        $query = "SELECT * FROM " . static::$nombreTabla . " WHERE email =  '${email}'";
        
        $resultado = self::$db->query($query);
        $objecto = $resultado->fetch_object();
        //deputarCod($usuario);
        return $objecto;
    }

    public function comprobarPassword($resultado)
    {
        $usuario = $resultado->fetch_object();

        $autenticado = password_verify($this->password,  $usuario->password);

        if (!$autenticado) {
            self::$errores[] = 'El password es Incorrecto.';
        }
        return $autenticado;

        // ImprimirObjecto($usuario);
    }

    public function autenticaUsuario()
    {

        if (session_id() == '') {
            session_start();
        }
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }


    public static function starSecion()
    {
        $estado = false;
        if (session_id() == '') {
            $estado = false;
        } else {
            $estado = true;
        }

        return $estado;
    }


    public function validarPwd()
    {
        if (!$this->email) {
            self::$errores[] = 'El email es Obrigatório.';
        }

        if (!$this->pwd1) {
            self::$errores[] = 'Digite la nueva contraseña por favor.';
        }

        if (!$this->pwd2) {
            self::$errores[] = 'Vuelve a diginar la nueva contraseña';
        }

        if ($this->pwd1 != $this->pwd2) {
            self::$errores[] = 'La contraseña no coincide en los dos campos';
        }

        return self::$errores;
    }
}
