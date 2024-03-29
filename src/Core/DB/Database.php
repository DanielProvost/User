<?php

namespace Core\DB;

use \PDO;
use Core\DB\DatabaseInterface;

class Database implements DatabaseInterface {

    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo=$pdo;
    }

    function executeQuery($sql,array $params=[]){
        $query=$this->pdo->prepare($sql);
        $query->execute($params);
        return $query;
    }

    function queryAll($sql,array $params=[]){
        $query = $this->executeQuery($sql,$params);
        return $query -> fetchAll();
    }

    function queryOne(string $sql,array $params=[]){
        $query = $this->executeQuery($sql,$params);
        return $query -> fetch();
    }


}
