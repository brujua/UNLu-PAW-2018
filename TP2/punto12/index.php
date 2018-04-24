<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 23/4/2018
 * Time: 7:18 PM
 */


require_once 'classes/Post.php';
require_once 'classes/Comment.php';

$posts = Post::getAllPosts();
require 'views/indexView.php';