<?php
require_once (__DIR__ . '/../src/Hola/Autoloader.php');

session_start();
session_destroy();

header("Location: index.php");
exit();

?>