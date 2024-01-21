<?php

namespace User\MethodoTestExo\App\Domaine\Temps;

class Matin extends MomentDeLaJournee {
    public function __construct (){
        parent::__construct(parent::MATIN);
    }

}