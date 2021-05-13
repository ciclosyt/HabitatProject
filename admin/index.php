<?php

require '../includes/app.php';

$auth = estaAutenticado();

use App\Inmueble;
use App\Proprietario;

$inmuebles =  Inmueble::listarData();
$Proprietarios = Proprietario::listarData();

//ImprimirObjecto($inmuebles);
//ImprimirObjecto($Proprietarios);

// secion 
if (!$auth) {
    header('Location: ../');
}

// $db = conectarDB();

// Escribir el Query
// $query = "SELECT * FROM inmueble";

// // Consultar la BD 
// $resultadoConsulta = mysqli_query($db, $query);

// resultado de Registro
$resultado = $_GET['resultado'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //ImprimirObjecto($_POST);
    // ImprimirObjecto($_POST);

    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {

        $tipo = $_POST['tipo'];

        if (validarTIpoConetenido($tipo)) {
            if ($tipo === 'proprietario') {
                $proprietario = Proprietario::findData($id);
                $proprietario->eliminarData();
            } else if ($tipo === 'inmueble') {
                $inmueble = Inmueble::findData($id);

                $inmueble->eliminarData();
            }
        }
    }
}

// plantillas
incluirTemplate('tags');
$url_recurso = '../';

$tags = Tags::header($url_recurso, false);
?>

<main class="cotenedor seccion">
    <section class="seccion contenedor">
        <h1>Administrador de Habitat</h1>
        <?php
        $mensaje = notificacionAccion(intval($resultado));
        if ($mensaje) { ?>
            <p class="alerta exito"> <?php echo Cs($mensaje); ?> </p>
        <?php  } ?>

        <a href="propriedades/crear.php" class="boton boton-verde">Nueva Propriedade</a>
        <a href="vendedores/crear.php" class="boton boton-amarillo">Nuevo(a) Vendedor</a>

        <h2>Inmuebles</h2>
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
                            <form method="POST" class="w-100">

                                <input type="hidden" name="id" value="<?php echo $inmueble->id; ?>">
                                <input type="hidden" name="tipo" value="inmueble">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>

                            <a href="propriedades/actualizar.php?id=<?php echo $inmueble->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Proprietários</h2>
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
                <?php foreach ($Proprietarios as $proprietario) : ?>
                    <tr>
                        <td><?php echo $proprietario->id; ?></td>
                        <td><?php echo $proprietario->nombre . " " . $proprietario->apellido; ?></td>
                        <td><?php echo $proprietario->telefono; ?></td>
                        <td><?php echo $proprietario->email; ?></td>
                        <td>
                            <form method="POST" class="w-100">

                                <input type="hidden" name="id" value="<?php echo $proprietario->id; ?>">
                                <input type="hidden" name="tipo" value="proprietario">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>

                            <a href="vendedores/actualizar.php?id=<?php echo $proprietario->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>

<?php
$tags = Tags::footer($url_recurso);
?>