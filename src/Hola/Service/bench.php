<?php
namespace Hola\Service;

require_once(__DIR__ . '/../Autoloader.php');


$evento = new EventoService();

$evento->search(1);

?>