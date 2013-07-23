<?php
namespace Hola\Service;

require_once(__DIR__.'/../Autoloader.php');

$usuarioService = new UsuarioService();

/*
$usuarioService->post(
		'login', 
		'senha', 
		'email', 
		'celular', 
		'oauth_uid', 
		'oauth_provider', 
		'twitter_oauth_token', 
		'twitter_oauth_token_secret'
	);
*/
//var_dump($usuarioService->search('login'));

//$teste = '91';
//$teste = substr(Security::filterNumbers($teste), 0, 11);

//echo strlen($teste);

?>