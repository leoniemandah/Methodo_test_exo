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
    public function testMiroirPalindrome () {

        $verificateur = new Palindrome();
        foreach(self::INPUTS["palindromes"] as $data){
            $resultat = $verificateur->renverser($data);
            $this->assertEquals($resultat, $data);
        }
    }

    /*
    Quand ce n'est pas un palindrome
    */
    public function testMiroirNonPalindrome () {

        $verificateur = new Palindrome();
        foreach(self::INPUTS["autres"] as $data){
            $resultat = $verificateur->renverser($data);

            $this->assertEquals($resultat, strrev($data));
        }
    }

     /*
    Quand c'est une chaine
    */
    public function testMiroirChaine () {

        foreach(self::INPUTS as $type){
            foreach($type as $key => $data){

                $verificateur = new Palindrome();
                $resultat = $verificateur->renverser($data);
                $this->assertEquals($resultat, strrev($data));
            }
        }
    }

    /*
        On renvoie bien dit
    */
    public function testBienDit () {

        $verificateur = new Palindrome();
        foreach(self::INPUTS["palindromes"] as  $data){
            $resultat = $verificateur->verifier($data);
            $correction = strrev($data) . PHP_EOL . "Bien dit" . PHP_EOL;
            $this->assertEquals($resultat, $correction);
        }
    }
}