<?php

namespace Core\DB;

abstract class AbstractModel{
    protected $db;

    function __construct(DatabaseInterface $db){
        $this->db = $db;
    }
}