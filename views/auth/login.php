<main class="contenedor seccion contenido-centrado">
    <section class="seccion contenedor">
        <h1>Iniciar Sesión Admin</h1>

        <?php foreach ($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario" novalidate action="/login">
            <fieldset>
                <legend>Email y Password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Email" id="email">

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu Password" id="password">
            </fieldset>

            <a href="/pwd" style="text-align:center">Recuperar la Contraseña</a>
            <br>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </section>
</main>
