<?php

namespace User\MethodoTestExo\App\Domaine\langues;

abstract class LangueTemplate {
    private $file; 
    private $data;    
    public function __construct() {
        
    }
    public function saluer ($moment) {
        switch ($moment->toString()) {
            case "Matin":
                $salutation = $this->data->Salutation->Bonjour_am;
                break;
            case "ApresMidi":
                $salutation = $this->data->Salutation->Bonjour_pm;
                break;
            case "Soir":
                $salutation = $this->data->Salutation->Bonjour_soir;
                break;
            case "Soiree":
                $salutation = $this->data->Salutation->Bonjour_nuit;
                break;
            default :
                
                throw new \Exception('Le moment de la journée n\'est pas reconnu ! '
                                    . PHP_EOL 
                                    . "<" . $moment->toString() . ">"
                                    . PHP_EOL );
        }
        return $salutation . PHP_EOL;
    }
    public function acquiter ($moment) {
        
        switch ($moment->toString()) {
            case "Matin":
                $AuRevoir = $this->data->AuRevoir->AuRevoir_am;
                break;
            case "ApresMidi":
                $AuRevoir = $this->data->AuRevoir->AuRevoir_pm;
                break;
            case "Soir":
                $AuRevoir = $this->data->AuRevoir->AuRevoir_soir;
                break;
            case "Soiree":
                $AuRevoir = $this->data->AuRevoir->AuRevoir_nuit;
                break;
            default :
              
                throw new \Exception('Le moment de la journée n\'est pas reconnu ! '
                                    . PHP_EOL 
                                    . "<" . $moment->toString() . ">"
                                    . PHP_EOL );
        }
        return $AuRevoir . PHP_EOL;
    }
    public function feliciter () {
        return $this->data->BienDit . PHP_EOL;
    }
    
    public function setLanguageFile($json_file)
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