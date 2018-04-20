<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 20/4/2018
 * Time: 12:29 AM
 */
if (!isset($_POST["Titulo"], $_POST["Nombre"], $_POST["E-mail"], $_POST["Telefono"], $_POST["edad"],
    $_POST["talle"], $_POST["altura"], $_POST["fecha_nacimiento"],
    $_POST["colorPelo"], $_POST["horario"]
)) {
    throw new Exception("Datos incompletos", 1);
}

$datosTurno = [
    "titulo" => basicSanitize($_POST["Titulo"]),
    "nombre" => basicSanitize($_POST["Nombre"]),
    "email" => basicSanitize($_POST["E-mail"]),
    "telefono" => basicSanitize($_POST["Telefono"]),
    "edad" => basicSanitize($_POST["edad"]),
    "talle" => basicSanitize($_POST["talle"]),
    "altura" => basicSanitize($_POST["altura"]),
    "fechaNac" => basicSanitize($_POST["fecha_nacimiento"]),
    "colorPelo" => basicSanitize($_POST["colorPelo"]),
    "horario" => basicSanitize($_POST["horario"])
];

$turno = new Turno();
$turno->setDatos($datosTurno);
$turno->insert();

