<?php 


function conectarDB()  : mysqli{ // 
    $db = new mysqli('localhost', 'id16776425_habitatg16', 'gGIXXq$h8R^KmaoT', 'id16776425_habitat');

    if(!$db) {
        echo "Error no se pudo conectar";
       exit;
    }else{
        echo "Conectado con Suceso.";
    }
    return $db;
    
    
}

?>

<p>Hola Probando Conexion</p>

<?php 
var_dump(conectarDB());
?>