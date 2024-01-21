<?php

namespace User\MethodoTestExo\App\Domaine\langues;

class Langue {
    
    private static $instance;
    private $file; 
    
    public function __construct() {
        
    }
    public function getLanguage() {
        return $this->data;
    }
    public static function getInstance (){
        if (!self::$instance) {
            self::$instance = new Langue();
        }
        return self::$instance;
    }
    public function setLanguageFile($json_file)
    {
        $this->file = __DIR__ . "\\" . $json_file;
        $this->data = null; 
        $this->loadData();
        return $this;
    } 
    private function loadData() {
        if (!$this->data) {
            $jsonContent = file_get_contents($this->file);
            $this->data = json_decode($jsonContent);
        }
    }
}