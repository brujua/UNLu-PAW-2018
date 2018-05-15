<?php



    require_once __DIR__ . "\classes\Turno.php";

    //si se quiere visualizar un turno ya cargado, es decir,
    // que previamente se apreto el botón para visualizar un turno anterior, seteo las variables.
    $turno = isset($_POST["nroTurno"]) ? new Turno($_POST["nroTurno"]) : null ;
    $datos = null;
    if ($turno != null) {
        $datos = $turno->getKeyAndValues();
    }

    $textArr = ["titulo", "nombre", "email", "telefono", "colorPelo"];




    include "views/pedido.turno.view.php";