<?php 

function conectarDB()  : mysqli{ // 
    $db = new mysqli('localhost', 'root', '', 'habitat');

    if(!$db) {
        echo "Error no se pudo conectar";
       exit;
    }
    return $db;
    
    
}