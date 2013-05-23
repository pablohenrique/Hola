<?php
    require_once (__DIR__ . '/../src/Hola/Autoloader.php');
    require_once (__DIR__ . 'setSession.php');

    $usuario = $_SESSION['user'];

    if(!is_null($usuario)){
        use Hola\Service\EventoService,
            Hola\Service\ConvidadoService;

        $eventoService = new EventoService();
        $convidadoService = new ConvidadoService();

        $user = json_encode($usuario);
        $evento = json_encode($eventoService->search($usuario->getLogin()));
        $convidado = json_encode($convidadoService->getUsuario($usuario->getLogin()));
    }
    else{
        header("Location: index.php");
        exit();
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
        <style>
            .livicon {
                display: inline-block;
                line-height: inherit;
                vertical-align: middle;
                height: 18px!important;
            }

            .container-fluid{
                margin-top: 5%;

            }

        </style>
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
                        <li class="active"><a href="#home" data-toggle="tab"><i class="livicon" data-n="home" data-s="15" data-c="#777" data-hc="white" data-op="1"></i>Home</a></li>
                        <li><a href="#eventos" data-toggle="tab"><i class="livicon" data-n="rocket" data-s="15" data-c="#777" data-hc="white" data-op="1"></i>Eventos</a></li>
                        <li><a href="#convites" data-toggle="tab"><i class="livicon" data-n="bell" data-s="15" data-c="#777" data-hc="white" data-op="1"></i>Convites</a></li>
                        <li><a href="#amigos" data-toggle="tab"><i class="livicon" data-n="users" data-s="15" data-c="#777" data-hc="white" data-op="1"></i>Amigos</a></li>
                        <li><a href="#listacompras" data-toggle="tab"><i class="livicon" data-n="list" data-s="15" data-c="#777" data-hc="white" data-op="1"></i>Lista de Compras</a></li>
                        <li><a href="#meucadastro" data-toggle="tab"><i class="livicon" data-n="user" data-s="15" data-c="#777" data-hc="white" data-op="1"></i>Cadastro</a></li>
                    </ul>
                    <ul class="nav pull-right">
                        <li><button type="submit" class="btn">@Usuario logout<span class="livicon shadowed" data-n="sign-out" data-s="15" data-c="black" data-hc="0" data-onparent="true"></span> </button></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span10">

                    <div class="tabbable"> 
                        <div class="tab-content">
                            <div class="tab-pane active" id="home">
                                <ul class="breadcrumb">
                                    <li class="active">Home</a> <span class="divider">/</span></li>
                                </ul>
                                <div class="hero-unit">
                                    <div class="well">
                                        <strong>Seus eventos</strong>
                                        <table class="table table-hover">
                                            <tr>
                                                <th>Evento</th>
                                                <th>Confirmações</th>
                                                <th><i class="livicon" data-n="edit" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></th>
                                                <th><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></th>
                                                <th><i class="livicon" data-n="plus" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></th>
                                            </tr>
                                            <tr>
                                                <td>Evento 1</td>
                                                <td><div class="progress">
                                                        <div class="bar bar-success" style="width: 35%;"></div>
                                                        <div class="bar bar-warning" style="width: 20%;"></div>
                                                        <div class="bar bar-danger" style="width: 10%;"></div>
                                                    </div></td>
                                                <td><i class="livicon" data-n="edit" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td> <a href="#mais" data-toggle="modal"> <i class="livicon" data-n="plus" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>Evento 2</td>
                                                <td><div class="progress">
                                                        <div class="bar bar-success" style="width: 50%;"></div>
                                                        <div class="bar bar-warning" style="width: 22%;"></div>
                                                        <div class="bar bar-danger" style="width: 15%;"></div>
                                                    </div></td>
                                                <td><i class="livicon" data-n="edit" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td> <a href="#mais" data-toggle="modal"> <i class="livicon" data-n="plus" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></a></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="well">
                                        <strong>Seus Convites</strong>
                                        <table class="table table-hover">
                                            <tr>
                                                <th>Evento</th>
                                                <th><i class="livicon" data-n="checked-on" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></th>
                                                <th><i class="livicon" data-n="checked-off" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></th>
                                                <th><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></th>
                                                <td> <a href="#mais" data-toggle="modal"> <i class="livicon" data-n="plus" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></a></td>
                                            </tr>
                                            <tr class="success">
                                                <td>Evento 1</td>
                                                <td><i class="livicon" data-n="checked-on" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="checked-off" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td> <a href="#mais" data-toggle="modal"> <i class="livicon" data-n="plus" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></a></td>
                                            </tr>
                                            <tr class="warning">
                                                <td>Evento 2</td>
                                                <td><i class="livicon" data-n="checked-on" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="checked-off" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td> <a href="#mais" data-toggle="modal"> <i class="livicon" data-n="plus" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></a></td>
                                            <tr class="info">
                                                <td>Evento 3</td>
                                                <td><i class="livicon" data-n="checked-on" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="checked-off" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td> <a href="#mais" data-toggle="modal"> <i class="livicon" data-n="plus" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></a></td>
                                            </tr>
                                            <tr class="success">
                                                <td>Evento 4</td>
                                                <td><i class="livicon" data-n="checked-on" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="checked-off" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td> <a href="#mais" data-toggle="modal"> <i class="livicon" data-n="plus" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></a></td>
                                            </tr>
                                            <tr class="error">
                                                <td>Evento 5</td>
                                                <td><i class="livicon" data-n="checked-on" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="checked-off" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td> <a href="#mais" data-toggle="modal"> <i class="livicon" data-n="plus" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></a></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="eventos">
                                <ul class="breadcrumb">
                                    <li><a href="#home">Home</a> <span class="divider">/</span></li>
                                    <li class="active">Eventos</a> <span class="divider">/</span></li>
                                </ul>
                                <div class="hero-unit">
                                    <div class="well">
                                        <strong>Seus eventos</strong>
                                        <a href="#cadastrar"  class="btn btn-success pull-right " data-toggle="modal" ><span class="livicon shadowed" data-n="plus-alt" data-s="15" data-c="white" data-hc="0" data-onparent="true"></span>
                                            Cadastrar Evento
                                        </a>
                                        <table class="table table-hover">
                                            <tr>
                                                <th>Evento</th>
                                                <th>Confirmações</th>
                                                <th><i class="livicon" data-n="edit" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></th>
                                                <th><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></th>
                                                <th><i class="livicon" data-n="plus" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></th>
                                            </tr>
                                            <tr>
                                                <td>Evento 1</td>
                                                <td><div class="progress">
                                                        <div class="bar bar-success" style="width: 35%;"></div>
                                                        <div class="bar bar-warning" style="width: 20%;"></div>
                                                        <div class="bar bar-danger" style="width: 10%;"></div>
                                                    </div></td>
                                                <td><i class="livicon" data-n="edit" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="plus" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Evento 2</td>
                                                <td><div class="progress">
                                                        <div class="bar bar-success" style="width: 50%;"></div>
                                                        <div class="bar bar-warning" style="width: 22%;"></div>
                                                        <div class="bar bar-danger" style="width: 15%;"></div>
                                                    </div></td>
                                                <td><i class="livicon" data-n="edit" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="plus" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane" id="convites">
                                <ul class="breadcrumb">
                                    <li><a href="#home">Home</a> <span class="divider">/</span></li>
                                    <li class="active">Eventos</a> <span class="divider">/</span></li>
                                </ul>
                                <div class="hero-unit">
                                    <div class="well">
                                        <strong>Seus Convites</strong>
                                        <table class="table table-hover">
                                            <tr>
                                                <th>Evento</th>
                                                <th><i class="livicon" data-n="checked-on" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></th>
                                                <th><i class="livicon" data-n="checked-off" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></th>
                                                <th><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></th>
                                                <td> <a href="#mais" data-toggle="modal"> <i class="livicon" data-n="plus" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></a></td>
                                            </tr>
                                            <tr class="success">
                                                <td>Evento 1</td>
                                                <td><i class="livicon" data-n="checked-on" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="checked-off" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td> <a href="#mais" data-toggle="modal"> <i class="livicon" data-n="plus" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></a></td>
                                            </tr>
                                            <tr class="warning">
                                                <td>Evento 2</td>
                                                <td><i class="livicon" data-n="checked-on" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="checked-off" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td> <a href="#mais" data-toggle="modal"> <i class="livicon" data-n="plus" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></a></td>
                                            <tr class="info">
                                                <td>Evento 3</td>
                                                <td><i class="livicon" data-n="checked-on" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="checked-off" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td> <a href="#mais" data-toggle="modal"> <i class="livicon" data-n="plus" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></a></td>
                                            </tr>
                                            <tr class="success">
                                                <td>Evento 4</td>
                                                <td><i class="livicon" data-n="checked-on" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="checked-off" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td> <a href="#mais" data-toggle="modal"> <i class="livicon" data-n="plus" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></a></td>
                                            </tr>
                                            <tr class="error">
                                                <td>Evento 5</td>
                                                <td><i class="livicon" data-n="checked-on" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="checked-off" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td> <a href="#mais" data-toggle="modal"> <i class="livicon" data-n="plus" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></a></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="amigos">
                                <ul class="breadcrumb">
                                    <li class="active">Home</a> <span class="divider">/</span></li>
                                </ul>
                                <div class="hero-unit">
                                    <div class="well">
                                        <strong>Seus Amigos</strong><a href="#cadastrar"  class="btn btn-success pull-right " data-toggle="modal" ><span class="livicon shadowed" data-n="plus-alt" data-s="15" data-c="white" data-hc="0" data-onparent="true"></span>
                                            Adicionar Amigo
                                        </a>
                                        <table class="table table-hover">
                                            <tr>
                                                <th>Amigo</th>
                                                <th><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></th>
                                            </tr>
                                            <tr>
                                                <td>Amigo 1</td>
                                                <td><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Amigo 2</td>
                                                <td><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                        </table>
                                    </div>

                                    <div class="well">
                                        <strong>Solicitações Pendentes</strong>
                                        <table class="table table-hover">
                                            <tr>
                                                <th>Amigo</th>
                                                <th><i class="livicon" data-n="checked-on" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></th>
                                                <th><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></th>
                                            </tr>
                                            <tr>
                                                <td>Amigo 1</td>
                                                <td><i class="livicon" data-n="checked-on" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Amigo 2</td>
                                                <td><i class="livicon" data-n="checked-on" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="remove" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="listacompras">
                                <ul class="breadcrumb">
                                    <li class="active">Home</a> <span class="divider">/</span></li>
                                </ul>
                                <div class="hero-unit">
                                    <div class="well">
                                        <strong>Suas Compras</strong>
                                        <table class="table table-hover">
                                            <tr>
                                                <th>Item</th>
                                                <th>Quantidade</th>
                                                <th>Evento</th>
                                                <th><i class="livicon" data-n="checked-on" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></th>
                                                <th><i class="livicon" data-n="checked-off" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></th>
                                            </tr>
                                            <tr class="success">
                                                <td>Item 1</td>
                                                <td>1</td>
                                                <td>Evento 1</td>
                                                <td><i class="livicon" data-n="checked-on" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="checked-off" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                            </tr>
                                            <tr class="error">
                                                <td>Item 2</td>
                                                <td>1</td>
                                                <td>Evento 1</td>
                                                <td><i class="livicon" data-n="checked-on" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                                <td><i class="livicon" data-n="checked-off" data-s="25" data-c="#777" data-hc="#333" data-op="1"></i></td>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="meucadastro">
                                <ul class="breadcrumb">
                                    <li><a href="home.html">Home</a> <span class="divider">/</span></li>
                                    <li><a href="eventos.html">Eventos</a> <span class="divider">/</span></li>
                                    <li class="active">Cadastrar Evento</a> <span class="divider">/</span></li>
                                </ul>
                                <div class="hero-unit">
                                    <div class="well">
                                        <form>
                                            <fieldset>
                                                <legend>Meu Cadastro</legend>
                                                <label>Nome</label>
                                                <input type="text" placeholder="Entre com nome do evento…">
                                                <label>E-mail</label>
                                                <input type="text" placeholder="Entre com o email…">
                                                <p><button type="submit" class="btn">Salvar</button></p>
                                            </fieldset>
                                        </form>


                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>



                </div>
                <div class="span2">
                    <p>Side-bar destinada a ADS</p>
                </div>
            </div>
        </div>


        <div id="mais" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Mais Informações</h3>
            </div>
            <div class="modal-body">
                <legend>Nome do Evento 
                    <div class="btn-group pull-right">
                        <button class="btn dropdown-toggle" data-toggle="dropdown">Opções <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Editar</a></li>
                            <li><a href="#">Apagar</a></li>

                        </ul>
                    </div><!-- /btn-group -->
                    <div class="btn-group pull-right">
                        <button class="btn dropdown-toggle" data-toggle="dropdown">Irá comparecer? <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <li><a href="#">Sim</a></li>
                            <li><a href="#">Não</a></li>
                            <li><a href="#">Talvez</a></li>
                        </ul>
                    </div>

                </legend>
                <p>Data Início: 10/10/2010</p>
                <p>Hora Início: 22:30</p>
                <p>Data Fim: 10/10/2010</p>
                <p>Hora Fim: 22:30</p>
                <address>
                    Endereço<br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                </address>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
            </div>
        </div>

        <div id="cadastrar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form>
                    <fieldset>
                        <legend>Cadastrar Evento</legend>
                        <label>Nome</label>
                        <input type="text" placeholder="Entre com nome do evento…">
                        <label>Data Início</label>
                        <input type="text" class="span2"  id="dp1" >
                        <label>Hora Início</label>
                        <div class="input-append bootstrap-timepicker">
                            <input id="timepicker1" type="text" class="input-small">
                            <span class="add-on"><i class="icon-time"></i></span></div>
                        <script type="text/javascript">
                            $('#timepicker1').timepicker();
                        </script>
                        <label>Data Fim</label>
                        <input type="text" class="span2"  id="dp2" >
                        <div class="input-append bootstrap-timepicker"></div>
                        <label>Hora Fim</label>
                        <div class="input-append bootstrap-timepicker">
                            <input id="timepicker2" type="text" class="input-small">
                            <span class="add-on"><i class="icon-time"></i></span></div>
                        <script type="text/javascript">
                            $('#timepicker2').timepicker();
                        </script>
                        <label>CEP</label>
                        <input type="text" placeholder="Entre com o CEP…">
                        <label>UF</label>
                        <input type="text" placeholder="Entre com o estado…">
                        <label>Cidade</label>
                        <input type="text" placeholder="Entre com a cidade…">
                        <label>Endereço</label>
                        <input type="text" placeholder="Entre com o endereço…">
                        <label>Complemento</label>
                        <input type="text" placeholder="Entre com o complemento…">
                    </fieldset>
                </form>

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
                <button class="btn btn-primary">Próximo Passo</button>
            </div>
        </div>



        <script src="js/jquery-1.9.1.js" type="text/javascript"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <script src="js/raphael.js" type="text/javascript"></script>
        <script src="js/livicons-1.1.js" type="text/javascript"></script>
        <!--[if lt IE 8]>
                <script src="json2.min.js" type="text/javascript"></script>
            <![endif]-->
        <script src="js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="js/bootstrap-timepicker.js"></script>
        <script>
                            $(function() {
                                window.prettyPrint && prettyPrint();
                                $('#dp1').datepicker({
                                    format: 'dd-mm-yyyy'
                                });
                                $('#dp2').datepicker({
                                    format: 'dd-mm-yyyy'
                                });

                                $('#dpYears').datepicker();
                                $('#dpMonths').datepicker();




                                // disabling dates
                                var nowTemp = new Date();
                                var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

                                var checkin = $('#dpd1').datepicker({
                                    onRender: function(date) {
                                        return date.valueOf() < now.valueOf() ? 'disabled' : '';
                                    }
                                }).on('changeDate', function(ev) {
                                    if (ev.date.valueOf() > checkout.date.valueOf()) {
                                        var newDate = new Date(ev.date)
                                        newDate.setDate(newDate.getDate() + 1);
                                        checkout.setValue(newDate);
                                    }
                                    checkin.hide();
                                    $('#dpd2')[0].focus();
                                }).data('datepicker');
                                var checkout = $('#dpd2').datepicker({
                                    onRender: function(date) {
                                        return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
                                    }
                                }).on('changeDate', function(ev) {
                                    checkout.hide();
                                }).data('datepicker');
                            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {


                $('#timepicker1').timepicker({
                    minuteStep: 5,
                    showInputs: false,
                    disableFocus: true
                });

                $('#timepicker2').timepicker({
                    minuteStep: 5,
                    showInputs: false,
                    disableFocus: true
                });

            });
        </script>
    </body>