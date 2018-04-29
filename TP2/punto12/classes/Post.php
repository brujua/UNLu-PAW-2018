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
    private $descr;
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
            $this->setCampos($datos);
            $this->setID($datos['id']); // sería lo mismo que asignarle el $idPost recivido

            //recupero los tags
            $queryT = $pdo->prepare("SELECT * FROM tags AS t WHERE t.id_post= :nroP");
            $queryT->bindParam('nroP', $idPost);
            $queryT->execute();
            $rows = $queryT->fetchAll();
            //y los agrego al objeto post
            foreach ($rows as $row) {
                $this->addTag($row['tag']);
            }

        }
    }

    /**
     * @return array de todos los objetos Post persistidos
     */
    public static function getAllPosts()
    {
        $posts = []; //variable de retorno
        $pdo = PdoFactory::build();
        $queryP = $pdo->prepare("SELECT * FROM Post");
        $queryP->execute();
        //recupero todos los posts
        $rowsP = $queryP->fetchAll();

        //por cada tupla
        foreach ($rowsP as $rowP) {
            // creo y cargo el objeto Post
            $post = new Post();
            $post->setCampos($rowP);
            $post->setID($rowP['id']);

            //recupero las tuplas de comentarios del post
            $queryComm = $pdo->prepare("SELECT * FROM comments AS c WHERE c.id_post = :idP");
            $queryComm->bindParam(':idP', $rowP['id']);
            $queryComm->execute();
            $rowsComm = $queryComm->fetchAll();

            //recupero las tuplas de tags del post
            $queryTag = $pdo->prepare("SELECT * FROM tags AS t WHERE t.id_post = :idP");
            $queryTag->bindParam(':idP', $rowP['id']);
            $queryTag->execute();
            $rowsTag = $queryTag->fetchAll();

            // Creo y cargo los objetos Comment y los asocio al Post
            foreach ($rowsComm as $rowC) {
                $comm = new Comment();
                $comm->setDatos($rowC);
                $post->addComment($comm);
            }
            //cargo los tags al post
            foreach ($rowsTag as $rowT) {
                $post->addTag($rowT['tag']);
            }
            //agrego el post al array
            array_push($posts, $post);
        }// end foreach tupla
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
        //guardo el id
        $this->id = $pdo->lastInsertId();


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


    /*
     * Las funciones addTag() y addComment() son privadas ya que se usan internamente cuando se recuperan
     * Posts de la base de datos, son para agregar al Post tags y Comments que ya han sido persistidos,
     * en cambio, para agregar nuevos Comments y tags que no han sido persistidos existen las funciones
     * públicas addNewTag() y addNewComment().
     */
    private function addTag($tag)
    {
        array_push($this->tags, $tag);
    }

    private function addComment($comment)
    {
        array_push($this->comments, $comment);
    }

    public function addNewTag($tag)
    {
        try {
            if ($this->id != null) {
                $pdo = PdoFactory::build();
                $query = $pdo->prepare("INSERT INTO tags (id_post, tag) VALUES (:idP, :tagg)");
                $query->bindParam('idP', $this->id);
                $query->bindParam('tagg', $tag);
                $query->execute();
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * @param $comment Comment comentario a agregar
     */
    public function addNewComment($comment)
    {
        try {
            if ($this->id != null) {
                $body = $comment->getBody();
                $author = $comment->getAuthor();
                $pdo = PdoFactory::build();
                $query = $pdo->prepare("INSERT INTO comments (author, body, id_post) VALUES (:aut, :body, :idP)");
                $query->bindParam(':aut', $author);
                $query->bindParam(':body', $body);
                $query->bindParam(':idP', $this->id);
                $query->execute();

            }

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function getStrTags()
    {
        return implode(';', $this->tags);
    }

    public function getCamposAndValues()
    {
        $values = [];
        foreach ($this->campos as $campo) {
            $values[$campo] = $this->$campo;
        }
        return $values;
    }

    private function setID($id)
    {
        $this->id = $id;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getImgName()
    {
        return $this->imgName;
    }

}