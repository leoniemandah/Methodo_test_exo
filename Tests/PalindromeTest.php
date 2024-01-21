<?php

namespace User\MethodoTestExo;
use PHPUnit\Framework\TestCase;
use User\MethodoTestExo\langues\Langue;

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

    /*
     On renvoie bonjour
    */
    public function testBonjour () {

        $verificateur = new Palindrome();
        foreach(self::INPUTS as $type){
            foreach($type as $key => $data){
                $resultat = $verificateur->verifier($data);
                $res_arr = explode(PHP_EOL, $resultat);
                $correction = "Bonjour";
                $this->assertEquals($res_arr[0], $correction);
            }
        }
    }
    
    /*
     On renvoie Aurevoir
    */
    public function testAurevoir () {

        $verificateur = new Palindrome();
        foreach(self::INPUTS as $type){
            foreach($type as $key => $data){
            $resultat = $verificateur->verifier($data);
            $res_arr = explode(PHP_EOL, $resultat);
            $correction = "Au revoir";
            $this->assertEquals($res_arr[count($res_arr)-2], $correction);
            }
        }
    }  

    /*
    On renvoie bien dit en français
    */
    public function testBienDit_french (){

        $langueInstance = Langue::getInstance();

        $langueInstance->setFile('fr.json');
        $expressions = $langueInstance->getData();
        $verificateur = new Palindrome();
        foreach(self::INPUTS['palindromes'] as $data){
            $resultat = $verificateur->verifier($data);
            $res_arr = explode(PHP_EOL, $resultat);
            $correction = $expressions->BienDit;
            $this->assertEquals($correction, $res_arr[2]);
            $this->assertEquals(strrev($data), $res_arr[1]);

        }
    }   
    /*
      QUAND l'expression renvoyée est conforme à la langue choisit
    */
    public function testBienDitDesLangues (){

        $langueInstance = Langue::getInstance();

        $langueInstance->setFile('fr.json');
        $expressions = $langueInstance->getData();

        $this->assertEquals("Bien dit", $expressions->BienDit);


        $langueInstance->setFile('en.json');
        $expressions = $langueInstance->getData();
        $this->assertEquals("Well said", $expressions->BienDit);
    }  
}