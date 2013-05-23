<?php
    require_once (__DIR__ . '/../src/Hola/Autoloader.php');    
    require_once (__DIR__ . '/setSession.php');

    use Hola\Service\EventoService,
        Hola\Service\ConvidadoService,
        Hola\Service\TipoItemService,
        Hola\Service\TipoService,
        Hola\Service\ItemService;

    $usuario = $_SESSION['user'];

    if(!is_null($usuario)){
        $eventoService = new EventoService();
        $convidadoService = new ConvidadoService();
        $tipoService = new TipoService();
        $itemService = new ItemService();

        $user = json_encode($usuario);
        $evento = json_encode($eventoService->search($usuario->getLogin()));
        $convidado = json_encode($convidadoService->getUsuario($usuario->getLogin()));
        $tipo = json_encode($tipoService->search());
        $item = json_encode($itemService->search());

        unset($eventoService,$convidadoService,$tipoService,$itemService);
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
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="brand" href="#">Reunião</a>
                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <li class="active"><a href="#"><i class="livicon" data-n="home" data-s="15" data-c="#777" data-hc="white" data-op="1"></i>Home</a></li>
                        <li><a href="#contato"><i class="livicon" data-n="mail" data-s="15" data-c="#777" data-hc="white" data-op="1"></i>Contato</a></li>
                        <li><a href="#sobre"><i class="livicon" data-n="doc-portrait" data-s="15" data-c="#777" data-hc="white" data-op="1"></i>Sobre</a></li>
                    </ul>
                    <!-- LOGIN DE USUARIO -->
                    <form class="navbar-form pull-right">
                        <a href="#" role="button"><i class="livicon" data-n="facebook-alt" data-s="25" data-c="#777" data-hc="white" data-op="1"></i>
                            <a href="#" role="button"><i class="livicon" data-n="twitter-alt" data-s="25" data-c="#777" data-hc="white" data-op="1"></i>
                            </a>
                            <input type="text" class="input" placeholder="Email">
                            <input type="password" class="input-small" placeholder="Senha">
                            <button type="submit" class="btn" href="#/cadastrar"><span class="livicon shadowed" data-n="sign-in" data-s="15" data-c="black" data-hc="0" data-onparent="true"></span>Login </button>
                            <a href="#/cadastrar"  class="btn" ><span class="livicon shadowed" data-n="pen" data-s="15" data-c="black" data-hc="0" data-onparent="true"></span>
                                Cadastrar
                            </a>
                            </ul>
                    </form>
                    <!-- FIM DO LOGIN -->
                </div> 
            </div>
        </div>
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
        <script type="text/template" id="home-template">
<div id="myCarousel" class="carousel slide">
    <div class="carousel-inner">
        <div class="item active">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Example headline.</h1>
                    <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <a class="btn btn-large btn-primary" href="#">Sign up today</a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Another example headline.</h1>
                    <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <a class="btn btn-large btn-primary" href="#">Learn more</a>
                </div>
            </div>
        </div>
    </div>


</div>
</div>
<!-- FIM DA DIV PARA CAROUSEL -->

<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>

        </script>



        <script type="text/template" id="cadastrar-usuario-template">
<!-- DIV PARA CAROUSEL -->
<div class="row">
    <div class="span7 offset1">
        <div id="myCarousel" class="carousel slide">
            <div class="carousel-inner">
                <div class="item active">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Example headline.</h1>
                            <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            <a class="btn btn-large btn-primary" href="#">Sign up today</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>Another example headline.</h1>
                            <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                            <a class="btn btn-large btn-primary" href="#">Learn more</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
</div>
<div class = "row">
    <div class="span3 offset10" style="margin-top : -35%; position:absolute;"><div class="pull-left">        <div class = "well">
                <form class="cadastrar-usuario-form" method="post">
                    <legend>Cadastrar Usuarios</legend>
                    <label>Login</label>
                    <input name="login" id="login" type="text">
                    <label>E-mail</label>
                    <input name="email" id="email" type="text">
                    <label>Celular</label>
                    <input name="celular" id="celular" type="text">
                    <label>Senha</label>
                    <input name="senha" id="senha" type="password">
                    <hr />
                    <button type="submit" class="btn">Salvar</button>
                </form>
            </div></div> </div></div>
<!-- FIM DA DIV PARA CAROUSEL -->

<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
        </script>

        <!-- FIM DO SCRIPT CADASTRO USUARIO USANDO BACKBONE -->

        <script type="text/template" id="sucesso-template">
            <p> Seu cadastro foi efetivado com sucesso</p>
        </script>
        <script>

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

            var CadastrarUsuario = Backbone.View.extend({
                el: '.page',
                render: function() {
                    var template = _.template($('#cadastrar-usuario-template').html(), {});
                    this.$el.html(template);
                },
                events: {
                    'submit .cadastrar-usuario-form': 'salvarUsuario',
                },
                salvarUsuario: function(ev) {
                    var dadosUsuario = $(ev.currentTarget).serializeObject();
                    var usuario = new Usuario();
                    console.log(dadosUsuario);
                    usuario.save(dadosUsuario, {
                        success: function(usuario) {
                            router.navigate('', {trigger: true});
                        }
                    });
                    return false;
                }
            });

            var Sucesso = Backbone.View.extend({
                el: '.page',
                render: function() {
                    var template = _.template($('#sucesso-template').html(), {});
                    this.$el.html(template);
                },
            });

            var Home = Backbone.View.extend({
                el: '.page',
                render: function() {
                    var template = _.template($('#home-template').html(), {});
                    this.$el.html(template);
                },
            });


            var Router = Backbone.Router.extend({
                routes: {
                    '': 'home',
                    'cadastrar': 'cadastrarUsuario',
                    'sucesso': 'sucesso',
                }
            });
            var cadastrarUsuario = new CadastrarUsuario();
            var sucesso = new Sucesso();
            var router = new Router();
            var home = new Home();
            router.on('route:home', function() {
                home.render();
            });
            router.on('route:sucesso', function() {
                sucesso.render();
            });
            router.on('route:cadastrarUsuario', function() {
                cadastrarUsuario.render();
            });




            Backbone.history.start();
        </script>
    </body>
