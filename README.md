# UNLu-PAW-2018

Guia de instalación
El Tp se encuentra divido en 2 carpetas, las paginas estaticas del TP1 y las dinámicas del TP2
El TP2 se encuentra divido en 3 subcarpetas: punto8, punto 10 y punto 12.
Cada una posee su propio archivo config.php donde se especifica los datos de la base de datos para que pueda ser accedida por la aplicación.

Modificar los archivos config.php para cada punto para la base de datos deseada, si se desea utilizar una base de datos que no sea postgres, se debe cambiar la linea "pgsql:host=" de la funcion getDsn() de la clase PdoFactory de la carpeta /core de cada ejercicio.
Correr los scripts de creación de tablas proveidos en la carpeta ´sql´ de cada punto.
Iniciar los puntos desde el archivo index.php de su carpeta correspondiente.

El punto 12 requiere de una carpeta llamada 'imgs' dentro de la carpeta del punto, con los permisos necesarios para guardar las imagenes.  

