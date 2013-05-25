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

    #
    #   @ ATENCAAAAAAAAAOO! @
    #
    #   Para usar essas variaveis , basta usar esse exemplo:
    #

    /*
    <script type="text/javascript">
        var require = {
            config: {
                "app": {
                    loggedUser:   <?php echo($user);  ?>,
                    evento:       <?php echo($evento); ?>,
                    convidado:    <?php echo($convidado); ?>
                    tipo:         <?php echo($tipo); ?>
                    item:         <?php echo($item); ?>
                }
            }
        }
    </script>
    */
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


        <script src="js/jquery-2.0.0.js" type="text/javascript"></script>
        <script src="js/underscore.js" type="text/javascript"></script>
        <script src="js/backbone.js" type="text/javascript"></script>
        <script src="js/raphael.js" type="text/javascript"></script>
        <script src="js/livicons-1.1.js" type="text/javascript"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <!--[if lt IE 8]>
                <script src="json2.min.js" type="text/javascript"></script>
            <![endif]-->
        <!-- INICIO SCRIPT CADASTRO USUARIO USANDO BACKBONE -->
        

        <script>

        function require_template(templateName) {
    var template = $('#template_' + templateName);
    if (template.length === 0) {
        var tmpl_dir = 'template';
        var tmpl_url = tmpl_dir + '/' + templateName + '.tmpl';
        var tmpl_string = '';

        $.ajax({
            url: tmpl_url,
            method: 'GET',
            async: false,
            contentType: 'text',
            success: function (data) {
                tmpl_string = data;
            }
        });

        $('head').append('<script id="template_' + 
        templateName + '" type="text/template">' + tmpl_string + '<\/script>');
    }
}

require_template('IndexView');
require_template('CadastroUsuarioView');
require_template('ErroLoginView');
require_template('HomeView');
require_template('LoginView');

            $.fn.serializeObject = function() {
                var o = {};
                var a = this.serializeArray();
                $.each(a, function() {
                    if (o[this.name] !== undefined) {
                        if (!o[this.name].push) {
                            o[this.name] = [o[this.name]];
                        }
                        o[this.name].push(this.value || '');
                    } else {
                        o[this.name] = this.value || '';
                    }
                });
                return o;
            };

            $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
                options.url = '/Hola/api/' + options.url;
            });


            var Usuario = Backbone.Model.extend({
                urlRoot: 'usuario/',
            });
            var UsuarioLogin = Backbone.Model.extend({
                urlRoot: '/',
            });

            var CadastrarUsuario = Backbone.View.extend({
                el: '.page',
                render: function() {
                    var template = _.template($('#template_CadastroUsuarioView').html(), {});
                    this.$el.html(template);
                },
                events: {
                    'submit .cadastrar-usuario-form': 'salvarUsuario',
                },
                salvarUsuario: function(ev) {
                    var dadosUsuario = $(ev.currentTarget).serializeObject();
                    var usuario = new Usuario();
                    usuario.save(dadosUsuario, {
                        success: function(usuario) {
                            router.navigate('', {trigger: true});
                        }
                    });
                    return false;
                }
            });

            var Home = Backbone.View.extend({
                el: '.page',
                render: function() {
                    var template = _.template($('#template_IndexView').html(), {});
                    this.$el.html(template);
                },
            });

            var UsuarioLogado = Backbone.View.extend({
                el: '.page',
                render: function() {
                    var template = _.template($('#template_HomeView').html(), {});
                    this.$el.html(template);
                },
            });

            var DadosErrados = Backbone.View.extend({
                el: '.page',
                render: function() {
                    var template = _.template($('#template_ErroLoginView').html(), {});
                    this.$el.html(template);
                },
            });            

            var Logar = Backbone.View.extend({
                el: '.page',
                render: function() {
                    var template = _.template($('#template_LoginView').html(), {});
                    this.$el.html(template);
                },
            });

        



            var Router = Backbone.Router.extend({
                routes: {
                    '': 'home',
                    'cadastrar': 'cadastrarUsuario',
                    'sucesso': 'sucesso',
                    'logar': 'logarUsuario',
                    'logado': 'usuarioLogado',
                    'errado': 'dadosErrados',
                }
            });
            var cadastrarUsuario = new CadastrarUsuario();
            var logarUsuario = new Logar();
            var usuarioLogado = new UsuarioLogado();
            var router = new Router();
            var home = new Home();
            var dadosErrados = new DadosErrados();
            router.on('route:home', function() {
                var usr = JSON.parse(<?php echo json_encode($user); ?>);

                
                if(usr == "" || usr == null){
                    home.render();
                    console.log('erro');

                } else{
                    usuarioLogado.render();
                    console.log('sucesso');
                    console.log(usr);
                }
            });
            router.on('route:cadastrarUsuario', function() {
                cadastrarUsuario.render();
            });
            router.on('route:logarUsuario', function() {
                logarUsuario.render();
            });
            router.on('route:usuarioLogado', function() {
                usuarioLogado.render();
            });
            router.on('route:dadosErrados', function() {
                dadosErrados.render();
            });

            Backbone.history.start();
        </script>
    </body>
