<main class="cotenedor seccion">
    <section class="seccion contenedor">
        <h1>Registro de Proprietário de inmueble(a)</h1>
        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error) : ?>

            <div class="alerta error">
                <?php echo $error; ?>
            </div>

        <?php endforeach; ?>
        <form action="/proprietario/crear" class="formulario" method="POST" enctype="multipart/form-data">
            <?php  include 'formulario.php';  ?>
            <input type="submit" value="Registrar Vendedor" class="boton boton-verde">
        </form>
    </section>
</main>