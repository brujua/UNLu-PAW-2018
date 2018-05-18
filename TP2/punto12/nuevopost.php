<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 5/4/2018
 * Time: 2:22 AM
 */

require_once "utils.php";
require_once "classes/Post.php";

$imgName = null;


// codigo basado en php.earth/docs/security/uploading
// Para validar la imagen subida y crear un nombre modificado para el archivo
// Check if we've uploaded a file
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

}


if (isset($_POST["titulo"], $_POST["descrp"])) {

    //inputs del user
    $datosPost = [
        "title" => basicSanitize($_POST["titulo"]),
        "descr" => basicSanitize($_POST["descrp"]),
        "imgname" => $imgName,
        "fecha" => date('Y-m-d')
    ];

    $post = new Post();
    $post->setCampos($datosPost);
    $post->persist();


    if (isset($_POST['tags'])) {
        $tagsStr = basicSanitize($_POST['tags']);
        $tags = explode(';', $tagsStr);
        foreach ($tags as $tag) {
            $post->addNewTag($tag);
        }
    }
} else {
    throw new Exception("Titulo o Descripcion vacias");
}


header('Location:  '.  'index.php'  );

