<?php

namespace User\MethodoTestExo\App\Presentation;

require_once(realpath("."). DIRECTORY_SEPARATOR ."spl_autoload_register.php");

spl_autoload_register('myAutoloader');


class PalindromeApp
{
    private $inputPort;
    private $outputPort;
    private $verificateur;

    public function __construct(
        $inputPort,
        $outputPort,
        $verificateur
    ) {
        $this->inputPort = $inputPort;
        $this->outputPort = $outputPort;
        $this->verificateur = $verificateur;
    }

    public function execute()
    {
        $this->outputPort->salutation();
        $body = $this->verificateur->getBody($this->inputPort->get());
        $this->outputPort->print($body);
        $this->outputPort->acquiter();
    }
}