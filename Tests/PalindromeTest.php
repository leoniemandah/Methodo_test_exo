<?php

namespace User\MethodoTestExo\Tests;
use PHPUnit\Framework\TestCase;

use User\MethodoTestExo\App\Domaine\Palindrome;
use User\MethodoTestExo\Tests\Utilities\VerificateurPalindromeBuilder;
use User\MethodoTestExo\App\Domaine\Langues\LangueFrancaise;
use User\MethodoTestExo\App\Domaine\Langues\LangueAnglaise;
use User\MethodoTestExo\App\Domaine\Langues\Langue;
use User\MethodoTestExo\App\Domaine\Temps\Matin;
use User\MethodoTestExo\App\Domaine\Temps\ApresMidi;
use User\MethodoTestExo\App\Domaine\Temps\Soir;
use User\MethodoTestExo\App\Domaine\Temps\Soiree;
use User\MethodoTestExo\App\Domaine\Temps\MomentInconnu;
use User\MethodoTestExo\App\Domaine\Temps\MomentDeLaJournee;
use User\MethodoTestExo\Tests\Matchers\PremiereLigne;
use User\MethodoTestExo\Tests\Matchers\DerniereLigne;

class PalindromeTest extends TestCase
{
   
    const INPUTS = array("palindromes" => array("radar", "abba"),
                    "autres" => array("test", "palindrome"));
    const MOMENTS_SALUTATIONS = array(
        "Bonjour_am",
        "Bonjour_pm",
        "Bonjour_soir",
        "Bonjour_nuit"
    );
    const MOMENTS_AUREVOIR = array(
        "AuRevoir_am",
        "AuRevoir_pm",
        "AuRevoir_soir",
        "AuRevoir_nuit"
    );
    
    /*
        ETANT DONNE un utilisateur parlant une langue
        ALORS l'expression renvoyée est conforme à la langue choisit
    */
    public function testBienDitDesLangues (){

        $langue = new LangueFrancaise ();
        
        $this->assertEquals("Bien dit".PHP_EOL, $langue->feliciter());

        $langue = new LangueAnglaise ();
        
        $this->assertEquals("Well said".PHP_EOL, $langue->feliciter());
  
    }   
    /*
        ETANT DONNE un utilisateur parlant la langue française
        QUAND on saisit un non palindrome 
        ALORS celui-ci est renvoyé 
        SANS « Bien dit » renvoyé ensuite
    */
    public function testNonPalindromeNonBienDit () {
        
        $verificateur = new VerificateurPalindromeBuilder();
        $langueFr = new LangueFrancaise();

        $correction = Langue::getInstance()->setLanguageFile('fr.json')->getLanguage()->BienDit;
        
        foreach(self::INPUTS["autres"] as $data){
                $languageMock = $this->createMock(LangueFrancaise::class);
                $languageMock->expects($this->never())->method('feliciter')->willReturn($correction.PHP_EOL);
                $resultat = $verificateur->ayantCommeLangue($languageMock)->build()->getBody($data);
                $res_arr = explode(PHP_EOL, $resultat);
                
                
                $this->assertEquals(strrev($data), $res_arr[0]);
                $this->assertEquals("", $res_arr[1]);
                $this->assertEquals(2, count($res_arr));

            
        }
    }
    /*
        ETANT DONNE un utilisateur parlant la langue anglaise
        QUAND on saisit un non palindrome 
        ALORS celui-ci est renvoyé 
        SANS « Bien dit » renvoyé ensuite
    */
    public function testBienDit () {
        
        $verificateur = new VerificateurPalindromeBuilder();
        $langueFr = new LangueFrancaise();

        $correction = Langue::getInstance()->setLanguageFile('fr.json')->getLanguage()->BienDit;
        
        foreach(self::INPUTS["palindromes"] as $data){
                $languageMock = $this->createMock(LangueFrancaise::class);
                $languageMock->expects($this->once())->method('feliciter')->willReturn($correction.PHP_EOL);
                $resultat = $verificateur->ayantCommeLangue($languageMock)->build()->getBody($data);
                $res_arr = explode(PHP_EOL, $resultat);
                
                
                $this->assertEquals($data, $res_arr[0]);
                $this->assertEquals($correction, $res_arr[1]);

            
        }
        
    }
    
    /*
        ETANT DONNE un utilisateur parlant une langue
        QUAND on saisit une chaîne
        ALORS <bonjour> de cette langue est envoyé avant tout
    */
    public function testBonjour (){

        $verificateur = new VerificateurPalindromeBuilder();
        $langueFr = new LangueFrancaise();
        foreach(self::MOMENTS_SALUTATIONS as $moment_type){
            $moment = MomentDeLaJournee::creerUnMomentDeLaJournee($moment_type) ;
            $langueStub = $this->createStub(LangueFrancaise::class);
            
            $correction = Langue::getInstance()->setLanguageFile('fr.json')->getLanguage()->Salutation->$moment_type;
            $langueStub->method('saluer')
                ->willReturn($correction.PHP_EOL);
            foreach(self::INPUTS as $type){
                foreach($type as $key => $data){
                    
                    $contrainte = new PremiereLigne(
                        $verificateur
                                    ->ayantCommeLangue($langueStub)
                                    ->AyantPourMomentDeLaJournee($moment)
                                    ->build()->verifier($data)
                    );
                    
                    $this->assertThat($correction, $contrainte);

                    $contrainte = new PremiereLigne(
                        $verificateur
                                    ->ayantCommeLangue($langueFr)
                                    ->AyantPourMomentDeLaJournee($moment)
                                    ->build()->verifier($data)
                    );
                    
                    $this->assertThat($correction, $contrainte);
                }
            }
        }
    } 
    /*
        ETANT DONNE un utilisateur parlant une langue
        QUAND on saisit une chaîne
        ALORS <auRevoir> dans cette langue est envoyé en dernier
    */
    
    public function testAuRevoir (){
        
        $verificateur = new VerificateurPalindromeBuilder();
        $langueFr = new LangueFrancaise();
        foreach(self::MOMENTS_AUREVOIR as $moment_type){
            $moment = MomentDeLaJournee::creerUnMomentDeLaJournee($moment_type) ;
            
            $correction = Langue::getInstance()->setLanguageFile('fr.json')->getLanguage()->AuRevoir->$moment_type;
            foreach(self::INPUTS as $type){
                foreach($type as $key => $data){
                    $contrainte = new DerniereLigne(
                        $verificateur
                                    ->ayantCommeLangue($langueFr)
                                    ->AyantPourMomentDeLaJournee($moment)
                                    ->build()->verifier($data)
                    );
                    
                    $this->assertThat($correction, $contrainte);
                }
            }
        }
    }
    
}