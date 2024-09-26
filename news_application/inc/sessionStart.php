<?php
session_start();
require_once('inc/requiredFiles.php');
$db=new Db();
if(!$db->connect()){
    echo "Connection failed!";
    exit();
}