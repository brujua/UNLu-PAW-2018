<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 6/4/2018
 * Time: 7:19 AM
 */

require_once "classes/Post.php";
require_once "utils.php";


/*
 * Por cuestiones de tiempo se ha decidido no refactorizar adecuadamente este código,
 * por lo que la abstracción de la clase Post se rompe al hacer el update directamente acá.
 */


$msjRes = "Post editado Exitosamente"; //variable para imprimir el resultado de la edicion
if (isset($_POST["title"], $_POST["desc"], $_POST["idP"])) {

    //inputs del user
    $title = basicSanitize($_POST["title"]);
    $desc = basicSanitize($_POST["desc"]);
    $idP = basicSanitize($_POST["idP"]);

    //recupero el post
    $post = new Post($idP);
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
        $oldImgName = $post->getImgName(); //variable usada para guardar el nombre de la imagen anterior

        //borro la imagen anterior
        if ($oldImgName != null) {
            //$destBorrado = '\imgs\\' .$oldImgName
            unlink('imgs\\' . $oldImgName);
        }
    }// fin if cargaron imagen

    //update

    $pdo = PdoFactory::build();
    $query = $pdo->prepare("UPDATE post SET title=?, descr=?  WHERE id=?");
    $query->execute([$title, $desc, $idP]);
    if ($imgName != null) {
        $query2 = $pdo->prepare("UPDATE post SET imgName=? WHERE id=?");
        $query2->execute([$imgName, $idP]);
    }

    //actualizo tags
    //dropeo las que tenga
    $queryD = $pdo->prepare("DELETE FROM tags WHERE id_post= :id");
    $queryD->bindParam(':id', $idP);
    $queryD->execute();
    // cargo los nuevos
    if (isset($_POST['tags'])) {
        $queryT = $pdo->prepare("INSERT INTO tags (id_post,tag) VALUES (:id, :tagg)");
        $tags = basicSanitize($_POST['tags']);
        $tagsArr = explode(';', $tags);
        foreach ($tagsArr as $tag) {
            $queryT->bindParam(':id', $idP);
            $queryT->bindParam(':tagg', $tag);
            $queryT->execute();
        }
    }


} else {
    $msjRes = "Titulo, Descripcion o fecha vacias";
}

echo blogStart();
echo "<h2> $msjRes </h2>";
echo blogEnd();