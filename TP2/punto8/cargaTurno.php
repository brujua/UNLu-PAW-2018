<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 20/4/2018
 * Time: 12:29 AM
 */

require_once "utils.php";
require_once "classes\Turno.php";

/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

if (!isset($_POST["titulo"], $_POST["nombre"], $_POST["email"], $_POST["telefono"], $_POST["edad"],
    $_POST["talle"], $_POST["altura"], $_POST["fecha_nacimiento"],
    $_POST["colorPelo"], $_POST["horario"])) {
    throw new Exception("Datos incompletos", 1);
}

$datosTurno = [
    "titulo" => basicSanitize($_POST["titulo"]),
    "nombre" => basicSanitize($_POST["nombre"]),
    "email" => basicSanitize($_POST["email"]),
    "telefono" => basicSanitize($_POST["telefono"]),
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
echo "Turno creado exitosamente";
echo "\n Nro de turno: ";
$var = $turno->getNroTurno();
echo $var;
