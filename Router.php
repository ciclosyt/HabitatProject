<?php

namespace MVC;
require_once 'includesFiles.php';
class Router
{
    public $rutaGET = [];
    public $rutaPOST = [];

    public function get($url, $fn)
    {
        $this->rutaGET[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->rutaPOST[$url] = $fn;
    }


    public function getURL()
    {
        session_start();

        $auth = $_SESSION['login'] ?? null;

        // array de url protegidas 
        $url_protegita = ['/admin', '/inmueble/crear', '/inmueble/actualizar',
         '/inmueble/eliminar', '/proprietario/crear', '/proprietario/actualizar', '/proprietario/eliminar'] ;

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';

        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $fn = $this->rutaGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutaPOST[$urlActual] ?? null;
        }

        //protejer url

        if(in_array($urlActual, $url_protegita) && !$auth){
            header('Location: ../');
        }

        if ($fn) {
            call_user_func($fn, $this);
        } else {
           // echo "Página no encontrada error 404";
            header('Location: ../');
            
        }
    }

    // muestra vista 

    public function render($views, $datos = [])
    {
        foreach ($datos as $clave => $valor) {
            $$clave = $valor; // doble dolar [variable de variablle] 
        }
        ob_start();
        include __DIR__ . "/views/$views.php";
        $contenido = ob_get_clean();
        include __DIR__ . "/views/layout.php";
    }
}
