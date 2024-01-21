<?php 

namespace User\MethodoTestExo\Tests\Utilities; 

use User\MethodoTestExo\App\Domaine\Palindrome; 
use User\MethodoTestExo\App\Domaine\Langues\Langue; 
use User\MethodoTestExo\App\Domaine\Langues\LangueFrancaise; 
use User\MethodoTestExo\App\Domaine\Temps\MomentInconnu; 

 

class VerificateurPalindromeBuilder { 

    private $langue; 
    private $moment; 

    public function __construct () { 

        $this->langue = new LangueFrancaise (); 
        $this->moment = new MomentInconnu(); 

    }  

 

    public static function parDefault () { 

        $builder =  new VerificateurPalindromeBuilder(); 
        return $builder->build(); 

    }  

    public function ayantCommeLangue ($langue){ 

        $this->langue = $langue; 
        return $this; 

    } 

    public function AyantPourMomentDeLaJournee ($moment){ 

        $this->moment = $moment; 
        return $this; 

    } 

 

    public function build() { 
        
        return new Palindrome($this->langue, $this->moment); 
    } 

} 