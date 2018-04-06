<?php

require_once "utils.php";


if (isset($_POST["fecha"])) {

    $fecha = basicSanitize($_POST["fecha"]);


    /*// Xpath para recuperar el post
      $xpath = new DOMXPath($doc);
    $value = $xpath->evaluate("/xml/post/date[contains(text()),'$fecha']");*/


    $doc = new DOMDocument();
    $doc->load("posts.xml");
    //tomo el root
    $xml = $doc->getElementsByTagName("xml")->item(0);
    $posts = $xml->getElementsByTagName("post");
    $postE = null; //post buscado
    //recupero el post
    for ($i = 0; $i < $posts->length; $i++) {
        $postAux = $posts->item($i);
        if ($postAux->getElementsByTagName("date")->item(0)->nodeValue == $fecha) {
            $postE = $postAux;
            break;
        }
    }
    if ($postE != null) {

        $title = $postE->getElementsByTagName("title")->item(0)->nodeValue;
        $desc = $postE->getElementsByTagName("descrp")->item(0)->nodeValue;

        echo blogStart();
        echo "
        <main> 
            <form action=\"editarPost_S.php\" method=\"post\" enctype=\"multipart/form-data\">
                <h2>Editar Post </h2>
                <input type=\"text\" name=\"title\" value=\"$title\">
                <input type=\"text\" name=\"desc\" value=\"$desc\">
                <label for=\"pic\">Cambiar imagen:  </label>
                <input type=\"file\" name=\"pic\" id=\"pic\"><br> 
                <button type=\"submit\">Terminado</button>

            </form>

        </main>";
        echo blogEnd();

    } else {
        echo "El post no ha podido ser encontrado";
    }


} else {
    echo "post no elegido";
}

/*

 echo $_POST["fecha"];*/