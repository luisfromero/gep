<?php
include_once "protected.php";

/* Database config */

$db_host		= DB_HOST;
$db_user		= DB_USER;
$db_pass		= DB_PASS;
$db_database	= DB_DATABASE; 

/* End config */

if(!isset($link)){
$link = mysqli_connect($db_host,$db_user,$db_pass,$db_database);
echo mysqli_connect_error (  );
if($link)$result=mysqli_query($link,"SET names UTF8");
}

getIP();

