<?php
    require_once (__DIR__ . '/../src/Hola/Autoloader.php');

    use Hola\Service\EventoService,
        Hola\Service\ConvidadoService,
        Hola\Service\TipoItemService,
        Hola\Service\TipoService,
        Hola\Service\ItemService,
        Hola\Service\UsuarioService,
        Hola\Model\Usuario;

    session_start();
    
    if( isset($_POST['login']) && isset($_POST['senha']) ) {
        /*
        $eventoService = new EventoService();
        $convidadoService = new ConvidadoService();
        $tipoService = new TipoService();
        $itemService = new ItemService();
        */
        $usuarioService = new UsuarioService();
        $_SESSION['user'] = $usuarioService->login($_POST['login'],$_POST['senha']);
        if(is_null($_SESSION['user'])){
            header("Location: /Hola/index.php?erro");
            exit();
        }

        /*
        $_SESSION['event'] = $eventoService->search($usuario->getLogin());
        $_SESSION['invitation'] = $convidadoService->getUsuario($usuario->getLogin());
        $_SESSION['type'] = $tipoService->search();
        $_SESSION['items'] = $itemService->search();

        unset($eventoService,$convidadoService,$tipoService,$itemService);
        */
        $user = json_encode($_SESSION['user']);
        /*
        $evento = json_encode($_SESSION['event']);
        $convidado = json_encode($_SESSION['invitation']);
        $tipo = json_encode($_SESSION['type']);
        $item = json_encode($_SESSION['items']);
        */
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
        <div class="top">
        </div>
        <div class="main">
        </div>
        <div class="extra">
        </div>
        </div>
        <script type="text/javascript">
        try{
            var usrLog = JSON.parse(<?php if(isset($user)) echo json_encode($user); ?>);
        }
        catch(Exception){
            var usrLog = null;
        }

        
       </script>
        <script src="js/jquery-2.0.0.js" type="text/javascript"></script>
        <script src="js/underscore.js" type="text/javascript"></script>
        <script src="js/backbone.js" type="text/javascript"></script>
        <script src="js/raphael.js" type="text/javascript"></script>
        <script src="js/livicons-1.1.js" type="text/javascript"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <script src="js/main.js" type="text/javascript"></script>
        <script type="text/javascript">
        </script>



        
    </body>
</html>