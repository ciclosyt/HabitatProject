<?php

namespace Controllers;

use MVC\Router;
use Model\Inmueble;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {
        $inicio = true;
        $inmueble = Inmueble::getData(3);
        $router->render('paginas/index', [
            'inmueble' => $inmueble,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros', [
            'inicio' => false
        ]);
    }

    public static function inmuebles(Router $router)
    {
        $inmueble = Inmueble::listarData();
        $router->render('paginas/inmuebles', [
            'inicio' => false,
            'inmueble' => $inmueble
        ]);
    }

    public static function inmueble(Router $router)
    {
        $id = validarOredireccionar('/inmuebles');

        $inmueble = Inmueble::findData($id);


        $router->render('paginas/inmueble', [
            'inmueble' => $inmueble,
            'inicio' => false
        ]);
    }

    public static function blog(Router $router)
    {
        $router->render('paginas/blog', [
            'inicio' => false
        ]);
    }

    public static function entrada(Router $router)
    {
        $router->render('paginas/entrada', [
            'inicio' => false
        ]);
    }

    public static function contacto(Router $router)
    {
        $mensaje = null;
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuesta = $_POST['contacto'];
            
            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = 'a2975bc0d5d747';
            $mail->Password = 'ee680298f22644';
            $mail->SMTPSecure = 'tls';

            // datos de envio contenido de email
            $mail->setFrom('admin@habitat.com');
            $mail->addAddress('admin@habitat.com', 'Habitat.com');
            $mail->Subject = 'Tienes un nuevo mensaje';

            // habilitar html
            $mail->isHTML(true);
            $mail->CharSet = ('UTF-8');

            // definir el contenido del email
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo Mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuesta['nombre'] . '</p>';

            // enviar de forma condicional algunos campos de email y telefono

            if ($respuesta['contacto'] === 'telefono') {
                // datos telefono
                $contenido .= '<p>Elegío ser contacto por Teléfono.</p>';
                $contenido .= '<p>Teléfono: ' . $respuesta['telefono'] . '</p>';
                $contenido .= '<p>Fecha contacto: ' . $respuesta['fecha'] . '</p>';
                $contenido .= '<p>Hola: ' . $respuesta['hora'] . '</p>';
            } else {
                // es email 
                $contenido .= '<p>Elegío ser contacto por email.</p>';
                $contenido .= '<p>Email: ' . $respuesta['email'] . '</p>';
            }
            $contenido .= '<p>Mensaje: ' . $respuesta['mensaje'] . '</p>';
            $contenido .= '<p>Vende o compra: ' . $respuesta['tipo'] . '</p>';
            $contenido .= '<p>Precio o Presupuesto: ' . $respuesta['precio'] . ' €</p>';
            // $contenido .= '<p>Prefere ser contacto por: ' . $respuesta['contacto'] . '</p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es un texto alternativo sin html. ';

            // enviar el email 
            if ($mail->send()) {
                $mensaje = "Mensaje enviada correctamente";
            } else {
                $mensaje = "Error al enviar, revice los datos";
            }
        }

        $router->render('paginas/contacto', [
            'inicio' => false,
            'mensaje' => $mensaje
        ]);
    }
    public static function noFound(Router $router)
    {
        $router->render('paginas/404', [
            'inicio' => false
        ]);
    }

}
