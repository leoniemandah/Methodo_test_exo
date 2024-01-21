<?php

namespace User\MethodoTestExo;

class Palindrome {

    const BIENDIT = "Bien dit";
    const BONJOUR = "Bonjour";
    const AUREVOIR = "Au revoir";

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
        $resultat = $this::BONJOUR . PHP_EOL ;
        $reversed = $this->renverser($input);
        $resultat .= $reversed . PHP_EOL ;
        if ($reversed == $input){
            $resultat .= $this::BIENDIT. PHP_EOL;
        }

        $resultat .= $this::AUREVOIR. PHP_EOL;
        return $resultat ;
     }
} 