<?php
require 'includes/app.php';

use PHPMailer\PHPMailer\PHPMailer;

incluirTemplate('tags');
$tags = Tags::header('', false);
$mensaje = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    $respuesta = $_POST['contacto'];
  // ImprimirObjecto($respuesta);

    // configuracion del servidor de email
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = 'a2975bc0d5d747';
    $mail->Password = 'ee680298f22644';
    $mail->SMTPSecure = 'tls';

    // datos de envio contenido de email
    $mail->setFrom('admin@habitat.com');
    $mail->addAddress('admin@habitat.com', 'Habitat.com');
    $mail->Subject = 'Tienes un nuevo mensaje';

    // habilitar html
    $mail->isHTML(true);
    $mail->CharSet = ('UTF-8');

    // definir el contenido del email
    $contenido = '<html>';
    $contenido .= '<p>Tienes un nuevo Mensaje</p>';
    $contenido .= '<p>Nombre: ' . $respuesta['nombre'] . '</p>';
    
    // enviar de forma condicional algunos campos de email y telefono

    if($respuesta['contacto']==='telefono'){
        // datos telefono
        $contenido .= '<p>Elegío ser contacto por Teléfono.</p>';
        $contenido .= '<p>Teléfono: ' . $respuesta['telefono'] . '</p>';
        $contenido .= '<p>Fecha contacto: ' . $respuesta['fecha'] . '</p>';
        $contenido .= '<p>Hola: ' . $respuesta['hora'] . '</p>';
    }else{
        // es email 
        $contenido .= '<p>Elegío ser contacto por email.</p>';
        $contenido .= '<p>Email: ' . $respuesta['email'] . '</p>';
    } 
    $contenido .= '<p>Mensaje: ' . $respuesta['mensaje'] . '</p>';
    $contenido .= '<p>Vende o compra: ' . $respuesta['tipo'] . '</p>';
    $contenido .= '<p>Precio o Presupuesto: ' . $respuesta['precio'] . ' €</p>';
   // $contenido .= '<p>Prefere ser contacto por: ' . $respuesta['contacto'] . '</p>';
    $contenido .= '</html>';

    $mail->Body = $contenido;
    $mail->AltBody = 'Esto es un texto alternativo sin html. ';

    // enviar el email 
       if( $mail->send()){
           $mensaje = "Mensaje enviada correctamente";
       }else{
        $mensaje = "Error al enviar, revice los datos";
       }


}

?>

<main class="contenedor seccion">
    <section class="seccion contenedor">
        <h1>Contacto</h1>

        <!-- Eviamos el mesaje, exito o error -->
        <?php if($mensaje){ ?>
            <p class="alerta exito"> <?php echo $mensaje ?>.</p>
            <?php  } ?> 
            
        

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen contacto">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form class="formulario" action="contacto.php" method="POST">
            <fieldset>
                <legend>Informacion personal</legend>

                <label for="nombre">Nombre</label>
                <input type="text" name="contacto[nombre]" id="nombre" placeholder="Tu Nombre" require>

                 <!-- <label for="telefono">Telefono</label>
                <input type="tel" name="contacto[telefono]" id="telefono" placeholder="Tu Telefono"> -->

                <label for="mensaje" require>Mensaje:</label>
                <textarea name="contacto[mensaje]" id="mensaje" cols="30" rows="10"></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion sobre la Propiedad</legend>

                <label for="opciones">vende o comprar:</label>
                <select name="contacto[tipo]" id="opciones">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto</label>
                <input type="number" name="contacto[precio]" id="presupuesto" placeholder="Tu Precio" require>
            </fieldset>

            <fieldset>
                <legend>Informacion sobre la Propiedad</legend>

                <p>Como desea ser contactado</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Telefono</label>
                    <input type="radio" name="contacto[contacto]" value="telefono" id="contactar-telefono">

                    <label for="contactar-email">Email</label>
                    <input type="radio" name="contacto[contacto]" value="email" id="contactar-email" require>
                </div>

                <div id="contacto"></div>


            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
    </section>
</main>


<?php
$tags = Tags::footer('');
?>