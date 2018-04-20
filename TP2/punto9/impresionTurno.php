<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 31/3/2018
 * Time: 1:07 AM
 */

$datos = array($_POST["Titulo"], $_POST["Nombre"],
    $_POST["E-mail"], $_POST["Telefono"], $_POST["edad"], $_POST["talle"],
    $_POST["altura"],
    $_POST["fecha_nacimiento"],$_POST["colorPelo"],$_POST["horario"] );

echo "Los datos del turno fueron:";
foreach ($datos as $dato){
    echo "$dato";
}