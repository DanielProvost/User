<?php

namespace Core\DB;

abstract class AbstractModel{
    protected $db;

    function __construct(Database $db){
        $this->db = $db;
    }
}