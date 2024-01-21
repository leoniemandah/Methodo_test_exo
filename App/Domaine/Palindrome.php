<?php

namespace User\MethodoTestExo;

class Palindrome {

    const BIENDIT = "Bien dit";

    public function renverser ($str) {

        if (strlen($str) <= 1) return $str;

        $newstr  = '';
        $str2arr = str_split($str,1);
        foreach ($str2arr as $word) {
            $newstr = $word.$newstr;
        }

        return $newstr;
    }

    public function epilog ($input){
        return $this->renverser($input) . PHP_EOL . $this::BIENDIT;
    }

} 