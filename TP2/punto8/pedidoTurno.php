<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 30/3/2018
 * Time: 6:02 PM
 */


//variables utilizadas si se quiere visualizar un turno ya cargado, es decir,
// que previamente se apreto el botón para visualizar un turno anterior.
require_once "classes\Turno.php";

$turno = !isset($_POST["nroTurno"]) ? null : new Turno($_POST["nroTurno"]);
$datos = null;
if ($turno != null) {
    $datos = $turno->getKeyAndValues();
}

$textArr = ["titulo", "nombre", "email", "telefono", "colorPelo"];
echo "<!DOCTYPE html>
<html>
	<head>
		<meta charset=\"UTF-8\">
		<title>Pedido de Turno</title>
	</head>
	<body>
		<header>
			<h1>Pedido de Turno</h1>
			
		</header>
	    <main>
        <h4> Complete el formulario para hacer el pedido</h4>
		 <form action=\"cargaTurno.php\" method=\"post\">";
// imprimo los inputs texto
foreach ($textArr as $text) {
    //completo los campos seteando el value del input si fue pedido visualizar un turno anterior
    $value = ($datos[$text] ?? ""); //null coalescing operator
    echo "<label for=\"{$text}\"> $text </label> \n
		 	<input type=\"text\" name=\"{$text}\" value=\"{$value}\"><br>";
}

//imprimo los input number
$value = ($datos["edad"] ?? "");
echo "<label for=\"edad\">Edad</label>
		 	<input type=\"number\" name=\"edad\" value=\"{$value}\"><br>";
$value = ($datos["talle"] ?? "");
echo "<label for=\"talle\">Talle de Calzado</label>
		 	<input type=\"number\" name=\"talle\" min=\"20\" max=\"45\" value=\"{$value}\"><br>";

//deslizador de altura

echo "<label for=\"altura\">Altura</label>";
echo "<select name=\"altura\" size=\"1\">";
for ($i = 0; $i<99;$i++){
    if ($i)
        if ($i < 10) {
            echo "<option value=\"1,0{$i}\">1,0{$i}</option>";
        } else {
            echo "<option value=\"1,{$i}\">1,{$i}</option>";
        }
}
for ($i=0; $i<50; $i++){
    if($i<10){
        echo "<option value=\"2,0{$i}\">2,0{$i}</option>";
    } else {
        echo "<option value=\"2,{$i}\">2,{$i}</option>";
    }
}
$value = ($datos["altura"]);
if ($value != null) {
    echo "<option value=\"{$value}\" selected> {$value} </option>";
}
echo "</select>";
//fecha nacimiento
$value = ($datos["fechaNac"] ?? "");
echo "<br><label for=\"fecha de nacimiento\">fecha de nacimiento</label>
			<input type=\"date\" name=\"fecha_nacimiento\" value=\"{$value}\"><br>";
// Horario del turno

echo "<label for=\"horario del turno\">Horario del Turno</label>
	 		<select name=\"horario\" size=\"1\">";
for($i = 8; $i<17;$i++){
    echo "<option value=\"{$i}:00\">{$i}:00</option>
	 		<option value=\"{$i}:00\">{$i}:15</option>
	 	    <option value=\"{$i}:00\">{$i}:30</option>
	 		<option value=\"{$i}:00\">{$i}:45</option>";
}
echo "<option value=\"17:00\">17:00</option>";
$value = $datos["horario"];
if ($value != null) {
    echo "<option value=\"{$value}\"> {$value} </option>";
}
echo "</select>";
// Botones
echo "<br><button type=\"reset\" value=\"reset\">Limpiar</button>
	 		<button type=\"submit\" value=\"submit\">Enviar</button>";

/* Sección agregada para la parte 2 del tp.
    Se ha decidido no refactorizar el tema de imprimir html por echo
    debido al pequeño tamaño del punto.
*/
echo "</form> <br> 
      <form action=\"pedidoTurno.php\" method=\"post\">
        <h2>Consultar Turno Anterior</h2>
        <label for=\"nroTurno\">Nro de Turno</label>
		<input type=\"number\" name=\"nroTurno\"><br>
		<button type=\"submit\" value=\"submit\">Consultar</button>";

echo "</form>
    </main>
   </body>
</html>";