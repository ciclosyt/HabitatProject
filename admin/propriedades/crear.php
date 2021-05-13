<?php



include '../../includes/app.php';

use App\Inmueble;
use App\Proprietario;
use Intervention\Image\ImageManagerStatic as img;

$auth = estaAutenticado();

if (!$auth) {
    header('Location: ../');
}

$inmueble = new Inmueble;

// consultas obtener Proprietario
$proprietarios = Proprietario::listarData();

// foreach($proprietarios as $pro){
  //  ImprimirObjecto($pro->nombre);
// }

//ImprimirObjecto($proprietarios);


// validaciones de errores
$errores = Inmueble::getErrores();

//ejecuta el codigo despues de validar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //ImprimirObjecto($_SESSION);

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

        $urlImg = "../../imagenes/";
        // crear la carpeta para subir las imagens 
        if (!is_dir($urlImg)) {
            mkdir($urlImg);
        }
        /** SUBIDA DE ARCHIVOS */
        // guardar la imagen al servidor

        if ($image) {
            $image->save($urlImg . $nombreImagen);
        }

        //Guardar bd / actualizar inmueble
        $inmueble->crearData();
    }
}

//incluirTemplate('header_adm');
// plantillas
incluirTemplate('tags');
$url_recurso = '../../';
$tags = Tags::header($url_recurso, false);
?>
<!DOCTYPE html>
<html lang="es">



<main class="cotenedor seccion">
    <section class="seccion contenedor">
        <h1>Crear</h1>
        <a href="../" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error) : ?>

            <div class="alerta error">
                <?php echo $error; ?>
            </div>

        <?php endforeach; ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/form_inmueble.php'; ?>

            <input type="submit" value="Crear Inmueble" class="boton boton-verde">
        </form>
    </section>
</main>


<?php
$tags = Tags::footer($url_recurso);
//incluirTemplate('footer_adm');
?>