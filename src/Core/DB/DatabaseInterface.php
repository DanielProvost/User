<?php
namespace Core\DB;

    interface DatabaseInterface{

        public function queryOne(string $sql,array $params);

        public function queryAll(string $sql, array $params);

        public function executeQuery(string $sql,array $params);


    }


