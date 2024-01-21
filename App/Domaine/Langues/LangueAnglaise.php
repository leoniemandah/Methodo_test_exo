<?php

namespace User\MethodoTestExo\App\Domaine\langues;

class LangueAnglaise extends LangueTemplate {
    public function __construct (){
        parent::__construct();
        $this->setLanguageFile("en.json");
    }
}