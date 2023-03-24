<?php
$verbose=True;
$serverroot=$root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
if($verbose){
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}

$urlgep="https://proteccioncivil.malaga.eu/";
$urlayto="https://www.malaga.eu/";
if(!isset($title))$title="Sitio Genérico";
$iconos=
"
<link rel='apple-touch-icon' sizes='57x57' href='/icon/apple-icon-57x57.png'>
<link rel='apple-touch-icon' sizes='60x60' href='/icon/apple-icon-60x60.png'>
<link rel='apple-touch-icon' sizes='72x72' href='/icon/apple-icon-72x72.png'>
<link rel='apple-touch-icon' sizes='76x76' href='/icon/apple-icon-76x76.png'>
<link rel='apple-touch-icon' sizes='114x114' href='/icon/apple-icon-114x114.png'>
<link rel='apple-touch-icon' sizes='120x120' href='/icon/apple-icon-120x120.png'>
<link rel='apple-touch-icon' sizes='144x144' href='/icon/apple-icon-144x144.png'>
<link rel='apple-touch-icon' sizes='152x152' href='/icon/apple-icon-152x152.png'>
<link rel='apple-touch-icon' sizes='180x180' href='/icon/apple-icon-180x180.png'>
<link rel='icon' type='image/png' sizes='192x192'  href='/icon/android-icon-192x192.png'>
<link rel='icon' type='image/png' sizes='32x32' href='/icon/favicon-32x32.png'>
<link rel='icon' type='image/png' sizes='96x96' href='/icon/favicon-96x96.png'>
<link rel='icon' type='image/png' sizes='16x16' href='/icon/favicon-16x16.png'>
<link rel='manifest' href='/manifest.json'>
<meta name='msapplication-TileColor' content='#ffffff'>
<meta name='msapplication-TileImage' content='/icon/ms-icon-144x144.png'>
<meta name='theme-color' content='#ffffff'>
";

$head="
<!DOCTYPE html>
<html>
<head>
<link rel=icon type=image/png href=icon/favicon.ico>
$iconos
	<title>$title</title>
	<link rel='stylesheet' type='text/css' href='css/estilo.css?12' media='screen'>

<meta property='og:image' itemprop='image' content='$serverroot/img/logo256.png' />
<meta property='og:site_name' content='$title' />
<meta property='og:title' content='$title' />
<meta property='og:description' content='Sistema de gestión de usuarios, creado por Ipe Romero, 2023'/>
<meta property='og:type' content='website' />
<meta property='og:locale' content='es_ES' />
<meta property='og:url' content='$serverroot' />
</head>
<body>
	<div>
		<table class='centrada'>
		<tr>
		<td>
		<a href='$urlgep'>
		<img src='img/logo.png' width=100px>
		</a>
		</td>
		<td style=text-align:center;>
		<h1>$title</h1>
		<h2>$titulo</h2>
		</td>
		<td>&nbsp;&nbsp;&nbsp;
		<a href='$urlayto'>
		<img src='img/descarga.png' width=200px>
		</a>
		</td>
		</tr>
		</table>
	</div>
	<main>
";


$foot="	</main>
	
<footer>
".menu()."
</footer>
</body>
</html>
";

$formBuscar="
<form method='post'>
	<table class=centrada><tr>
    <th><label>Buscar por nombre o apellidos:</label></th>
    <th><input type='text' name='busqueda' autocomplete='off'></th>
    <th><button type='submit' name='buscar'>Buscar</button></th>
	</tr></table>
</form>
";
