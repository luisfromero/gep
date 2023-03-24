<?php
$titulo='Formulario de Recogida de Datos';
require_once 'php/funciones.php';
$error=cookie1();

if(isset($_POST['submit']))insertarEditarUsuario();

echo $head;

if(!cookie2()){echo $error; exit(); }//Si no puede, muestra formulario

echo formulario();

echo $foot;
require_once 'php/disconnect.php';
