<?php
namespace User\MethodoTestExo\App\Presentation;

require_once(realpath("."). DIRECTORY_SEPARATOR ."spl_autoload_register.php");

spl_autoload_register('myAutoloader');

use User\MethodoTestExo\App\Infrastructure\Systeme;
use User\MethodoTestExo\App\Domaine\Palindrome;

$system = new Systeme();

$verificateur = new Palindrome($system->getLang(), $system->getMoment());
$palindromeApp = new PalindromeApp($system, $system, $verificateur);
$palindromeApp->execute();