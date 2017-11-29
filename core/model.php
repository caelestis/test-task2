<?php

class Model
{
    /**
     * @var PDO
     */
    public $pdo;

    /**
     * @return pdo
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    /**
     * @param pdo $pdo
     */
    public function setPdo(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function __construct(db $db)
    {
        $this->pdo = $db->pdo;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return '';
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $query = $this->pdo->prepare("SELECT * FROM " . $this->getTable());
        $query->execute();

        return $query->fetchAll();
    }

    /**
     * @return array
     */
    public function findOne(array $params = null)
    {
        $sql   = 'SELECT * FROM ' . $this->getTable() . ' ' .$this->getParams($params) . ' LIMIT 1';
        $query = $this->pdo->prepare($sql);
        $query->execute($params);

        return $query->fetch();
    }

    public function getParams(array $params = null)
    {
        $bindParams = '';

        if ($params) {
            $i          = 0;
            $len        = count($params);
            $bindParams = 'WHERE ';

            foreach ($params as $key => $value) {
                if ($i == $len - 1) {
                    $bindParams .= '`' . $key . '` = :' . $key;
                } else {
                    $bindParams .= '`' . $key . '` = :' . $key . ' AND ';
                }
                $i++;
            }
        }

        return $bindParams;
    }
}