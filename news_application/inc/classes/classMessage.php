<?php
class Message{
    public static function error($str){
        return "<p style='background-color: red; color: white; display: inline-block; padding: 3px; border-radius: 5px;'>{$str}</p>";  //display: inline-block; - daje paragraph-u sirinu texta.
    }
    public static function success($str){
        return "<p style='background-color: green; color: white; display: inline-block; padding: 3px; border-radius: 5px;'>{$str}</p>";
    }
    public static function info($str){
        return "<p style='background-color: #0F2699; color: white; display: inline-block; padding: 3px; border-radius: 5px;'>{$str}</p>";
    }
}
?>