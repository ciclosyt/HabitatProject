document.addEventListener('DOMContentLoaded', function() {

    eventListeners();
    darkMode();

});

function darkMode() {

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    })

}

function eventListeners() {

    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);

    // muestra compos condicionales 
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    //console.log(metodoContacto);
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodoContacto));


}

function mostrarMetodoContacto(e) {
    //console.log('Mostrando...');
    const contactoDiv = document.querySelector('#contacto');

    if (e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
        <!-- <label for="telefono">Telefono</label> -->
        <input type="tel" name="contacto[telefono]" id="telefono" placeholder="Tu Telefono" require>

        <p>Elija la fecha y hora para la llamada</p>

        <label for="fecha">Fecha</label>
        <input type="date" name="contacto[fecha]" id="fecha">

        <label for="hora">Hora:</label>
        <input type="time" name="contacto[hora]" id="hora" min="09:00" max="20:00">
        `;
    } else {
        contactoDiv.innerHTML = `
        <!-- <label for="email">Email</label> -->
        <input type="email" name="contacto[email]" id="email" placeholder="Tu Email" require>       
        `;
    }
    // console.log(e);
}

function navegacionResponsive() {

    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar');

}