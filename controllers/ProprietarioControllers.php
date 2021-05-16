<?php

namespace Controllers;

use MVC\Router;
use Model\Proprietario;


class ProprietarioController
{
    public static function crear(Router $router)
    {

        $proprietario = new Proprietario;
        $errores = Proprietario::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {


            // nueva instancia de proprietarios 
            $proprietario = new Proprietario($_POST['proprietario']);

            // validar que no haya campos vacio
            $errores = $proprietario->validarDato();

            //consultar si ya esite un registro con este email 
            $result = $proprietario->findUser($proprietario->email);

            if (!$result) { // no hay usuario con este correo
                if (empty($errores)) {
                    // convertimos el password en hash y finalmente guardamos los datos
                    $hasPass = password_hash($proprietario->password, PASSWORD_DEFAULT); // length = 60 caracter
                    $proprietario->password = $hasPass;
                    $proprietario->guardar();
                }

            }else{
                $errores [] = "Ya existe un un usuario registrado con este correo.";
            }

            // si no hay errores, guadar datos

        }

        $router->render('/proprietario/crear', [
            'errores' => $errores,
            'inicio' => false,
            'proprietario' => $proprietario
        ]);
    }

    public static function actualizar(Router $router)
    {
        $errores = Proprietario::getErrores();
        $id = validarOredireccionar('/admin');

        // obtener datos del proprietário pra actualizar
        $proprietario = Proprietario::findData($id);

        //ejecuta el codigo despues de validar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $args = $_POST['proprietario'];

            // sincroniza los datos en la memoria
            $proprietario->sincronizaDato($args);
            //  ImprimirObjecto($proprietario);
            // validacion 
            $errores = $proprietario->validarDato();

            if (empty($errores)) {
                $proprietario->guardar();
            }
        }

        $router->render('/proprietario/actualizar', [
            'errores' => $errores,
            'inicio' => false,
            'proprietario' => $proprietario
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
                    $proprietario = Proprietario::findData($id);
                    $proprietario->eliminarData();
                }
            }
        }
    }
}
