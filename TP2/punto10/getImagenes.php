<?php

	require __DIR__ . '/core/PdoFactory.php';

	# RETORNA TODAS LA IMAGENES A index.php
	$pdo = PdoFactory::build();
	$query = $pdo->prepare("SELECT * FROM imagenes;");
	$query->execute();
	$imagenes =  $query->fetchall();


?>