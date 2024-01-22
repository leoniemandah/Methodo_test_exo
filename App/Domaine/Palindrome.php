<?php

namespace User\MethodoTestExo\App\Domaine;
use User\MethodoTestExo\App\Domaine\Langues\Langues;

class Palindrome {

    private $moment;
    private $langue;

    public function __construct ($langue, $moment) {
        $this->langue = $langue;
        $this->moment = $moment;
    }
    public function renverser ($str) {
            
        if (strlen($str) <= 1) return $str;
    
        $newstr  = '';
        $str2arr = str_split($str,1);
        foreach ($str2arr as $word) {
            $newstr = $word.$newstr;
        }
    
        return $newstr;
    }
    public function getBody ($input){
        
        $reversed = $this->renverser($input);
        
        $resultat = $reversed . PHP_EOL;

        if ($reversed == $input){
            $resultat .= $this->langue->feliciter();
        }
        return $resultat;
    }
    public function verifier ($input){
        
        $resultat = $this->langue->saluer($this->moment) ;
        $resultat .= $this->getBody($input) ;
        $resultat .= $this->langue->acquiter($this->moment) ;

        return $resultat ;
    }
    

}