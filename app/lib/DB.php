<?php
namespace App\lib;

class DB{

    /*
     *Table name
     *array data to save in database
     */
    public static function  create($table,$data){
        $PDO = $GLOBALS['PDO'];

        //拼接insert sql语句
        $sql ="INSERT INTO ".$table." (";
        foreach ($data as $key =>$value){
             $sql .= $key.",";
        }
        $sql =substr($sql,0,-1);
        $sql .=") VALUES (";
        foreach ($data as $key =>$value){
            $sql .= "'".$value."',";
        }
        $sql =substr($sql,0,-1);
        $sql .=")";
        $result = $PDO->exec($sql);
        return $result;
    }

    /*
     *Table name
     * array condition to update
     *array data to update in database
     */
    public static function  update($table,$condition,$data){
        $PDO = $GLOBALS['PDO'];

        //拼接insert sql语句
        $sql ="UPDATE ".$table."  SET ";
        foreach ($data as $key =>$value){
            $sql .= $key." = '".$value."',";
        }
        $sql =substr($sql,0,-1);
        $sql .="  WHERE ";
        foreach ($condition as $key =>$value){
            $sql .= $key ."='".$value."' and ";
        }
        $sql .=" 1=1";

        $result = $PDO->exec($sql);
        return $result;
    }

}