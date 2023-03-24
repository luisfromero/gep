<?php
$titulo='Lista de Datos';
require_once 'php/funciones.php';
$error=cookie1();
echo $head;
if(!cookie2()){echo $error; exit(); }//Si no puede, muestra formulario

require_once 'php/connect.php';
$resultado = mysqli_query($link, isset($_GET['borrados'])?"SELECT * FROM usuarios":"SELECT * FROM usuarios WHERE borrado = '0'");

echo tablaCompleta($resultado);

echo $foot;
require_once 'php/disconnect.php';
