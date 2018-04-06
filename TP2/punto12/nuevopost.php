<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 5/4/2018
 * Time: 2:22 AM
 */

require_once "utils.php";
$imgDir = null;

// codigo basado en php.earth/docs/security/uploading
// Para validar la imagen subida y crear un nombre modificado para el archivo
// Check if we've uploaded a file
if (!empty($_FILES['pic']) && $_FILES['pic']['error'] == UPLOAD_ERR_OK) {
    // Be sure we're dealing with an upload
    if (is_uploaded_file($_FILES['pic']['tmp_name']) === false) {
        throw new \Exception('Error on upload: Invalid file definition');
    }
    echo " prueba hola hola hola";
    // Rename the uploaded file
    $uploadName = $_FILES['pic']['name'];
    $ext = strtolower(substr($uploadName, strripos($uploadName, '.') + 1));
    $filename = round(microtime(true)) . mt_rand() . '.' . $ext;
    $dest = __DIR__ . '\imgs\\' . $filename;
    move_uploaded_file($_FILES['pic']['tmp_name'], $dest);

    // si la imagen es guardada mantengo su direccion en la variable imgDir
    $imgDir = $dest;
    echo "subiendo esta img: " . "$dest";
    // Insert it into our tracking along with the original name
}


if (isset($_POST["titulo"], $_POST["descrp"])) {

    //inputs del user
    $title = basicSanitize($_POST["titulo"]);
    $descrp = basicSanitize($_POST["descrp"]);

    // Se utiliza un archivo XML para guardar la informacion de los posts
    $domtree = new DOMDocument();
    $domtree->load("posts.xml");

    //Creo el post
    $currentPost = $domtree->createElement("post");

    //Se agrega la fecha
    $currentPost->appendChild($domtree->createElement('date', date('Y-m-d H:i:s')));

    // Se Agrega el titulo
    $currentPost->appendChild($domtree->createElement('title', "$title"));
    // Se Agrega la descripcion
    $currentPost->appendChild($domtree->createElement('descrp', "$descrp"));
    // Si subió imagen se agrega
    if ($imgDir != null) {
        $currentPost->appendChild($domtree->createElement('imgDir', "$imgDir"));
    }
    //Agrego el post al xml
    $domtree->appendChild($currentPost);
    //guardo
    $domtree->save("posts.xml");


} else {
    echo "Titulo o Descripcion vacias";
}

