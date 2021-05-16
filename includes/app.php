<?php 
require 'funciones.php';
require 'config/database.php';
require __DIR__ .'/../vendor/autoload.php';

use Model\ActiveRecord;
// conestar base de dato

$db = conectarDB();
ActiveRecord::setDB($db);
//$inmueble = new Inmueble();