<?php


use App\Inmueble;


if ($_SERVER['SCRIPT_NAME'] === '/anuncios.php') {
    $inmueble = Inmueble::listarData();
} else {
    $inmueble = Inmueble::getData(3);
}


?>

<div class="contenedor-anuncios">
    <?php foreach ($inmueble as $propiedad) { ?>
        <div class="anuncio">

            <img loading="lazy" src="imagenes/<?php echo $propiedad->imagen; ?>" alt="anuncio">

            <div class="contenido-anuncio">
                <h3><?php echo $propiedad->titulo ?></h3>
                <p><?php echo $propiedad->descripcion ?></p>
                <p class="precio"><?php echo $propiedad->precio . " €" ?></p>

                <ul class="iconos-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                        <p><?php echo $propiedad->wc ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                        <p><?php echo $propiedad->estacionamiento ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                        <p><?php echo $propiedad->num_habitacione ?></p>
                    </li>
                </ul>

                <a href="anuncio.php?id=<?php echo $propiedad->id ?>" class="boton-amarillo-block">
                    Ver Propiedad
                </a>
            </div>
            <!--.contenido-anuncio-->
        </div>
        <!--anuncio-->
    <?php } ?>
</div>
<!--.contenedor-anuncios-->

<?php

// Cerrar la conexión
mysqli_close($db);
?>