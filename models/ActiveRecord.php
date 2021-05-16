<?php

namespace Model;

class ActiveRecord
{
    // estancia DB 
    protected static $db;
    protected static $columnaDB = [];

    protected static $nombreTabla = '';

    // validaciones 

    protected static $errores = [];

    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function guardar()
    {
        //ImprimirObjecto($this);
        if (!is_null($this->id)) { // !is_null($this->id)
            // actualizar
            $this->actualizarData();
        } else {
            // creando un nuevo registro
            $this->crearData();
        }
    }

    public function crearData()
    {
        // utilizando No injecion SQL
        $atributo = $this->noInjectionSQL();

        $stringKey = join(', ', array_keys($atributo));
        $stringValor = join(', ', array_values($atributo));
        //ImprimirObjecto($stringKey);

        //echo "Guardando BD";
        $sql = "INSERT INTO " . static::$nombreTabla . " ( ";
        $sql .= join(', ', array_keys($atributo));
        $sql .= ") VALUES (' ";
        $sql .= join("', '", array_values($atributo));
        $sql .= " ') ";

        //ImprimirObjecto($sql);
        $resultado = self::$db->query($sql);

        if ($resultado) { 
            header('Location: /admin?resultado=1');
        }
    }

    public function actualizarData()
    {

        // utilizando No injecion SQL
        $atributos = $this->noInjectionSQL();
        $valores = [];

        foreach ($atributos as $clave => $valor) {
            $valores[] = "{$clave}='{$valor}'";
        }

        $query = "UPDATE " . static::$nombreTabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE  id ='" . self::$db->escape_string($this->id) . "'";
        $query .= " LIMIT 1";

        $resultado = self::$db->query($query);

        if ($resultado) {
            // REGIRIGIR EN OTRA PAGINA
            header('Location: /admin?resultado=2');
        }
    }

    public function eliminarData()
    {
        // ImprimirObjecto('Borrando...'. $this->id);
        $this->eliminarImg();
        $query = "DELETE FROM " . static::$nombreTabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if ($resultado) {
            header('location: /admin?resultado=3');
        }
    }

    public function noInjectionSQL()
    {
        $atributos = $this->atributos();
        $noSql = [];

        foreach ($atributos as $key => $valor) {
            $noSql[$key] = self::$db->escape_string($valor);
        }
        return $noSql;
    }

    public function atributos()
    {
        foreach (static::$columnaDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // validar 
    public static function getErrores()
    {
        return static::$errores;
    }

    public function validarDato()
    {
        static::$errores = [];
        return static::$errores;
    }

    // subir la imagens
    public function setImagen($imagen)
    {

        if (!is_null($this->id)) {
            // comprabar que existe el archivo
            $this->eliminarImg();
        }

        if ($imagen) {
            $this->imagen = $imagen;
        }

    }

    public function eliminarImg()
    {
        $existeImg = file_exists(CARPETA_IMAGE . $this->imagen);

        if ($existeImg) {
            unlink(CARPETA_IMAGE . $this->imagen);
        }
    }


    public static function getData($limit)
    {
        $query = "SELECT * FROM " . static::$nombreTabla . " LIMIT " . $limit; 

        $resultado = self::consutaSQL($query);
        return $resultado;
    }

    // Obtener un numeros registo

    public static function listarData()
    {
        $query = "SELECT * FROM " . static::$nombreTabla; // LIMIT 2 
        $resultado = self::consutaSQL($query);
        return $resultado;
    }

    public static function findData($id)
    {
        // Obtener los datos del inmueble
        $query = "SELECT * FROM " . static::$nombreTabla . " WHERE id = ${id}";

        //ImprimirObjecto($query );
        $resultado = self::consutaSQL($query);

        return array_shift($resultado); // array_shift = returna un determinado objecto en una array de objecto
    }



    public static function consutaSQL($query)
    {
        $resultado = self::$db->query($query);

        // consultar BD

        //Iterar BD
        $arrayObjecto = [];
        while ($registro = $resultado->fetch_assoc()) {
            $arrayObjecto[] = static::crearObjecto($registro);
        }
        //limpiar memoria 
        $resultado->free();
        // devolver los datos
        return $arrayObjecto;
    }

    public static function crearObjecto($registro)
    {
        $objecto = new static;

        foreach ($registro as $clave => $valor) {
            if (property_exists($objecto, $clave)) {
                $objecto->$clave = $valor;
            }
        }

        return $objecto;
    }

    // sincronizar los datos en memoria con los  cambios de usuario a la hora de actualizar datos 
    public function sincronizaDato($args = [])
    {

        foreach ($args as $clave => $valor) {
            if (property_exists($this, $clave) && !is_null($valor)) {
                $this->$clave = $valor;
            }
        }
    }
}
