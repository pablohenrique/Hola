<?php
    require_once (__DIR__ . '/../src/Hola/Autoloader.php');    
    require_once (__DIR__ . '/setSession.php');

    use Hola\Service\EventoService,
        Hola\Service\ConvidadoService,
        Hola\Service\TipoItemService,
        Hola\Service\TipoService,
        Hola\Service\ItemService,
        #Hola\DAO\Exception,
        Hola\Model\Usuario,
        Hola\Service\UsuarioService;

    if( isset($_POST['login']) && isset($_POST['senha']) ) {
        $service = new UsuarioService();
        $eventoService = new EventoService();
        $convidadoService = new ConvidadoService();
        $tipoService = new TipoService();
        $itemService = new ItemService();

        session_start();

        $usuario = $service->login($_POST['login'],$_POST['senha']);
        if(is_null($usuario)){
            header("Location: /Hola/#/logar");
            exit();
        }
        $_SESSION['user'] = $usuario;

        $user = json_encode($usuario);
        $evento = json_encode($eventoService->search($usuario->getLogin()));
        $convidado = json_encode($convidadoService->getUsuario($usuario->getLogin()));
        $tipo = json_encode($tipoService->search());
        $item = json_encode($itemService->search());
    }

?>

<!DOCTYPE html>
<html lang="pt-BR">
    <meta charset="utf-8">
    <head>
        <title>Reunião</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="stylesheet" type="text/css"href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
        <link rel="stylesheet" type="text/css" href="css/carousel.css">
        <link rel="stylesheet" type="text/css" href="css/liviconpadrao.css">
    </head>
    <body>

        <div class="page">
        </div>
        <script type="text/javascript">
        var usrLog = JSON.parse(<?php echo json_encode($user); ?>);
       </script>
        <script src="js/jquery-2.0.0.js" type="text/javascript"></script>
        <script src="js/underscore.js" type="text/javascript"></script>
        <script src="js/backbone.js" type="text/javascript"></script>
        <script src="js/raphael.js" type="text/javascript"></script>
        <script src="js/livicons-1.1.js" type="text/javascript"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>



        
    </body>
