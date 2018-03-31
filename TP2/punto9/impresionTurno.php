<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 31/3/2018
 * Time: 1:07 AM
 */

$titulo=$_POST["Titulo"];
$nombre=$_POST["Nombre"];
$email=$_POST["E-mail"];
$telefono=$_POST["Telefono"];
$edad=$_POST["edad"];
$talle=$_POST["talle"];
$altura=$_POST["altura"];
$fecha_nac=$_POST["fecha_nacimiento"];
$pelo=$_POST["colorPelo"];
$turno=$_POST["horario"];

$datos = array($_POST["Titulo"],$_POST["Nombre"],$_POST["E-mail"],$_POST["Telefono"],$_POST["edad"],$_POST["talle"],$_POST["altura"],
    $_POST["fecha_nacimiento"],$_POST["colorPelo"],$_POST["horario"] );
echo "Los datos del turno fueron:";
foreach ($datos as $dato){
    echo "$dato";
}