<?php
require 'includes/app.php';

use App\Inmueble;

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: ./');
}


$inmueble = Inmueble::findData($id);

incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $inmueble->titulo ?></h1>


    <img loading="lazy" src="imagenes/<?php echo $inmueble->imagen ?>" alt="imagen de la inmueble">

    <div class="resumen-propiedad">
        <p class="precio"><?php echo $inmueble->precio . " €"; ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $inmueble->wc ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $inmueble->estacionamiento ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $inmueble->num_habitacione ?></p>
            </li>
        </ul>

        <?php echo $inmueble->descripcion ?>
    </div>
</main>

<?php
incluirTemplate('footer');
?>