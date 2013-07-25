<?php
    require_once (__DIR__ . '/../src/Hola/Autoloader.php');

    use Hola\Service\UsuarioService;

    session_start();
    
    if( isset($_POST['login']) && isset($_POST['senha']) ) {
        $usuarioService = new UsuarioService();
        $_SESSION['user'] = $usuarioService->login($_POST['login'],$_POST['senha']);
        if(is_null($_SESSION['user'])){
            header("Location: /Hola/index.php?erro");
            exit();
        }
        $user = json_encode($_SESSION['user']);
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
        <link rel="stylesheet" type="text/css"href="css/app.min.css">
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
        <script src="js/app.min.js?random=<?php echo uniqid(); ?>"></script>
        <script type="text/javascript">
        </script>



        
    </body>
</html>