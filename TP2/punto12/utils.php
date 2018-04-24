<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 5/4/2018
 * Time: 1:47 AM
 */

function basicSanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



/**
 * @return string Devuelve el encabezado de html hasta el nav
 * Importante: recordar cerrar. Deja abierto <html> y <body>. Que BlogEnd() cierra.
 * Solo del blog.
 */
function blogStart()
{
    return "<!DOCTYPE html>
<html lang=\"en\">
    <head>
        <meta charset=\"UTF-8\">
        <title> Blog UNLu</title>
    </head>
    <body>
        <header>
            <h1> Blog de la UNlu </h1>

        </header>
        <nav>
            <form action=\"index.php\" method=\"get\">
                <button type=\"submit\"> Ver posts</button>
            </form>
            <form action=\"views/new.post.view.php\" method=\"get\">
                <button type=\"submit\">Crear nuevo post</button>
            </form>
        </nav>";
}


function blogEnd()
{
    return "<footer> 
            <small>UNLu - Programación web - Crisafulli Bruno - Mario Quiroga</small>
        </footer>
    </body>
</html>";
}