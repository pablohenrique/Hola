<?php
namespace Hola\Service;

require_once(__DIR__ . '/../Autoloader.php');

/*DAO TIPO/
$tipo = new TipoService();

//$tipo->post('tipo');
echo "<br/>";
$tipo->search(1);
echo "<br/>";
$tipo->search('tipo');
echo "<br/>";
print_r($tipo->search());
echo "<br/>";
$tipo->update('tipo2',1);
echo "<br/>";
$tipo->delete(2);
/*DAO TIPO*/

/*DAO USUARIO/
$usuario = new UsuarioService();
//$usuario->post('fulano','senha','email@email.com','3412344321','oauthid','oauthprovider','toauthtoken','toauthtokensecret');
echo "<br/>";
print_r($usuario->search(1));
echo "<br/>";
print_r($usuario->search('fulano'));
echo "<br/>";
print_r($usuario->search());
echo "<br/>";
//$usuario->update('fulano','senha','email@email.com','3412344321','oauthid','oauthprovider','toauthtoken','toauthtokensecret',1);
echo "<br/>";
$usuario->delete(1);
echo "<br/>";
/*DAO USUARIO*/


/*DAO ITEM/
$item = new ItemService();

//$item->post('item',1,1);

print_r($item->search(1));
echo "<br/>";
print_r($item->search('item2'));
echo "<br/>";
print_r($item->search());
echo "<br/>";
$item->update('item2',1,1);
$item->delete(1);
/*DAO ITEM*/


/*DAO TIPOITEM/
$tipoitem = new TipoItemService();

//$tipoitem->post(1,1);
echo "<br/>";
print_r($tipoitem->search(1,1));
echo "<br/>";
print_r($tipoitem->search('tipo2','item2'));
echo "<br/>";
print_r($tipoitem->search(1));
echo "<br/>";
print_r($tipoitem->search());
echo "<br/>";
/*DAO TIPOITEM*/


/*DAO EVENTO/
$evento = new EventoService();
//$evento->post('Churrascao do carai','Churrascao','06-05-2013',date('H:i',mktime(13,10,0,0,0,0)),'Rua dos negao','Yuri Gay','Uberlandia','MG','38388122',1,1);

print_r($evento->search(1));
echo "<br/>";
print_r($evento->search('Churrascao do carai!'));
echo "<br/>";
print_r($evento->getUsuario(1));
echo "<br/>";
print_r($evento->search());
echo "<br/>";
//$evento->update('Churrascao2!','Churrascao','06-05-2013',date('H:i',mktime(15,10,0,0,0,0)), 'Rua dos negao, Yuri boiola','Yuri Gay','Uberlandia','MG','38388122',1,1,1);
echo "<br/>";
$evento->delete(1);
echo "<br/>";
/*DAO EVENTO*/


/*DAO CONVIDADO/
$convidado = new ConvidadoService();
//$convidado->post('43211234','convidado_email',1,1,'convidado_twitter','convidado_facebook');

print_r($convidado->search(1));
echo "<br/>";
print_r($convidado->getEvento(1));
echo "<br/>";
print_r($convidado->getUsuario(1));
echo "<br/>";
print_r($convidado->search());
echo "<br/>";
$convidado->update('convidado','convidado_email',1,1,'convidado_twitter','convidado_facebook',1);
echo "<br/>";
$convidado->delete(1);
echo "<br/>";
/*DAO CONVIDADO*/

?>