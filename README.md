# Web genérica de una base de datos de personas

Incluye 5 páginas

* Insertar datos de usuario
* Buscar datos de un usuario
* Editar datos de un usuario
* Borrar un usuario
* Listar todos los usuarios

Cuando se borra un dato, sólo se marca como borrado. Para eliminar, utilice otro visor de la base de datos.

Los datos críticos se encuentran en un archivo php/protected.php que no se sube a Github, cuyo contenido es como este:

```php
<?php
define("DB_HOST", '127.0.0.1:3308');
define("DB_USER", 'root');
define("DB_PASS", 'algo');
define("DB_DATABASE", "database");
define("SECRET", "password");
$title="Mi sitio web";
?>
```

Iconos generados en https://www.favicon-generator.org, excepto el de 256x256 que necesita whatsapp.

