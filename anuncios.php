<?php
require 'includes/app.php';
incluirTemplate('header');
?>
<main class="cotenedor seccion">
    <section class="seccion contenedor">
        <h2>Casas y depas en venta</h2>

        <?php
        include 'includes/templates/anuncios.php';
        ?>
    </section>
</main>


<?php
