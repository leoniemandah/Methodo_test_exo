<?php

namespace User\MethodoTestExo;
use PHPUnit\Framework\TestCase;

class PalindromeTest extends TestCase
{
    const INPUTS = array("palindromes" => array("radar", "abba"),
                         "autres" => array("test", "palindrome"));
   
    /*
     Quand ce n'est pas un palindrome
    */
    public function testMiroireDePalindrome () {

        $verificateur = new Palindrome();
        foreach(self::INPUTS["palindromes"] as $data){
            $resultat = $verificateur->renverser($data);
            $this->assertEquals($resultat, $data);
        }
    }

    /*
    Quand ce n'est pas un palindrome
    */
    public function testMiroireDeNonPalindrome () {

        $verificateur = new Palindrome();
        foreach(self::INPUTS["autres"] as $data){
            $resultat = $verificateur->renverser($data);

            $this->assertEquals($resultat, strrev($data));
        }
    }
}