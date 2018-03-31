<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 30/3/2018
 * Time: 6:24 PM
 */

$textArr = array("Titulo", "Nombre", "E-mail", "Telefono", "ColorPelo");
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
		 <form action=\"impresionTurno.php\" method=\"post\">";
// imprimo los inputs texto
foreach ($textArr as $text) {
    echo "<label for=\"{$text}\"> $text </label> \n
		 	<input type=\"text\" name=\"{$text}\"><br>";
}

//imprimo los input number
echo "<label for=\"edad\">Edad</label>
		 	<input type=\"number\" name=\"edad\"><br>
		 	<label for=\"talle\">Talle de Calzado</label>
		 	<input type=\"number\" name=\"talle\" min=\"20\" max=\"45\"><br>";
//deslizador de altura
echo "<label for=\"altura\">Altura</label>";
echo "<select name=\"altura\" size=\"1\">";
for ($i = 0; $i<99;$i++){
    if($i<10){
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
echo "<br>";
//fecha nacimiento
echo "<label for=\"fecha_nacimiento\"> Fecha de nacimiento</label>
			<input type=\"date\" name=\"fecha_nacimiento\"><br>";
// Horario del turno
echo "<label for=\"horario del turno\">Horario del Turno</label>
	 		<select name=\"horario\" size=\"1\" >";
for($i = 8; $i<17;$i++){
    echo "<option value=\"{$i}:00\">{$i}:00</option>
	 		<option value=\"{$i}:00\">{$i}:15</option>
	 	    <option value=\"{$i}:00\">{$i}:30</option>
	 		<option value=\"{$i}:00\">{$i}:45</option>";
}
echo "<option value=\"17:00\">17:00</option>
</select>";
// Botones
echo "<br><button type=\"reset\" value=\"reset\">Limpiar</button>
	 		<button type=\"submit\" value=\"submit\">Enviar</button>";

echo "</form>
    </main>
   </body>
</html>";


