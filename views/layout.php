<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habitat</title>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/bf7e05c402.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../build/css/app.css">
</head>

<body>

    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="../build/img/logo.svg" alt="logotipo">
                </a>

                <div class="mobile-menu">

                    <img src="../build/img/barras.svg" alt="icono menu responsive">

                </div>
                <div class="derecha">
                    <img src="../build/img/dark-mode.svg" alt="" class="dark-mode-boton">
                    <nav class="navegacion mostrar">
                     <a href="/nosotros"><i class="fas fa-users"></i> Nosotros</a>
                        <a href="/inmuebles"><i class="fas fa-newspaper"></i> Anuncios</a>
                        <a href="/blog"> <i class="fas fa-blog"></i> Blog</a>
                        <a href="/contacto"> <i class="fas fa-id-card"></i> Contacto</a>

                        <?php if ($_SESSION) { ?>
                            <a href="/admin"><i class="fas fa-users-cog"></i> Admin</a>
                            <a href="/logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesion</a>
                        <?php } else { ?>
                            <a href="/login"><i class="fas fa-sign-in-alt"></i> Inicio Secion </a>
                        <?php } ?>
                    </nav>
                </div>
            </div>

            <?php echo $inicio ? "<h1>Reserva, Alquiler y Venta de Casas, Departamentos Exclusivos de Lujo</h1>" : ''; ?>

        </div>
    </header>

    <?php echo $contenido ?>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/nosotros">Nosotros</a>
                <a href="/inmuebles">Anuncios</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
            </nav>
        </div>

        <p class="copyright">Todos los derechos reservados <?php echo date('Y') ?> &copy;</p>
    </footer>


    <script src="../build/js/bundle.min.js"></script>
</body>

</html>