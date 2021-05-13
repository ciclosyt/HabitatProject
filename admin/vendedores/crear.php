<?php

include '../../includes/app.php';

use App\Inmueble;
use App\Proprietario;
use Intervention\Image\ImageManagerStatic as img;

$auth = estaAutenticado();

if (!$auth) {
    header('Location: ../');
}

$proprietario = new Proprietario;

//ImprimirObjecto($proprietario);
// validaciones de errores
$errores = proprietario::getErrores();

//ejecuta el codigo despues de validar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


  // nueva instancia de proprietarios 
  $proprietario = new Proprietario($_POST['proprietario']);
 
  //ImprimirObjecto($proprietario);

  // validar que no haya campos vacio
  $errores = $proprietario->validarDato();

    // si no hay errores, guadar datos
    if(empty($errores)){
        $proprietario->guardar();

      //  ImprimirObjecto($proprietario);
    }

}


// plantillas
incluirTemplate('tags');
$url_recurso = '../../';
$tags = Tags::header($url_recurso, false);
?>
<!DOCTYPE html>
<html lang="es">



<main class="cotenedor seccion">
    <section class="seccion contenedor">
        <h1>Registro de Vendor(a)</h1>
        <a href="../" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error) : ?>

            <div class="alerta error">
                <?php echo $error; ?>
            </div>

        <?php endforeach; ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/form_vendedor.php'; ?>

            <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
        </form>
    </section>
</main>


<?php
$tags = Tags::footer($url_recurso);
//incluirTemplate('footer_adm');
?>