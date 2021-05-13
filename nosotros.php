<?php
require 'includes/app.php';
incluirTemplate('tags');
$tags = Tags::header('', false);
?>
    <main class="cotenedor seccion">
    <section class="seccion contenedor">
        <h1>Conoce sobre Nosotros</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 años de experiencia
                </blockquote>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere cum nesciunt voluptates ipsa exercitationem magni distinctio praesentium incidunt qui dolore necessitatibus atque optio, veritatis obcaecati aut deserunt suscipit molestiae quas.
                </p>

                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Architecto nesciunt voluptatum sapiente, numquam aperiam similique, repudiandae in necessitatibus doloremque consequatur vel accusantium libero. Distinctio autem quo dolorem aliquid vero cupiditate.
                </p>
            </div>
        </div>
        </section>
    </main>

    <section class="cotenedor contenedor">
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
    </section>

   
<?php
$tags = Tags::footer('');
//incluirTemplate('footer');
?>