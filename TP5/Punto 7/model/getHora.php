<?php
	date_default_timezone_set('America/Argentina/Ushuaia'); 
	echo "Hora del servidor: ";
	$hora= date("H:i:s", time());
	echo $hora;
?>