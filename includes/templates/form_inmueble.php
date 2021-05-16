<fieldset>
    <legend> Información General </legend>
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="inmueble[titulo]" placeholder="Titulo Inmueble" value="<?php echo Cs($inmueble->titulo); ?>">

    <label for="precio">Precio:</label>
    <input type="text" id="precio" name="inmueble[precio]" placeholder="Precio Inmueble" value="<?php echo Cs($inmueble->precio); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="imagen/jpg, imagen/png" name="inmueble[imagen]">

    <?php if ($inmueble->imagen) { ?>
        <img src="../../imagenes/<?php echo $inmueble->imagen; ?>" class="imagen-small">
    <?php } ?>

    <label for="descripcion">Descripcion:</label>
    <textarea type="text" id="descripcion" name="inmueble[descripcion]"><?php echo Cs($inmueble->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend> Información Inmueble </legend>

    <label for="habitacione">Habitaciones:</label>
    <input type="number" id="habitacione" name="inmueble[num_habitacione]" placeholder="Ej: 4" min="1" max="9" value="<?php echo Cs($inmueble->num_habitacione); ?>">

    <label for="wc">Baños:</label>
    <input type="number" id="wc" name="inmueble[wc]" placeholder="Ej: 4" min="1" max="9" value="<?php echo Cs($inmueble->wc); ?>">

    <label for="estacionamiento">Estacionamiento:</label>
    <input type="number" id="estacionamiento" name="inmueble[estacionamiento]" placeholder="Ej: 4" min="1" max="9" value="<?php echo Cs($inmueble->estacionamiento); ?>">
</fieldset>
<fieldset>
    <legend>Proprietarios</legend>


    <label for="proprietarios"></label>

    <select name="inmueble[id_proprietario]" id="id_proprietario">
        <option selected value="">-- Selecione --</option>
        <?php foreach ($proprietarios as $pro) { ?>
            <option 
            <?php echo $inmueble->id_proprietario ===  $pro->id ? 'selected' : ''; ?>
            value="<?php echo Cs($pro->id); ?>">
                <?php echo Cs($pro->nombre) . ' ' . Cs($pro->apellido) ?>
            </option>
        <?php } ?>
    </select>


</fieldset>