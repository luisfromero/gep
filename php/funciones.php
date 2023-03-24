<?php
include_once "protected.php";
include_once("variables.php");

/************************************************************************************
 *                           Seguridad de acceso
 ************************************************************************************/

/**
 * Si se ha ingresado palabra clave, guarda la cookie
 */
 function cookie1()
{
session_start();
if (isset($_POST['password'])) {
  // Obtener la contraseña enviada
  $password = $_POST['password'];

  // Comprobar si la contraseña es correcta
  if ($password == SECRET) {
    // Establecer la cookie
	//echo time()+60*60*24*365;
    setcookie('acceso', SECRET, time()+5*60*60*24*365,'/');
	$_COOKIE['acceso']=SECRET;
	//Esto solo hace falta la primera vez segun
	//https://stackoverflow.com/questions/24662580/php-setcookie-not-working
	return "";
  } else {
    // Si la contraseña es incorrecta, mostrar mensaje de error
    return "La contraseña es incorrecta.";
  }
}
}

/**
 * Si no tiene la cookie, muestra solicitude de contraseña
 */
function cookie2()
{
// Comprobar si la cookie existe
		//echo "Cookie es ".$_COOKIE['acceso'];
if (isset($_COOKIE['acceso']) && $_COOKIE['acceso'] == SECRET)
{
	return 1;
}
else
{
	echo "
    <h1>Introduzca la contraseña</h1>
    <form method='post' action=''>
      <input type='password' name='password'>
      <input type='submit' value='Entrar'>
    </form>	";
	return 0;
}
	
}

function getIP()
{
global $ip;
if (!empty(filter_input(INPUT_SERVER, 'HTTP_CLIENT_IP'))){
  $ip=filter_input(INPUT_SERVER, 'HTTP_CLIENT_IP');
//Is it a proxy address
}elseif (!empty(filter_input(INPUT_SERVER, 'HTTP_X_FORWARDED_FOR'))){
  $ip=filter_input(INPUT_SERVER, 'HTTP_X_FORWARDED_FOR');
}else{
  $ip=filter_input(INPUT_SERVER, 'REMOTE_ADDR');
}

}


/************************************************************************************
 *                           Accesos a la base de datos
 ************************************************************************************/


function insertarEditarUsuario($update=False)
{
// Conexión a la base de datos
require 'php/connect.php';
// Recibir los datos del usuario por POST
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$dni = $_POST['dni'];
$direccion = $_POST['direccion'];
$cp = $_POST['cp'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
if($update){
	$id = $_POST['id'];
	$borrado = isset($_POST['borrado'])?1:0;
}

// Insertar los datos del usuario en la tabla 'usuarios'
$sql = "INSERT INTO usuarios (nombre, apellidos, dni, direccion, cp, email,telefono) VALUES ('$nombre', '$apellidos','$dni', '$direccion','$cp','$email','$telefono')";
if($update)
$sql = "UPDATE usuarios SET 
nombre = '$nombre' , apellidos = '$apellidos' , dni =  '$dni' , direccion = '$direccion' , 
cp = '$cp' , email = '$email' , telefono = '$telefono' , borrado = '$borrado' WHERE id = '$id'";
//echo $sql;

mysqli_query($link, $sql);
header('location:lista.php');
}

/**
 * Obtiene los datos de un usuario para su edición
 */
function obtenerDatosUsuario($id)
{
	include 'php/connect.php';
	$sql="SELECT * FROM usuarios WHERE id = '$id';";
	//print_r($link);
	$result = mysqli_query($link,$sql);
	if(!$result)return null;
    $datos=mysqli_fetch_assoc($result);
    return $datos;
}

/**
 * Obtiene los datos de un usuario para su edición
 */
function eliminarUsuario($id)
{
	include 'php/connect.php';
	$sql="UPDATE usuarios SET borrado = '1' WHERE id = '$id';";
	mysqli_query($link,$sql);
}



/**
 * Obtiene los datos de varios usuarios por nombre o apellido
 */
function obtenerVariosDatos()
{
	require 'php/connect.php';
  // Obtiene el término de búsqueda y lo limpia para evitar inyección de SQL
  $busqueda = mysqli_real_escape_string($link, $_POST['busqueda']);
  // Realiza la consulta a la base de datos
  $sql = "SELECT * FROM usuarios WHERE nombre LIKE '%$busqueda%' OR apellidos LIKE '%$busqueda%'";
  $resultado = mysqli_query($link, $sql);
  // Muestra los resultados de la búsqueda
  echo "<div style=margin:auto;width:50%;padding:10px;>
  ";
  while($fila = mysqli_fetch_assoc($resultado)) {
    echo "Id: " . $fila['id'] . "<br>";
    echo "Nombre: " . $fila['nombre'] . "<br>";
    echo "Apellidos: " . $fila['apellidos'] . "<br>";
    echo "Email: " . $fila['email'] . "<br><br>";
  }
  echo "</div>";
}


/************************************************************************************
 *                           Funciones de textos
 ************************************************************************************/



/**
 * Formulario válido para editar o insertar
 */

function formulario($datos=null,$update=False)
{

	$d0=$datos==null?"":$datos['id'];
	$d1=$datos==null?"":$datos['nombre'];
	$d2=$datos==null?"":$datos['apellidos'];
	$d3=$datos==null?"":$datos['dni'];
	$d4=$datos==null?"":$datos['direccion'];
	$d5=$datos==null?"":$datos['cp'];
	$d6=$datos==null?"":$datos['email'];
	$d7=$datos==null?"":$datos['telefono'];
	$d8=$datos==null?"":($datos['borrado']==1?"checked":"");


	$target=$update?"editar.php":"index.php";
	$idrow=$update?"<tr><td>Id</td><td><input name='id' value='$d0' readonly></td></tr>":"";
	$delrow=$update?"<tr><td>Borrado?</td><td><input name=borrado  type=checkbox $d8></td></tr>":"";
	$valor=$update?"actualizar":"insertar";


	$formulario="
	<div style=text-align:center;>
	<form action='$target' method='post'>
			<table class=centrada>
			$idrow
			<tr><td>
			<label for='nombre'>Nombre:</label>
			</td><td>
			<input type='text' id='nombre' name='nombre' value='$d1' ><br>
			</td></tr><tr><td>
			
			<label for='apellidos'>Apellidos:</label>
			</td><td>
			<input type='text' id='apellidos' name='apellidos' value='$d2'><br>
			</td></tr><tr><td>
	
			<label for='dni'>DNI/NIE:</label>
			</td><td>
			<input type='text' id='dni' name='dni'  value='$d3'><br>
			</td></tr><tr><td>
	
			<label for='direccion'>Dirección:</label>
			</td><td>
			<input type='text' id='direccion' name='direccion'  value='$d4'><br>
			</td></tr><tr><td>
	
			<label for='cp'>Código postal:</label>
			</td><td>
			<input type='text' id='cp' name='cp'  value='$d5'><br>
			</td></tr>
			
			<tr><td>
			<label for='email'>Email:</label>
			</td><td>
			<input type='email' id='email' name='email'  value='$d6'><br>
			</td></tr>
			
			<tr><td>
			<label for='telefono'>Teléfono:</label>
			</td><td>
			<input type='phone' id='telefono' name='telefono' value='$d7'><br>
			</td></tr>
	
			$delrow

			<tr><td colspan=2>
			<input type='submit' id='submit' name='submit' value='$valor'><br>
			</td></tr>
			
			</table>
	</form>
	</div>		
	";
return $formulario;	
}


function tablaCompleta($resultado)
{
$filas="";
$inicio= "
<table  class='borde'><tr>
	<th>Id</th>
	<th>Nombre</th>
	<th>Apellidos</th>
	<th>DNI</th>
	<th>Dirección</th>
	<th>CP</th>
	<th>Email</th>
	<th>Teléfono</th><th colspan=2></th>
	</tr>
";
while ($fila = mysqli_fetch_assoc($resultado)) {
    $filas .= 
	"<td>". $fila['id'] . "</td>"
    ."<td title='" . $fila['nombre'] . "'>" . substr($fila['nombre'], 0, 20) . "</td>"
    ."<td title='" . $fila['apellidos'] . "'>" . substr($fila['apellidos'], 0, 20) . "</td>"
    ."<td title='" . $fila['dni'] . "'>" . substr($fila['dni'], 0, 20) . "</td>"
    ."<td title='" . $fila['direccion'] . "'>" . substr($fila['direccion'], 0, 20) . "</td>"
    ."<td title='" . $fila['cp'] . "'>" . substr($fila['cp'], 0, 20) . "</td>"
    ."<td title='" . $fila['email'] . "'>" . substr($fila['email'], 0, 20) . "</td>"
    ."<td title='" . $fila['telefono'] . "'>" . substr($fila['telefono'], 0, 20) . "</td>"
	."<td><a href=editar.php?id={$fila['id']}>Editar</a></td>"
	."<td><a href=borrar.php?id={$fila['id']}>Eliminar</a></td>"
    ."</tr>";
}
return $inicio."\n".$filas."\n</table>";
}

/**
 * Menú a pié de página
 */
function menu(){
return
"
<div style=margin:auto;width:50%;padding:10px;>
<ul>
<li><a href='buscar.php'>Buscar usuario por nombre y apellido</a>
<li><a href='index.php'>Insertar usuario</a>
<li><a href='lista.php' title='Pulsa en la letra x para ver también datos eliminados'>Listar todos los usuarios</a>
<a href='lista.php?borrados'>x</a>
</ul>
</div>
";
}