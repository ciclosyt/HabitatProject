<main class="cotenedor seccion">
    <h1>Mas sobre nosotros</h1>

    <?php include 'iconos.php';?>
</main>

<section class="seccion contenedor">

    <h2>Casas y depas en venta</h2>
    <?php
    
    include 'listado.php';
    ?>

    <div class="alinear-derecha">
        <a href="/inmuebles" class="boton-verde">Ver todas</a>
    </div>
</section>


<section class="imagen-contacto">
    <h2>Ecuentra la casa de tus sueños</h2>
    <p>Lena el formulario de contacto y un asesor se pondrá en contacto contigo</p>
    <a href="/contacto" class="boton-amarillo">Contactános</a>
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
                <p class="informacion-meta">Escrito el: <span>19/04/2021</span> por: <span>Habitat</span></p>

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
                <p class="informacion-meta">Escrito el: <span>20/04/2021</span> por: <span>Habitat</span></p>

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