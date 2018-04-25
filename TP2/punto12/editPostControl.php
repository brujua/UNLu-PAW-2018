<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 25/4/2018
 * Time: 12:33 AM
 */

require_once "classes/Post.php";
require_once "utils.php";
if (!isset($_POST['idPost'])) {
    throw  new Exception("Post no elegido", 1);
} else {
    $idP = basicSanitize($_POST['idPost']);
    $post = new Post($idP);
    require "views/edit.post.view.php";
}