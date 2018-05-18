<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 5/4/2018
 * Time: 1:47 AM
 */

function basicSanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



