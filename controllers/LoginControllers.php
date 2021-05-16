<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;


class LoginController
{

    public static function login(Router $router)
    {
        $errores = [];
        $auth = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST);
            $errores = $auth->validarDato();

            if (empty($errores)) {
                // verificar si el usuario exite
                $resultado = $auth->exiteUsuario();

                if (!$resultado) {
                    // verifica si el usuario exite o no
                    $errores = Admin::getErrores();
                } else {

                    // verificar el password
                    $autenticado = $auth->comprobarPassword($resultado);
                    // autenticar el usuario

                    if ($autenticado) {
                        // autenticamos el usuario
                        $auth->autenticaUsuario();
                    } else {
                        // password incorrecto, Mensaje de error
                        $errores = Admin::getErrores();
                    }
                }
            }
        }
        //  'auth' => $auth,
        $router->render('auth/login', [
            'errores' => $errores,

            'inicio' => false

        ]);
    }

    public static function logout(Router $router)
    {

        if (session_id() == '') {
            session_start();
        }

        $_SESSION = [];

        header('Location: ../');
    }

    public static function pwd(Router $router)
    {

        // validarPwd()

        $errores = [];
        $newPwd = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $newPwd = new Admin($_POST);

            $errores = $newPwd->validarPwd();

            if (empty($errores)) {
                // verificar si el usuario exite  

                $resultado = $newPwd->findUser($newPwd->email);
                if (!$resultado) {
                    // verifica si el usuario exite o no
                    $errores = Admin::getErrores();
                } else {
                    // converir a hash
                    $nuevaPWD = password_hash($newPwd->pwd2, PASSWORD_DEFAULT); // length = 60 caracter
                    // actualizamos el password
                    $result = $newPwd->updatePWD($newPwd->email, $nuevaPWD);
                    if ($result) {
                        header('Location: ./login');
                    }
                }
            }
        }

        $router->render('auth/pwd', [
            // 'errores' => $errores,
            'errores' => $errores,
            'inicio' => false
        ]);
    }
}
