<?php
namespace Hola\DAO;

use Hola\Model\Tipo,
	Hola\Model\Usuario,
	Hola\DAO\postgresql\TipoDAO,
	Hola\DAO\postgresql\UsuarioDAO;

require_once(__DIR__ . '/../Autoloader.php');

/*DAO TIPO/
$tipo = new Tipo();

$tipo->setId(1);
$tipo->setNome('Tipo');

$tipodao = new TipoDAO();
$tipodao->post($tipo);
echo "<br/>";
$tipodao->get(1);
echo "<br/>";
print_r($tipodao->getAll());
echo "<br/>";
$tipodao->read('Tipo');
echo "<br/>";
$tipo->setNome('Tipo45');
$tipodao->update($tipo);
echo "<br/>";
$tipodao->delete(1);
/*DAO TIPO*/

/*DAO USUARIO/
$usuario = new Usuario();
$usuario->setId(1);
$usuario->setLogin('fulano');
$usuario->setSenha('senha');
$usuario->setEmail('email@email.com');
$usuario->setCelular('3412344321');
$usuario->setOauthId('oauthid');
$usuario->setOauthProvider('oauthprovider');
$usuario->setTwitterOauthToken('toauthtoken');
$usuario->setTwitterOauthTokenSecret('toauthtokensecret');

$usuariodao = new UsuarioDAO();
//$usuariodao->post($usuario);
echo "<br/>";
print_r($usuariodao->get(1));
echo "<br/>";
print_r($usuariodao->getAll());
echo "<br/>";
print_r($usuariodao->read('fulano'));
echo "<br/>";
$usuario->setLogin('fulanoide');
$usuariodao->update($usuario);
echo "<br/>";
//$usuariodao->delete(1);
echo "<br/>";
/*DAO USUARIO*/

/*DAO ITEM*/

/*DAO ITEM*/

?>