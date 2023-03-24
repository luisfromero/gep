<?php
$titulo='Borrado de usuarios';
require_once 'php/funciones.php';
$error=cookie1();

if(isset($_POST['submit'])){
    if($_POST['submit']=='SI')
        eliminarUsuario($_POST['id']);
    header('Location:lista.php');
    }


echo $head;

if(!cookie2()){echo $error; exit(); }//Si no puede, muestra formulario pedir contraseña y acava


echo "<center><form method=post action=''>
¿Seguro? 
<input name=id type=hidden value='{$_GET['id']}'>
<input name=submit type=submit value='SI'>
<input name=submit type=submit value='NO'>
</form></center>";


echo $foot;
