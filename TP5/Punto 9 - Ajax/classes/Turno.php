<?php
/**
 * Created by PhpStorm.
 * User: brujua
 * Date: 20/4/2018
 * Time: 12:56 AM
 */

require __DIR__ . '/../core/PdoFactory.php';

class Turno
{
    private $titulo;
    private $nombre;
    private $email;
    private $telefono;
    private $edad;
    private $talle;
    private $altura;
    private $fechaNac;
    private $colorPelo;
    private $horario;
    private $nroTurno;
    private $campos = ['titulo', 'nombre', 'email', 'telefono', 'edad', 'talle', 'altura', 'fechaNac', 'colorPelo', 'horario'];


    public function __construct($numTurno = null)
    {
        if ($numTurno != null) {
            $pdo = PdoFactory::build();
            $query = $pdo->prepare("SELECT * FROM turnos AS p WHERE p.id = :nro;");
            $query->bindParam(':nro', $numTurno);
            $query->execute();
            $datos = $query->fetch();
            if ($datos === null) {
                throw new Exception("Nro de turno inválido", 1);
            }
            foreach ($this->campos as $campo) {
                $this->$campo = $datos[strtolower($campo)];
            }

        }
    }

    public function setDatos($datos)
    {
        foreach ($this->campos as $campo) {
            $this->$campo = $datos[$campo];
        }
    }

    /**
     * Inserta el turno en la base de datos y actualiza el campo nroTurno con el id generado del insert
     */
    public function insert()
    {
        $campos = $this->getCamposStr();
        $pdoString = $this->getValoresParametrizadosPDO();
        $pdo = PdoFactory::build();
        $query = $pdo->prepare("INSERT INTO turnos ($campos) VALUES ($pdoString)");

        $query->execute($this->getValues());
        //guardo el nro de turno.
        $this->nroTurno = $pdo->lastInsertId();

    }

    public function getCamposStr()
    {
        return join(',', $this->campos);
    }

    /**
     * Retorna un string '?, ?, ?...' listo para ser usado en una query PDO
     *
     * @return [type] [description]
     */
    public function getValoresParametrizadosPDO()
    {
        return implode(',', array_fill(0, count($this->campos), '?'));
    }

    public function getValues()
    {
        $values = [];
        foreach ($this->campos as $campo) {
            $values[] = $this->$campo;
        }
        return $values;
    }

    public function getKeyAndValues()
    {
        $values = [];
        foreach ($this->campos as $campo) {
            $values[$campo] = $this->$campo;
        }
        return $values;
    }

    public function getNroTurno()
    {
        return $this->nroTurno;
    }

}

