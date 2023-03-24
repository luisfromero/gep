<?php
$titulo='Edición de usuarios';
require_once 'php/funciones.php';
$error=cookie1();

if(isset($_POST['submit']))insertarEditarUsuario(True);

echo $head;

if(!cookie2()){echo $error; exit(); }//Si no puede, muestra formulario pedir contraseña y acava
$id=(int)( isset($_GET['id'])?$_GET['id']:(isset($_POST['id'])?$_POST['id']:-1));

if($id>=0)echo formulario(obtenerDatosUsuario($id),True);

echo $foot;
require_once 'php/disconnect.php';
