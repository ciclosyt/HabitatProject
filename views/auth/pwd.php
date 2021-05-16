<main class="contenedor seccion contenido-centrado">
    <section class="seccion contenedor">
        <h1>Recuperacion de la Contraseña</h1>

        <?php foreach ($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario" novalidate action="/pwd">
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Email" id="email">

                <label for="password">Digite la nueva contraseña</label>
                <input type="password" name="pwd1" placeholder="Tu Password" id="password">

                <label for="password">Vuelve a poner la nueva contraseña</label>
                <input type="password" name="pwd2" placeholder="Tu Password" id="password">
            </fieldset>

            <input type="submit" value="Enviar" class="boton boton-verde">
        </form>
    </section>
</main>
