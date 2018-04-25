<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 25/4/2018
 * Time: 2:23 AM
 */
require_once 'utils.php';
require_once 'classes/Post.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_POST['idPost'], $_POST['author'], $_POST['body'])) {
    throw new Exception("Datos incompletos", 1);
} else {
    $idP = basicSanitize($_POST['idPost']);
    $author = basicSanitize($_POST['author']);
    $body = basicSanitize($_POST['body']);

    //creo el comment
    $comment = new Comment();
    $comment->setDatos([
        "author" => $author,
        "body" => $body
    ]);
    //creo el post
    $post = new Post($idP);
    //agrego el nuevo comentario (lo que efectivizará la persistencia)
    $post->addNewComment($comment);

    header('Location: index.php');
}