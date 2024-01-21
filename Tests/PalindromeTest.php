<?php

namespace User\MethodoTestExo;
use PHPUnit\Framework\TestCase;

class PalindromeTest extends TestCase
{
    const INPUTS = array("palindromes" => array("radar", "abba"),
                     "autres" => array("test", "palindrome"));
   
    public function testMiroireDePalindrome () {

        $verificateur = new Palindrome();
        foreach(self::INPUTS["palindromes"] as $data){
            $resultat = $verificateur->renverser($data);
            $this->assertEquals($resultat, $data);
        }
    }
}