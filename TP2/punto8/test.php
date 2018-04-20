<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 20/4/2018
 * Time: 2:45 PM
 */
require "classes\Turno.php";

$datosTurno = [
    "titulo" => "mr",
    "nombre" => "sarasina3",
    "email" => "mail@mail.com",
    "telefono" => "421365",
    "edad" => "23",
    "talle" => "45",
    "altura" => "1,82",
    "fechaNac" => "1994-05-05",
    "colorPelo" => "rojo",
    "horario" => "9:30"
];

$turno = new Turno();
$turno->setDatos($datosTurno);
$turno->insert();
echo "Turno creado exitosamente";
echo "\n Nro de turno: ";
$var = $turno->getNroTurno();
echo "$var";
