<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 6/4/2018
 * Time: 7:19 AM
 */

//date('Y-m-d H:i:s')
echo "estamos trabajando en esta funcionalidad...";

require_once "utils.php";
$msjRes = "Post editado Exitosamente"; //variable para imprimir el resultado de la edicion
if (isset($_POST["title"], $_POST["desc"], $_POST["fecha"])) {

    //inputs del user
    $title = basicSanitize($_POST["title"]);
    $desc = basicSanitize($_POST["desc"]);
    $fecha = basicSanitize($_POST["fecha"]);

    // para recuperar el post
    $doc = new DOMDocument();
    $doc->load("posts.xml");
    // me paro en el root
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
        // codigo basado en php.earth/docs/security/uploading
        // Para validar la imagen subida y crear un nombre modificado para el archivo
        // Check if we've uploaded a file
        //Si cambiaron la imagen
        $imgName = null;//variable usada si subieron una imagen
        if (!empty($_FILES['pic']) && $_FILES['pic']['error'] == UPLOAD_ERR_OK) {
            // Be sure we're dealing with an upload
            if (is_uploaded_file($_FILES['pic']['tmp_name']) === false) {
                throw new \Exception('Error on upload: Invalid file definition');
            }

            // Rename the uploaded file
            $uploadName = $_FILES['pic']['name'];
            $ext = strtolower(substr($uploadName, strripos($uploadName, '.') + 1));
            $filename = round(microtime(true)) . mt_rand() . '.' . $ext;
            $dest = __DIR__ . '\imgs\\' . $filename;
            move_uploaded_file($_FILES['pic']['tmp_name'], $dest);
            // si la imagen es guardada mantengo su nombre en la variable imgName
            $imgName = $filename;

            //para borrar la imagen anterior
            //intento recuperar la imagen anterior
            $oldImgName = null; //variable usada para guardar el nombre de la imagen anterior
            $imgNode = $posts->item($i)->getElementsByTagName("imgName");
            //Si el post tenia imagen, devolverá un nodo
            if ($imgNode->length > 0) {
                $oldImgName = $imgNode->item(0)->nodeValue;
            }
            //borro la imagen anterior
            if ($oldImgName != null) {
                //$destBorrado = '\imgs\\' .$oldImgName
                unlink('imgs\\' . $oldImgName);
            }
            //cargo la imagen nueva al XML si es que hay
            if ($imgName != null) {
                //si ya existia el tag actualizo su contenido
                if ($oldImgName != null) {
                    $postE->getElementsByTagName("imgName")->item(0)->nodeValue = $imgName;
                } else { //sino agrego el tag de imagen
                    $postE->appendChild($doc->createElement("imgName", "$imgName"));
                }
            }
        }// fin if cargaron imagen

        //actualizo titulo
        $postE->getElementsByTagName("title")->item(0)->nodeValue = $title;
        //actualizo descripcion
        $postE->getElementsByTagName("descrp")->item(0)->nodeValue = $desc;
        //guardo
        $doc->save("posts.xml");


    } else {
        $msjRes = "No pudimos encontrar el post...";
    }
} else {
    $msjRes = "Titulo, Descripcion o fecha vacias";
}

echo blogStart();
echo "<h2> $msjRes </h2>";
echo blogEnd();