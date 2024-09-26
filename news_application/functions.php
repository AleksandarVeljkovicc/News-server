<?php

function validString($str){
    $forbidden=array("="," ","(",")","'",'"',"<",">");
    foreach($forbidden as $v)
        if(strpos($str, $v)!==false)return false;
    return true;
}


function login(){
    if(isset($_SESSION['id']) && isset($_SESSION['info']) && isset($_SESSION['status']))
        return true;
    else if(isset($_COOKIE['id']) && isset($_COOKIE['info']) && isset($_COOKIE['status']))
        {
            $_SESSION['id']=$_COOKIE['id'];
            $_SESSION['info']=$_COOKIE['info'];
            $_SESSION['status']=$_COOKIE['status'];
            $_SESSION['username']=$_COOKIE['username'];
            return true;
        }
    else
        return false;
}
?>