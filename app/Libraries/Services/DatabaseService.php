<?php

namespace App\Libraries\Services;

class DatabaseService
{
    // protected $db = \Config\Database::connect();
    // protected $Table;
    // protected $builder;
    public function __construct($Table)
    {
        $this->builder  = $this->db->table($Table);
    }
    public static function AddOne($value)
    {
        return  false;
    }

    public static function UpdateOne($id)
    {
        return  false;
    }

    public static function GetOneById($column, $id)
    {
        return  false;
    }

    public static function GetMany()
    {
        return  false;
    }

    public static function DeleteOneById($Table, $column, $id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($Table);
        $builder->delete([$column => $id]);
    }
}
