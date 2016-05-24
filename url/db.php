<?php
namespace App;

class connect{
    public $pdo;
    public function __construct(){
        $this->pdo =$GLOBALS['PDO'];
    }

    public function  query($sql){
        $result = $this->pdo->exec($sql);
        return $result;
    }

}