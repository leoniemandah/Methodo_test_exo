<?php

namespace User\MethodoTestExo\App\langues;

class Langue {

    private static $instance;
    private $file; 

    public function __construct() {

    }
    public function getData() {
        return $this->data;
    }
    public static function getInstance (){
        if (!self::$instance) {
            self::$instance = new Langue();
        }
        return self::$instance;
    }
    public function setFile($json_file)
    {
        $this->file = __DIR__ . "\\" . $json_file;
        $this->data = null; 
        $this->loadData();
    } 
    private function loadData() {
        if (!$this->data) {
            $jsonContent = file_get_contents($this->file);
            $this->data = json_decode($jsonContent);
        }
    }
}