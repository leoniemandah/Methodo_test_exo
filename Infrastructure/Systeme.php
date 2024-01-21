<?php

namespace User\MethodoTestExo\App\Infrastructure;

require_once(realpath("."). DIRECTORY_SEPARATOR ."spl_autoload_register.php");

spl_autoload_register('myAutoloader');

use User\MethodoTestExo\App\Domaine\Langues\LangueFrancaise;
use User\MethodoTestExo\App\Domaine\Langues\LangueAnglaise;
use User\MethodoTestExo\App\Domaine\Temps\Matin;
use User\MethodoTestExo\App\Domaine\Temps\ApresMidi;
use User\MethodoTestExo\App\Domaine\Temps\Soir;
use User\MethodoTestExo\App\Domaine\Temps\Soiree;


class Systeme implements InputInterface, OutputInterface {

    private $input;
    private $output;
    private $langue;

    public function __construct (){
        $this->input = STDIN;
        $this->output = STDOUT;
        $this->langue = $this->getLang();
    }
    public function salutation(){
        return fprintf($this->output, "%s", $this->langue->saluer($this->getMoment()));
    }
    public function acquiter(){
        return fprintf($this->output, "%s", $this->langue->acquiter($this->getMoment()));
    }
    public function print($data){
        return fprintf($this->output, "%s", $data);
    }
    public function get(){
        return trim(fgets($this->input));
    }
    public function getMoment(){
        $date_sys = date('H');
        if ($date_sys <6){
            $moment = new Soiree();
        }elseif ($date_sys <12){
            $moment = new Matin();
        }elseif ($date_sys <16){
            $moment = new ApresMidi();
        }elseif ($date_sys <22){
            $moment = new Soir();
        }else {
            $moment = new Soiree();
        }
        return $moment;
    }
    public function getLang(){
        
        $lang = getenv("LANG");
        $fichierDeLangue = explode('_', $lang)[0];
        switch ($fichierDeLangue){
            case "fr": $langue = new LangueFrancaise () ; break;
            case "en": $langue = new LangueAnglaise () ; break;
            default : throw new \Exception ("La langue du système n'est pas implementé !");
        }
        return $langue;
    }
}
