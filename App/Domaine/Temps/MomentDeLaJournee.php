<?php

namespace User\MethodoTestExo\App\Domaine\Temps;

abstract class MomentDeLaJournee {
    private $representation;
    const MATIN = "Matin";
    const APRESMIDI = "ApresMidi";
    const SOIR = "Soir";
    const SOIREE = "Soiree";
    const INCONNU = "Inconnu";
    public function __construct ($moment){
        $this->representation = $moment;
    }
    public function toString () {
        return $this->representation;
    }
    public static function creerUnMomentDeLaJournee ($moment_type) {
        switch ($moment_type) {
            case "AuRevoir_am":
            case "Bonjour_am":
                $moment = new Matin ();
                break;
            case "AuRevoir_pm":
            case "Bonjour_pm":
                $moment = new ApresMidi ();
                break;
            case "AuRevoir_soir":
            case "Bonjour_soir":
                $moment = new Soir ();
                break;
            case "AuRevoir_nuit":
            case "Bonjour_nuit":
                $moment = new Soiree ();
                break;
            default :
                $moment = new MomentInconnu ();
        } 
        return $moment;  
    }
}