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

        <form class="formulario"  method="POST" action="/contacto">
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