<?php

namespace User\MethodoTestExo;
use PHPUnit\Framework\TestCase;

class PalindromeTest2 extends TestCase
{

    const INPUTS = array("palindromes" => array("radar", "elle"),
                    "autres" => array("test", "palindrome"));

    public function PalindromeEtBienDit () {

        $verificateur = new Palindrome();
        foreach(self::INPUTS["palindromes"] as $data){
            $resultat = $verificateur->epilog($data);
            $this->assertEquals($resultat, $data.PHP_EOL."Bien dit" );
        }
    }

} 