<?php
$titulo='Búsqueda de usuarios';
require_once 'php/funciones.php';
$error=cookie1();



echo $head;

if(!cookie2()){echo $error; exit(); }//Si no puede, muestra formulario pedir contraseña y acava

if(isset($_POST['buscar'])) obtenerVariosDatos();
else echo $formBuscar;

echo $foot;
require_once 'php/disconnect.php';
