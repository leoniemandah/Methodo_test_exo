<?php

namespace User\MethodoTestExo\App\Domaine\Temps;

class Soiree extends MomentDeLaJournee {
    public function __construct (){
        parent::__construct(parent::SOIREE);
    }

}