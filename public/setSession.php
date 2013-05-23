<?php
require_once (__DIR__ . '/../src/Hola/Autoloader.php');

use Hola\DAO\Exception,
    Hola\Model\Usuario,
    Hola\Service\UsuarioService;

$service = new UsuarioService();

if( isset($_POST['login']) && isset($_POST['senha']) ) {

  $usuario = $service->login($_POST['login'],$_POST['senha']);
  session_start();
  $_SESSION['user'] = $usuario;
}
else 
  $_SESSION['user'] = null;
?>