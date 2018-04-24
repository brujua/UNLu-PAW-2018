<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 23/4/2018
 * Time: 6:06 PM
 */
require_once __DIR__ . '/../core/PdoFactory.php';
require_once 'Comment.php';

class Post
{
    private $id;
    private $title;
    private $fecha;
    private $descr;
    private $tags;
    private $imgName;
    private $comments;
    private $campos = ['title', 'descr', 'imgname', 'fecha'];

    public function __construct($idPost = null)
    {
        $this->tags = [];
        $this->comments = [];
        if ($idPost != null) {
            $pdo = PdoFactory::build();
            $query = $pdo->prepare("SELECT * FROM Post AS p WHERE p.id= :nro");
            $query->bindParam(':nro', $idPost);
            $query->execute();
            $datos = $query->fetch();
            if ($datos === null) {
                throw new Exception("ID de blog inválido", 1);
            }
            //TODO terminar

        }
    }

    /**
     * @return array de todos los objectos Post persistidos
     */
    public static function getAllPosts()
    {
        $posts = [];
        $pdo = PdoFactory::build();
        $query = $pdo->prepare("SELECT * FROM Post");
        $query->execute();
        $rows = $query->fetchAll();

        foreach ($rows as $row) {
            $post = new Post();
            $post->setCampos($row);
            array_push($posts, $post);
        }
        return $posts;
    }

    public function setCampos($datos)
    {
        foreach ($this->campos as $campo) {
            $this->$campo = $datos[strtolower($campo)];
        }
    }

    public function persist()
    {
        $camposN = $this->getCamposNames();
        $pdoStr = $this->getValuesParametrizedPDO();
        $pdo = PdoFactory::build();
        $query = $pdo->prepare("insert into Post ($camposN) VALUES ($pdoStr)");
        $query->execute($this->getValues());

    }

    public function getCamposNames()
    {
        return join(',', $this->campos);
    }

    /**
     * Retorna un string '?, ?, ?...' listo para ser usado en una query PDO
     *
     * @return [type] [description]
     */
    public function getValuesParametrizedPDO()
    {
        return implode(',', array_fill(0, count($this->campos), '?'));
    }

    public function getValues()
    {
        $data = [];
        foreach ($this->campos as $campo) {
            $data[] = $this->$campo;
        }
        return $data;
    }

    public function setTags($datos)
    {
        foreach ($datos as $dato) {
            $this->tags[] = $dato;
        }
    }

    public function addComment($comment)
    {
        array_push($this->comments, $comment);
    }

    public function getComments()
    {
        //TODO devolver array of Comment s
        return null;
    }

    public function getCamposAndValues()
    {
        $values = [];
        foreach ($this->campos as $campo) {
            $values[$campo] = $this->$campo;
        }
        return $values;
    }

}