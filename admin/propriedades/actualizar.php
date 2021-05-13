<?php
include '../../includes/app.php';
use App\Inmueble;
use App\Proprietario;
use Intervention\Image\ImageManagerStatic as img;

// plantillas
incluirTemplate('tags');
$url_recurso = '../../';

$tags = Tags::header($url_recurso, false);

$auth = estaAutenticado();

if (!$auth) {
    header('Location: ../');
}

// Validar la URL por ID válido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: ../');
}

$db = conectarDB();

// Obtener los datos del inmueble
$inmueble = Inmueble::findData($id);

// Consulta a la BD obtener los Proprietarios
$proprietarios = Proprietario::listarData();


// mensajes de errores 
$errores = $inmueble::getErrores();

//ejecuta el codigo despues de validar
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
        if($_FILES['inmueble']['tmp_name']['imagen']){
        $image->save(CARPETA_IMAGE . $nombreImagen);
        }
        
        // Actualizar registro
        $inmueble->guardar();
    }
}


?>

<main class="cotenedor seccion">
    <section class="seccion contenedor">
        <h1>Actualizar Inmueble</h1>
        <a href="../" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error) : ?>

            <div class="alerta error">
                <?php echo $error; ?>
            </div>

        <?php endforeach; ?>
        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/form_inmueble.php'; ?>
            <input type="submit" value="Actualizar Inmueble" class="boton boton-verde">

        </form>
    </section>
</main>


<?php
$tags = Tags::footer($url_recurso);
?>