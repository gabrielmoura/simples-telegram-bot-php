<?php
/**
 * @author Gabriel Moura <blx32@srmoura.com.br>
 * @copyright 2015-2017 SrMoura
 * @license http://srmoura.com.br/license Proprietária
 * Respeite a licença do proprietário.
 */

namespace Blx32\database;

use PDO;
use PDOException;

/**
 * Class Db
 * @package Blx32\database
 */
class Db
{


    /**
     * Db constructor.
     * @param $accout
     */
    public function __construct($accout)
    {
        $this->account = $accout;
    }

    /*Evita que a classe seja clonada*/
    /**
     *
     */
    private function __clone()
    {
    }

    /*Método que destroi a conexão com banco de dados e remove da memória todas as variáveis setadas*/
    /**
     *
     */
    public function __destruct()
    {
        $this->disconnect();
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }


    private function getDBType()
    {
        return $this->account['dbtype'];
    }

    private function getHost()
    {
        return $this->account['host'];

    }

    private function getUser()
    {
        return $this->account['user'];
    }

    private function getPassword()
    {
        return $this->account['password'];
    }

    private function getDB()
    {
        return $this->account['database'];
    }

    /**
     * @return PDO
     */
    private function connect()
    {
        try {
            $this->conexao = new PDO($this->getDBType() . ":host=" . $this->getHost() . ";dbname=" . $this->getDB(), $this->getUser(), $this->getPassword());
        } catch (PDOException $i) {
            //se houver exceção, exibe
            die("Erro: <code>" . $i->getMessage() . "</code>");
        }

        return ($this->conexao);
    }

    private function disconnect()
    {
        $this->conexao = null;
    }


    /**
     * Método select que retorna um VO ou um array de objetos
     * @param $sql 'SELECT * FROM alice'
     * @param string $class 'padrão: obj|class|assoc'
     * @param null $params
     * @return array
     */
    public function selectDB($sql, $class = 'obj', $params = null)
    {
        if ($this->getDBType() == 'mysql'):
            $query = $this->connect()->prepare($sql);
            $query->execute($params);

            if ($class == 'class') {
                $rs = $query->fetchAll(PDO::FETCH_CLASS, $class) or die(print_r($query->errorInfo(), true));
            } elseif ($class == 'obj') {
                //Retorna um objeto anônimo com nomes de propriedade que correspondem aos nomes de coluna retornados no seu conjunto de resultados
                $rs = $query->fetchAll(PDO::FETCH_OBJ) or die(print_r($query->errorInfo(), true));
            } else {
                //Retorna uma matriz indexada pelo nome da coluna como retornada em seu conjunto de resultados
                $rs = $query->fetchAll(PDO::FETCH_ASSOC) or die(print_r($query->errorInfo(), true));
            }
            self::__destruct();
            return $rs;
        elseif ($this->getDBType() == 'sqlite'):
            try {
                $db = new PDO("sqlite:" . $this->getDB());
                return $db->exec('PRAGMA journal_mode=WAL;')->prepare($sql);
            } catch (PDOException $e) {
                die("Erro: <code>" . $e->getMessage() . "</code>");
            }
        else:
            //Erro, BD não aceito.
        endif;
    }


    /**
     * Método insert que insere valores no banco de dados e retorna o último id inserido
     * @param $sql
     * @param null $params
     * @return string
     */
    public function insertDB($sql, $params = null)
    {
        $conexao = $this->connect();
        $query = $conexao->prepare($sql);
        $query->execute($params);
        $rs = $conexao->lastInsertId() or die(print_r($query->errorInfo(), true));
        self::__destruct();
        return $rs;
    }


    /**
     * Método update que altera valores do banco de dados e retorna o número de linhas afetadas
     * @param $sql
     * @param null $params
     * @return int
     */
    public function updateDB($sql, $params = null)
    {
        $query = $this->connect()->prepare($sql);
        $query->execute($params);
        $rs = $query->rowCount() or die(print_r($query->errorInfo(), true));
        self::__destruct();
        return $rs;
    }


    /**
     * Método delete que excluí valores do banco de dados retorna o número de linhas afetadas
     * @param $sql
     * @param null $params
     * @return int
     */
    public function deleteDB($sql, $params = null)
    {
        $query = $this->connect()->prepare($sql);
        $query->execute($params);
        $rs = $query->rowCount() or die(print_r($query->errorInfo(), true));
        self::__destruct();
        return $rs;
    }

    /**
     * @param $sql
     * @param $tags
     * @return int
     */
    public function Ymysql($sql, $tags)
    {
        try {
            $db = new PDO($this->getDBType() . ":host=" . $this->getHost() . ";dbname=" . $this->getDB(), $this->getUser(), $this->getPassword());
            return $db->exec('set names utf8');
        } catch (PDOException $e) {
            die("Erro: <code>" . $e->getMessage() . "</code>");
        }
    }

}