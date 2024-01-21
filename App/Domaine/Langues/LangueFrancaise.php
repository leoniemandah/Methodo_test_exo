<?php

namespace User\MethodoTestExo\App\Domaine\langues;

class LangueFrancaise extends LangueTemplate {
    public function __construct (){
        parent::__construct();
        $this->setLanguageFile("fr.json");
    }
}