<fieldset>
    <legend>Informacion General</legend>

    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="proprietario[nombre]" placeholder="Nombre Vendedor(a)"
    value="<?php echo Cs($proprietario->nombre);?>">

    <label for="apellido">Apellido</label>
    <input type="text" id="apellido" name="proprietario[apellido]" placeholder="Apellido Vendedor(a)"
    value="<?php echo Cs($proprietario->apellido);?>">
</fieldset>

<fieldset>
    <legend>Informacion Contacto</legend>
    <label for="telefono">Telefono</label>
    <input type="number" id="telefono" name="proprietario[telefono]" placeholder="Telefono"
    value="<?php echo Cs($proprietario->telefono);?>">

    <label for="email">Email</label>
    <input type="text" id="email" name="proprietario[email]" placeholder="Correo Electronicos"
    value="<?php echo Cs($proprietario->email);?>">

    <?php 
    // btn_atualizarV
    if($proprietario->id == null){ ?>  <!-- signidca que estamos actualizando entonces el password no puede aparecer -->
    <label for="pwd">Password</label>
    <input type="password" id="pwd" name="proprietario[password]" placeholder="Correo Electronicos"
    value="<?php echo Cs($proprietario->password);?>">
    <?php  } ?>
</fieldset>