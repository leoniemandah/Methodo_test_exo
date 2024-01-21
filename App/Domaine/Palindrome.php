<?php

namespace User\MethodoTestExo;

class Palindrome {

    const BIENDIT = "Bien dit";
    const BONJOUR = "Bonjour";

    public function renverser ($str) {

        if (strlen($str) <= 1) return $str;

        $newstr  = '';
        $str2arr = str_split($str,1);
        foreach ($str2arr as $word) {
            $newstr = $word.$newstr;
        }

        return $newstr;
    }

    public function verifier ($input){
        return $this::BONJOUR . PHP_EOL . $this->renverser($input) . PHP_EOL . $this::BIENDIT. PHP_EOL;
    }

} 