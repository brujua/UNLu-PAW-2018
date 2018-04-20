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

    public function setDatos($datos)
    {
        foreach ($this->campos as $campo) {
            $this->$campo = $datos[$campo];
        }
    }

    public function insert()
    {
        $campos = $this->getCamposStr();
        $pdoString = $this->getValoresParametrizadosPDO();
        $pdo = PdoFactory::build();
        $query = $pdo->prepare("INSERT INTO peliculas ($campos) VALUES ($pdoString)");
        $query->execute($this->getValues());
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
            $values[] = $this->$campo; // no entendemos como funciona esta asignación si no aclara el index a asignar
        }
        return $values;
    }

}

