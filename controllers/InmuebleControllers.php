<?php

namespace Controllers;

use MVC\Router;
use Model\Inmueble;
use Model\Proprietario;
use Intervention\Image\ImageManagerStatic as img;

class InmuebleController
{

    public static function index(Router $router)
    {

        $inmuebles = Inmueble::listarData();
        // resultado de Registro

        // proprietarios 
        $proprietarios = Proprietario::listarData();
        $resultado = $_GET['resultado'] ?? null;

        $router->render('/inmueble/admin', [
            'inmuebles' => $inmuebles,
            'resultado' => $resultado,
            'inicio' => false,
            'proprietarios' => $proprietarios
        ]);
    }

    public static function crear(Router $router)
    {
        $inmueble = new Inmueble;
        $proprietarios = Proprietario::listarData();


        // validaciones de errores
        $errores = Inmueble::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $inmueble = new Inmueble($_POST['inmueble']);
            //ImprimirObjecto( $inmueble->proprietario_id );

            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Realizar image con intervetion 
            if ($_FILES['inmueble']['tmp_name']['imagen']) {
                $image = img::make($_FILES['inmueble']['tmp_name']['imagen'])->fit(800, 600);
                $inmueble->setImagen($nombreImagen);
            }


            //ImprimirObjecto($_FILES['inmueble']['tmp_name']['imagen']);
            $errores = $inmueble->validarDato();
            // revisar que no hay ninguno error 
            if (empty($errores)) {

                // crear la carpeta para subir las imagens 
                if (!is_dir(CARPETA_IMAGE)) {
                    mkdir(CARPETA_IMAGE);
                }
                /** SUBIDA DE ARCHIVOS */

                $image->save(CARPETA_IMAGE . $nombreImagen);
                // if ($image) { }

                //Guardar bd / actualizar inmueble
                $inmueble->crearData();
            }
        }

        $router->render('/inmueble/crear', [
            'inmueble' => $inmueble,
            'proprietarios' => $proprietarios,
            'inicio' => false,
            'errores' =>  $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarOredireccionar('/admin');

        $inmueble =  Inmueble::findData($id);

        $proprietarios = Proprietario::listarData();

        // validaciones de errores
        $errores = Inmueble::getErrores();


        // =============== MEODO POST PARA ACTUALIZANDO ================== 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $inmueble = new Inmueble($_POST);

            // asignar los atributos de actualizacion 
            $args = $_POST['inmueble'];

            $inmueble->sincronizaDato($args);

            // guardando imagenes
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            if ($_FILES['inmueble']['tmp_name']['imagen']) {
                $image = img::make($_FILES['inmueble']['tmp_name']['imagen'])->fit(800, 600);
                $inmueble->setImagen($nombreImagen);
            }

            // revisar que no hay ninguno error 
            $errores = $inmueble->validarDato();
            if (empty($errores)) {

                /** SUBIDA DE ARCHIVOS */
                // guardar la imagen al servidor
                if ($_FILES['inmueble']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGE . $nombreImagen);
                }

                // Actualizar registro
                $inmueble->guardar();
            }
        }

        $router->render('/inmueble/actualizar', [
            'inmueble' => $inmueble,
            'errores' => $errores,
            'inicio' => false,
            'proprietarios' => $proprietarios
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {

                $tipo = $_POST['tipo'];

                if (validarTipoConetenido($tipo)) {
                    $inmueble = Inmueble::findData($id);
                    $inmueble->eliminarData();
                }
            }
        }
    }
}
