<?php
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGE',  $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');
define('CARPETA_SESSIONE', __DIR__ . '/../seccion/');


function incluirTemplate(string $nombre, bool $inicio = false)
{

    include  TEMPLATES_URL . "/${nombre}.php";
}


function deputarCod($objecto)
{
    echo "<pre>";
    var_dump($objecto);
    echo "</pre>";

    echo date('d/m/Y h:m:s');
    exit;
}

// escapa html 

// sc (sn Code_Sano)= sanitizar el codigo, evitando caracteres raros asi como scripts maliciosos.
function Cs($html): string
{
    $cs = htmlspecialchars($html);
    return $cs;
}

function validarTipoConetenido($tipo)
{
    $tipos = ['inmueble', 'proprietario'];
    return in_array($tipo, $tipos);
}

// mustras los mensaje de aciones CRUD
function notificacionAccion($code)
{
    $mensaje = '';
    switch ($code) {
        case 1:
            $mensaje = 'Creado correctamente.';
            break;
        case 2:
            $mensaje = 'Actualizado correctamente.';
            break;
        case 3:
            $mensaje = 'Eliminado correctamente.';
            break;
        default:
            $mensaje = false;
            break;
    }
    return  $mensaje;
}

function validarOredireccionar(string $url)
{
    
    // Validar la URL por ID válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id || $id === null) {
       // deputarCod($url);
        header("Location:". $url);
    }
    return $id;
}
