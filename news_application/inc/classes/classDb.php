<?php
class Db{
    private $db;
    public function __destruct(){
        mysqli_close($this->db);
    }
    public function connect(){
        $this->db=@mysqli_connect("localhost", "root", "php", "news_db");
        if(!$this->db) return false;
        $this->query("SET NAMES utf8");
        return $this->db;
    }
    public function query($query){
        return mysqli_query($this->db, $query);
    }
    public function fetch_row($result){
        return mysqli_fetch_row($result);
    }
    public function fetch_assoc($result){
        return mysqli_fetch_assoc($result);
    }
    public function fetch_object($result){
       return mysqli_fetch_object($result);
    }
    public function error(){
        return mysqli_error($this->db);
    }
    public function errno(){
        return mysqli_errno($this->db);
    }
    public function num_rows($result){
        return mysqli_num_rows($result);
    }
    public function insert_id(){
        return mysqli_insert_id($this->db);
    }
    public function escape_string($string){
        $connection=$this->connect();
        return mysqli_real_escape_string($connection, $string);
    }
    
}
?>