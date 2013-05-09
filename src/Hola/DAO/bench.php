<?php
namespace Hola\DAO;

use Hola\Model\Tipo,
	Hola\Model\Usuario,
	Hola\Model\Item,
	Hola\Model\Evento,
	Hola\Model\Convidado,
	Hola\Model\TipoItem,
	Hola\DAO\postgresql\TipoDAO,
	Hola\DAO\postgresql\UsuarioDAO,
	Hola\DAO\postgresql\ItemDAO,
	Hola\DAO\postgresql\EventoDAO,
	Hola\DAO\postgresql\ConvidadoDAO,
	Hola\DAO\postgresql\TipoItemDAO;

require_once(__DIR__ . '/../Autoloader.php');

/*DAO TIPO/
$tipo = new Tipo();

$tipo->setId(2);
$tipo->setNome('Tipo');

$tipodao = new TipoDAO();
//$tipodao->post($tipo);
echo "<br/>";
$tipodao->get(2);
echo "<br/>";
print_r($tipodao->getAll());
echo "<br/>";
$tipodao->read('Tipo45');
echo "<br/>";
//$tipo->setNome('Tipo45');
//$tipodao->update($tipo);
echo "<br/>";
//$tipodao->delete(1);
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
//$usuario->setLogin('fulanoide');
//$usuariodao->update($usuario);
echo "<br/>";
////$usuariodao->delete(1);
echo "<br/>";
/*DAO USUARIO*/


/*DAO ITEM/
$itemdao = new ItemDAO();

$item = new Item();
$item->setId(1);
$item->setNome('item');
$item->setUsuario($usuario);

//$itemdao->post($item);

print_r($itemdao->get(1));
echo "<br/>";
print_r($itemdao->getAll());
echo "<br/>";
print_r($itemdao->read('item'));
echo "<br/>";
//$itemdao->update($item);
//$itemdao->delete(1);
/*DAO ITEM*/


/*DAO TIPOITEM/
$tipoitemdao = new TipoItemDAO();

$tipoitem = new TipoItem();
$tipoitem->setTipo($tipo);
$tipoitem->setItem($item);

//$tipoitemdao->post($tipoitem);

print_r($tipoitemdao->get(2,1));
echo "<br/>";

print_r($tipoitemdao->getAll());
echo "<br/>";
print_r($tipoitemdao->read('Tipo45','item'));
echo "<br/>";
print_r($tipoitemdao->seek(1));
echo "<br/>";
/*DAO TIPOITEM*/


/*DAO EVENTO/
$eventodao = new EventoDAO();

$evento = new EventoDAO();
$evento = new Evento();
$evento->setId(4);
$evento->setNome('Churrascao do carai!');
$evento->setDescricao('Churrascao');
$evento->setData('06-05-2013');
$evento->setHora(date('H:i',mktime(13,10,0,0,0,0)));
$evento->setCep('38388122');
$evento->setEndereco('Rua dos negao, Yuri boiola');
$evento->setComplemento('Yuri Gay');
$evento->setCidade('Uberlandia');
$evento->setEstado('MG');
$evento->setTipo($tipo);
$evento->setUsuario($usuario);

//$eventodao->post($evento);

print_r($eventodao->get(4));
echo "<br/>";
print_r($eventodao->getAll());
echo "<br/>";
print_r($eventodao->read('Churrascao do carai!'));
echo "<br/>";
print_r($eventodao->seek(1));
echo "<br/>";

/*DAO EVENTO*/


/*DAO CONVIDADO/
$convidadodao = new ConvidadoDAO();

$convidado = new Convidado();
$convidado->setId(3);
$convidado->setSms('convida');
$convidado->setEmail('convidado_email');
$convidado->setFacebook('convidado_facebook');
$convidado->setTwitter('convidado_twitter');
$convidado->setEvento($evento);
$convidado->setUsuario($usuario);

//$convidadodao->post($convidado);

print_r($convidadodao->get(3));
echo "<br/>";
print_r($convidadodao->getAll());
echo "<br/>";
print_r($convidadodao->read(4));
echo "<br/>";
print_r($convidadodao->seek(1));
echo "<br/>";
/*DAO CONVIDADO*/

?>