<?php

include '../../includes/app.php';

use App\Inmueble;
use App\Proprietario;
use Intervention\Image\ImageManagerStatic as img;

$auth = estaAutenticado();

if (!$auth) {
    header('Location: ../');
}

// validar cuando haya un id

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    // en caso de que no hay id, le mandamos al admin
    header('Location: ../');
}

// trear los dados del proprietario
$proprietario = Proprietario::findData($id);




//ImprimirObjecto($proprietario);
// validaciones de errores
$errores = proprietario::getErrores();

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


// plantillas
incluirTemplate('tags');
$url_recurso = '../../';
$tags = Tags::header($url_recurso, false);
?>
<!DOCTYPE html>
<html lang="es">

<main class="cotenedor seccion">
    <section class="seccion contenedor">
        <h1>Actualizar Vendor(a)</h1>
        <a href="../" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error) : ?>

            <div class="alerta error">
                <?php echo $error; ?>
            </div>

        <?php endforeach; ?>
        <form class="formulario" method="POST">
            <?php include '../../includes/templates/form_vendedor.php'; ?>

            <input type="submit" value="Guardar Cambios" class="boton boton-verde">
        </form>
    </section>
</main>


<?php
$tags = Tags::footer($url_recurso);
?>