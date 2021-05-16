<main class="cotenedor seccion">
    <section class="seccion contenedor">
        <h1>Administrador de Habitat</h1>
        <?php

        if ($resultado) {
            $mensaje = notificacionAccion(intval($resultado));
            if ($mensaje) { ?>
                <p class="alerta exito"> <?php echo Cs($mensaje); ?> </p>
        <?php  }
        } ?>

        <a href="/inmueble/crear" class="boton boton-verde">Nuevo Inmueble</a>
        <a href="/proprietario/crear" class="boton boton-amarillo">Nuevo(a) Proprietário (a)</a>

        <h2>Inmuebles disponibles</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                <!-- Mostrar los Resultados -->
                <?php foreach ($inmuebles as $inmueble) : ?>
                    <tr>
                        <td><?php echo $inmueble->id; ?></td>
                        <td><?php echo $inmueble->titulo; ?></td>
                        <td> <img src="../imagenes/<?php echo $inmueble->imagen; ?>  " class="imagen-tabla"> </td>
                        <td> <?php echo $inmueble->precio . " €"; ?></td>
                        <td>
                            <form method="POST" class="w-100" action="/inmueble/eliminnar">

                                <input type="hidden" name="id" value="<?php echo $inmueble->id; ?>">
                                <input type="hidden" name="tipo" value="inmueble">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>

                            <a href="/inmueble/actualizar?id=<?php echo $inmueble->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


        <h2> Listado de los Proprietários(as)</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                <!-- Mostrar los Resultados -->
                <?php foreach ($proprietarios as $proprietario) : ?>
                    <tr>
                        <td><?php echo $proprietario->id; ?></td>
                        <td><?php echo $proprietario->nombre . " " . $proprietario->apellido; ?></td>
                        <td><?php echo $proprietario->telefono; ?></td>
                        <td><?php echo $proprietario->email; ?></td>
                        <td>
                            <form method="POST" class="w-100" action="/proprietario/eliminar">

                                <input type="hidden" name="id" value="<?php echo $proprietario->id; ?>">
                                <input type="hidden" name="tipo" value="proprietario">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>

                            <a href="/proprietario/actualizar?id=<?php echo $proprietario->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

</main>