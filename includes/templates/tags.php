<?php

class Tags
{
    public static function header($url, $inicio)
    {
        if (!isset($_SESSION)) {
            session_start();
        }
// se cierra la sesion
        $auth = $_SESSION['login'] ?? false;

?>


        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Habitat</title>
            <link rel="stylesheet" href="<?php echo $url ?>build/css/app.css">
        </head>

        <body>

            <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
                <div class="contenedor contenido-header">
                    <div class="barra">
                        <a href="<?php echo $url ?>index.php">
                            <img src="<?php echo $url ?>build/img/logo.svg" alt="logotipo">
                        </a>

                        <div class="mobile-menu">

                            <img src="<?php echo $url ?>build/img/barras.svg" alt="icono menu responsive">

                        </div>
                        <div class="derecha">
                            <img src="<?php echo $url ?>build/img/dark-mode.svg" alt="" class="dark-mode-boton">
                            <nav class="navegacion mostrar">
                                <a href="<?php echo $url ?>nosotros.php">Nosotros</a>
                                <a href="<?php echo $url ?>anuncios.php">Anuncios</a>
                                <a href="<?php echo $url ?>blog.php">Blog</a>
                                <a href="<?php echo $url ?>contacto.php">Contacto</a>

                                <?php if ($auth) : ?>
                                    <a href="<?php echo $url ?>stopSession.php">Cerrar Sesion</a>

                                <?php else :  ?>
                                    <a href="<?php echo $url ?>login.php">Inicio Secion </a>
                                <?php endif; ?>
                            </nav>
                        </div>
                    </div>

                    <?php echo $inicio ? "<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>" : ''; ?>

                </div>
            </header>
        <?php   }
    public static function footer($url)
    {
        ?>
            <footer class="footer seccion">
                <div class="contenedor contenedor-footer">
                    <nav class="<?php echo $url ?> navegacion">
                        <a href="<?php echo $url ?>nosotros.php">Nosotros</a>
                        <a href="<?php echo $url ?>anuncios.php">Anuncios</a>
                        <a href="<?php echo $url ?>blog.php">Blog</a>
                        <a href="<?php echo $url ?>contacto.php">Contacto</a>
                    </nav>
                </div>

                <p class="copyright">Todos los derechos reservados <?php echo date('Y') ?> &copy;</p>
            </footer>


            <script src="<?php echo $url; ?>build/js/bundle.min.js"></script>
        </body>

        </html>
<?php
    }

    public function controlURL($url){

        // session_start();

        // $_SESSION['usuario'] = $this->email;
        // $_SESSION['login'] = true;

        // header('Location: admin');


        //$sesion = $_SESSION
        if(!session_start()){
            header('Location: /'.$url);
        }

    }
} ?>