<?php


class Logger {
    
    static private $path = "./log.txt";
    
    /*--------------------------------------------------*/
    
    static public function write(
            $message
    ){
        $time = date("d.m.Y H:i:s",time());
        $result = "===={$time}===================================\n"
                . "{$message}\n";
        file_put_contents(self::$path, $result, FILE_APPEND);
    }
    
    /*--------------------------------------------------*/
    
}
