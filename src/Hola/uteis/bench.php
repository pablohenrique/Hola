<?php
namespace Hola\Model;

require_once(__DIR__ . '/../Autoloader.php');

/*Model TIPO*/
$tipo = new Tipo();

$tipo->setId(1);
$tipo->setNome('Tipo');

echo $tipo->getId() . "<br/>";
echo $tipo->getNome() . "<br/>";
print_r($tipo->JsonSerialize());
echo "<br/><br/>";
/*Model TIPO*/



/*Model Usuario*/
$usuario = new Usuario();

$usuario->setId(1);
$usuario->setLogin('fulano');
$usuario->setSenha('senha');
$usuario->setEmail('email@email.com');
$usuario->setCelular('(34)1234-4321');
$usuario->setOauthId('oauthid');
$usuario->setOauthProvider('oauthprovider');
$usuario->setTwitterOauthToken('toauthtoken');
$usuario->setTwitterOauthTokenSecret('toauthtokensecret');

echo $usuario->getId()."<br/>";
echo $usuario->getLogin()."<br/>";
echo $usuario->getSenha()."<br/>";
echo $usuario->getEmail()."<br/>";
echo $usuario->getCelular()."<br/>";
echo $usuario->getOauthId()."<br/>";
echo $usuario->getOauthProvider()."<br/>";
echo $usuario->getTwitterOauthToken()."<br/>";
echo $usuario->getTwitterOauthTokenSecret()."<br/>";
print_r($usuario->JsonSerialize());
echo "<br/><br/>";
/*Model Usuario*/



/*Model Item*/
$item = new Item();

$item->setId(1);
$item->setNome('coca');
$item->setUsuario($usuario);

echo $item->getId() . "<br/>";
echo $item->getNome() . "<br/>";
echo $item->getUsuario()->getId() . "<br/>";
print_r($item->JsonSerialize());
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



/*Model Evento*/
$evento = new Evento();

$evento->setId(1);
$evento->setNome('nome');
$evento->setDescricao('descricao');
$evento->setData('00/01/1234');
$evento->setHora('00:11');
$evento->setEndereco('endereco');
$evento->setComplemento('complemento');
$evento->setCidade('cidade');
$evento->setEstado('estado');
$evento->setCep('33.333-111');
$evento->setTipo($tipo);
$evento->setUsuario($usuario);

echo $evento->getId() . "<br/>";
echo $evento->getNome() . "<br/>";
echo $evento->getDescricao() . "<br/>";
echo $evento->getData() . "<br/>";
echo $evento->getHora() . "<br/>";
echo $evento->getEndereco() . "<br/>";
echo $evento->getComplemento() . "<br/>";
echo $evento->getCidade() . "<br/>";
echo $evento->getEstado() . "<br/>";
echo $evento->getCep() . "<br/>";
echo $evento->getTipo()->getNome() . "<br/>";
echo $evento->getUsuario()->getLogin() . "<br/>";
print_r($evento->JsonSerialize());
echo "<br/><br/>";
/*Model Evento*/



/**/
$convidado = new Convidados();
$convidado->setId(1);
$convidado->setSms('(34)4321-1234');
$convidado->setEmail('mail@mail.com');
$convidado->setEvento($evento);
$convidado->setUsuario($usuario);
$convidado->setTwitter('@twitter');
$convidado->setFacebook('#facebook');

echo $convidado->getId()."<br/>";
echo $convidado->getSms()."<br/>";
echo $convidado->getEmail()."<br/>";
echo $convidado->getEvento()->getNome()."<br/>";
echo $convidado->getUsuario()->getLogin()."<br/>";
echo $convidado->getTwitter()."<br/>";
echo $convidado->getFacebook()."<br/>";

print_r($convidado->JsonSerialize());
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