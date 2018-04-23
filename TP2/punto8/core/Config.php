<?php

/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 20/4/2018
 * Time: 2:24 AM
 */
class Config
{

    public $db;
    private $configFile = __DIR__ . "/../config.php";

    public function __construct()
    {
        $this->db = require $this->configFile;
    }
}