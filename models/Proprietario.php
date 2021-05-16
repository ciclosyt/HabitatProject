<?php

namespace Model;

class Proprietario extends ActiveRecord
{
    protected static $nombreTabla = 'proprietario';
    protected static $columnaDB = [
        'id', 'nombre', 'apellido', 'telefono', 'email', 'password', 'fecha_inscripcion'
    ];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public $email;
    public $password;
    public $fecha_inscripcion;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->fecha_inscripcion = $args['fecha_inscripcion'] ?? '';
    }


    public function validarDato()
    {

        if (!$this->nombre) {
            self::$errores[] = "Debe proporcionar un nombre.";
        }

        if (!$this->apellido) {
            self::$errores[] = "Debe proporcionar un apellido.";
        }


        // if (!$this->telefono) {
        //     self::$errores[] = "Debe proporcionar un numero de telefono.";
        // } 

        if (!$this->telefono) { // (!$this->telefono) || (
            self::$errores[] = "Debe proporcionar un numero de telefono.";
        } else if (!preg_match('/[0-9]{9}/', $this->telefono)) {
            self::$errores[] = "Formato de numero de telefono no valido";
        }

        if (!$this->email) {
            self::$errores[] = "Debe proporcionar un de email.";
        }

        if (!$this->password) {
            self::$errores[] = "Debe proporcionar una contraseña.";
        }

        return self::$errores;
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

    
}
