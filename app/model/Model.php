<?php 
namespace App\model;
use App\model\DB_CORE\DB;

class Model extends DB
{
    // protected $conn;
    
    public function __construct()
    {
        // $this->connect();
    }

    public function connect()
    {/*
        if(!$this->conn) {
            $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        } */
    }
}