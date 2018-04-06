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

if (isset($_POST["title"], $_POST["desc"], $_POST["fecha"])) {

    //inputs del user
    $title = basicSanitize($_POST["title"]);
    $desc = basicSanitize($_POST["desc"]);
    $fecha = basicSanitize($_POST["fecha"]);

    // Recupero el post
    $domtree = new DOMDocument();
    $domtree->load("posts.xml");
    // me paro en el root
    $xml = $domtree->getElementsByTagName("xml")->item(0);

    //Creo el post
    $currentPost = $domtree->createElement("post");

    //Se agrega la fecha
    $currentPost->appendChild($domtree->createElement('date', date('Y-m-d H:i:s')));

    // Se Agrega el titulo
    $currentPost->appendChild($domtree->createElement('title', "$title"));
    // Se Agrega la descripcion
    $currentPost->appendChild($domtree->createElement('descrp', "$desc"));
    // Si subió imagen se agrega
    if ($imgName != null) {
        $currentPost->appendChild($domtree->createElement('imgName', "$imgName"));
    }
    //Agrego el post al xml
    $xml->appendChild($currentPost);
    //guardo
    $domtree->save("posts.xml");


} else {
    echo "Titulo o Descripcion vacias";
}

echo blogStart();
echo "<h2> Post Editado Exitosamente </h2>";
echo blogEnd();