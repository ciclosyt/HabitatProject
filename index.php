<?php


require 'includes/app.php';

incluirTemplate('tags');
$tags = Tags::header('', $inicio = true);

?>
<main class="cotenedor seccion">
    <h1>Mas sobre nosotros</h1>

    <div class="iconos-nosotros">
        <div class="icono">
            <img src="build/img/icono1.svg" alt="icono seguridad" loading="lazy" srcset="">
            <h3>Seguridad</h3>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cum nisi, quam reiciendis nam amet excepturi nulla id aut nobis at temporibus repellendus nesciunt, laboriosam eius maiores delectus incidunt maxime deserunt!</p>
        </div>
        <div class="icono">
            <img src="build/img/icono2.svg" alt="icono precio" loading="lazy" srcset="">
            <h3>Precio</h3>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cum nisi, quam reiciendis nam amet excepturi nulla id aut nobis at temporibus repellendus nesciunt, laboriosam eius maiores delectus incidunt maxime deserunt!</p>
        </div>
        <div class="icono">
            <img src="build/img/icono3.svg" alt="icono tiempo" loading="lazy" srcset="">
            <h3>Tiempo</h3>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cum nisi, quam reiciendis nam amet excepturi nulla id aut nobis at temporibus repellendus nesciunt, laboriosam eius maiores delectus incidunt maxime deserunt!</p>
        </div>
    </div>
</main>


<section class="seccion contenedor">

    <h2>Casas y depas en venta</h2>
    <?php
    $limite = 3;
    include 'includes/templates/anuncios.php';
    ?>

    <div class="alinear-derecha">
        <a href="anuncios.php" class="boton-verde">Ver todas</a>
    </div>
</section>


<section class="imagen-contacto">
    <h2>Ecuentra la casa de tus sueños</h2>
    <p>Lena el formulario de contacto y un asesor se pondrá en contacto contigo</p>
    <a href="contacto.php" class="boton-amarillo">Contactános</a>
</section>


<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Nuestro blog</h3>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img loading="lazy" src="/build/img/blog1.jpg" alt="texto entrada blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php"></a>
                <h4>Terraza en el techo de tu casa</h4>
                <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Habitat</span></p>

                <p>
                    Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero
                </p>
            </div>

        </article>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog1.jpg" alt="texto entrada blog">
                </picture>
            </div>
            <div class="texto-entrada">
                <a href="entrada.php"></a>
                <h4>Guia para la decoracion de tu hogar</h4>
                <p class="informacion-meta">Escrito el: <span>20/10/2021</span> por: <span>Habitat</span></p>

                <p>
                    Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio
                </p>
            </div>

        </article>
    </section>

    <section class="testimoniales">
        <h3>Testimoniales</h3>

        <div class="testimonial">
            <blockquote>
                El personal se comportó de una excelente forma, muy buena atencion y la casa que me ofrecieron cumple todas mis expectativas.
            </blockquote>
            <p>- Jose C Parrilla</p>
        </div>
    </section>

</div>


<?php
$tags = Tags::footer('');
?>