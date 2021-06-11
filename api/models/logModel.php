<?php
    class Log
    {
     
        private $fileLog;
     
        function __construct($path)
        {
            $this->fileLog = fopen($path, "a");
        }
     
        function writeLine($type, $message)
        {
            $ip = ($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 0;
            $method = $_SERVER['REQUEST_METHOD'];
            $date = new DateTime();
            $uri = $_SERVER['REQUEST_URI'];
            fputs($this->fileLog, "[" . $type . "][" . $date->format('d-m-Y H:i:s') . "][".$ip."]: " . $message . "[".$method."][".$uri."]\n");
        }
     
        function close()
        {
            fclose($this->fileLog);
        }
    }
?>