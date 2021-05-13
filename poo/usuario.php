<?php 
class Usuario { 

    private $id;
    private $nombre;
    private $apellido;
    private $telefono;
    private $email;
    private $password;
    private $fechaInscripcion;

    public function __construct($id, $nombre,  $apellido, $telefono, $email, $password, $fechaInscripcion){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->password = $password;
        $this->fechaInscripcion = $fechaInscripcion;
    }

    public function setId($id) {
        $this->id = $id;
    }


    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }


    public function setMail($email){
        $this->email = $email;
    }


    public function setPass($password){
        $this->password = $password;
    }

    public function setfechaInscripcion($fechaInscripcion){
        $this->fechaInscripcion = $fechaInscripcion;
    }

    // GETES

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getFechaInscripcion() {
        return $this->emfechaInscripcionail;
    }


}