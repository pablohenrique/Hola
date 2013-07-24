<?php
namespace Hola\DAO\postgresql;

use Hola\Model\Convidado,
	Hola\Model\Evento,
	Hola\Model\Item,
	Hola\Model\Tipo,
	Hola\Model\TipoItem,
	Hola\Model\Usuario;

require_once(__DIR__ . '/../../Autoloader.php');

/*Model TIPO/
$dao = new TipoDAO();
$tipo = new Tipo('Tipo');
$dao->post($tipo);
var_dump($dao->read('Tipo'));
var_dump($dao->getAll());
$dao->delete('Tipo');
echo "<br/><br/>";
/*Model TIPO*/

//9:22


/*Model Usuario/
$dao = new UsuarioDAO();
$usuario = new Usuario('fulano','senha','email@email.com','3412344321','oauthid','oauthprovider','toauthtoken','toauthtokensecret');
//$dao->post($usuario);
var_dump($usuario);
var_dump($dao->get('fulano'));
var_dump($dao->login('fulano','senha'));
var_dump($dao->getAll());
$usuario->setSenha('vaquinha');
$dao->update($usuario);
var_dump($dao->get('fulano'));
//$dao->delete('fulano');
echo "<br/><br/>";
/*Model Usuario*/



/*Model Item/
$dao = new ItemDAO();
$item = new Item('Item');
//$dao->post($item);
var_dump($dao->read('Item'));
var_dump($dao->getAll());
//$dao->delete('Item');
echo "<br/><br/>";
/*Model Item*/



/*Model TipoItem*/
$tipoitem = new TipoItem();

$tipoitem->setTipo($tipo);
$tipoitem->setItem($item);

echo $tipoitem->getTipo()->getId()."<br/>";
echo $tipoitem->getItem()->getId()."<br/>";
print_r($tipoitem->JsonSerialize());
echo "<br/><br/>";
/*Model TipoItem*/



/*Model Evento/
$dao = new EventoDAO();
$tipo = new Tipo('Tipo');
$usuario = new Usuario('fulano','senha','email@email.com','3412344321','oauthid','oauthprovider','toauthtoken','toauthtokensecret');
$evento = new Evento(null,'nome','descricao','2013-06-06','00:11','endereco','complemento','cidade','MG','33333111', $tipo, 0, $usuario);
var_dump($evento);
//$dao->post($evento);
var_dump($dao->get(1));
var_dump($dao->read('fulano','nome'));
var_dump($dao->seek('fulano',1));
var_dump($dao->getAll('fulano'));
$evento = $dao->get(1);
$evento->setDescricao('Georgia...');
//$dao->update($evento);
var_dump($dao->get(1));
//$dao->delete(1);
echo "<br/><br/>";
/*Model Evento*/



/*Model Convidados/
$dao = new ConvidadoDAO();
$tipo = new Tipo('Tipo');
$usuario = new Usuario('fulano','senha','email@email.com','3412344321','oauthid','oauthprovider','toauthtoken','toauthtokensecret');
$evento = new Evento(1,'nome','descricao','2013-06-06','00:11','endereco','complemento','cidade','MG','33333111', $tipo, 0, $usuario);
$convidado = new Convidado(null,'3443211234','mail@mail.com', '@twitter','#facebook',0,$evento, $usuario);
$dao->post($convidado);
var_dump($dao->get(1));
var_dump($dao->read(1));
var_dump($dao->seek('fulano'));
var_dump($dao->getAll());
$evento = $dao->get(1);
$evento->setTwitter('twitt');
//$dao->update($evento);
var_dump($dao->get(1));
//$dao->delete(1);
echo "<br/><br/>";
/**/






/*TEMPLATE*/

/*/
$ = new ();

$->set();

."<br/>";
print_r($->JsonSerialize());
echo "<br/><br/>";
/**/

?>