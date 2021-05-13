<?php


require 'includes/app.php';
require 'classes/Admin.php';


$db = conectarDB();
// Autenticar el usuario

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   // $pass = password_hash("hola123", PASSWORD_DEFAULT); // Azevedo
    // $pass = password_hash("hola", PASSWORD_DEFAULT); // jose
    // ImprimirObjecto($pass);

    

    $auth = new Admin($_POST);
    $errores = $auth->validar();

    if(empty($errores)){
        // verificar si el usuario exite
       $resultado = $auth->exiteUsuario();

       if(!$resultado){
           // verifica si el usuario exite o no
            $errores = Admin::getErrores();
       }else{

        // verificar el password
        $autenticado = $auth->comprobarPassword($resultado);
        // autenticar el usuario

        if($autenticado){
            // autenticamos el usuario
            $auth->autenticasUsuario();
        }else{
            // password incorrecto, Mensaje de error
            $errores = Admin::getErrores();
        }

       }
    }

}



incluirTemplate('tags');
$tags = Tags::header('', false);
//incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <section class="seccion contenedor">
        <h1>Iniciar Sesión</h1>

        <?php foreach ($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario" novalidate action="login.php">
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Email" id="email">

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu Password" id="password">
            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </section>
</main>

<?php
$tags = Tags::footer('');
?>