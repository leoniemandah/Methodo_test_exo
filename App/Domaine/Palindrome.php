<?php

namespace User\MethodoTestExo;

class Palindrome {

    const BIENDIT = "Bien dit";

    public function renverser ($input) {
        return $input;
    }

    public function epilog ($input){
        return $this->renverser($input) . PHP_EOL . $this::BIENDIT;
    }

} 