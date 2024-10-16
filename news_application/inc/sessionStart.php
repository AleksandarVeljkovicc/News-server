<?php
session_start();
require_once('requiredFiles.php');
$db=new Db();
if(!$db->connect()){
    echo "Connection failed!";
    exit();
}