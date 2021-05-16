<?php

namespace Model;

class Inmueble extends ActiveRecord
{
    protected static $nombreTabla = 'inmueble';
    protected static $columnaDB = [
        'id', 'id_proprietario', 'titulo', 'precio', 'imagen', 'descripcion', 'num_habitacione', 'wc', 'estacionamiento'
    ];

    // atributos de la clase
    public $id_proprietario;
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $num_habitacione;
    public $wc;
    public $estacionamiento;
    public $fechaInsercion;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_proprietario= $args['id_proprietario'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->num_habitacione = $args['num_habitacione'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->fechaInsercion = $args['fechaInsercion'] ?? '';
    }

    public function validarDato()
    {

        if (!$this->titulo) {
            self::$errores[] = "Debes de añadir un titulo.";
        }

        if (!$this->precio) {
            self::$errores[] = "El precio es obligatorio.";
        }
        if (strlen($this->descripcion) < 30) {
            self::$errores[] = "La descripcion es obligatorio y debe tener  50 0 mas caracteres.";
        }

        if (!$this->num_habitacione) {
            self::$errores[] = "Numeros de abitaciones es oblogatorio.";
        }
        if (!$this->wc) {
            self::$errores[] = "Numeros de baño es oblogatorio.";
        }

        if (!$this->estacionamiento) {
            self::$errores[] = "Numeros de estacionamentos es oblogatorio.";
        }

        if (!$this->id_proprietario) {
            self::$errores[] = "Seleciona un vendedor.";
        }

        if (!$this->imagen) {
            self::$errores[] = "Debe subir una imagen.";
        }

        return self::$errores;
    }
}
