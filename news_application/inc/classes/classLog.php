<?php
    class Log{
        public static function write($fileName, $txt){
            $oldTxt="";
            if(file_exists($fileName))$oldTxt=file_get_contents($fileName);
            $newTxt=date("d.m.Y H:i:s", time())." - ".$txt."\n".$oldTxt;
            file_put_contents($fileName, $newTxt);
        }
    }
?>