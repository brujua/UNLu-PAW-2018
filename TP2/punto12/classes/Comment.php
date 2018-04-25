<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 23/4/2018
 * Time: 6:57 PM
 */

class Comment
{
    private $body;
    private $author;
    private $campos = ['body', 'author'];

    public function setDatos($datos)
    {
        foreach ($this->campos as $campo) {
            $this->$campo = $datos[$campo];
        }
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getCamposAndValues()
    {
        $data = [];
        foreach ($this->campos as $campo) {
            $data[$campo] = $this->$campo;
        }
    }


}