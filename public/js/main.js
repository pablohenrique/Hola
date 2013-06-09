function htmlEncode(value){
      return $('<div/>').text(value).html();
    }


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
require_template('LoginView');
require_template('HomeView');
require_template('ErroLoginView');
require_template('MeuCadastroView');
require_template('AmigosView');
require_template('ConvitesView');
require_template('EventosView');
require_template('ListaComprasView');



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
                options.url = '/Hola/api' + options.url;
            });


            var Usuario = Backbone.Model.extend({
                urlRoot: '/usuario',
            });
            var UsuarioLogin = Backbone.Model.extend({
                urlRoot: '/',
            });
            var uid;


            var EventosConvidado = Backbone.Collection.extend({
                url : function() {
                return '/' + uid + '/convidado/';
             }
            });

            var EventosOrganizado = Backbone.Collection.extend({
                url : function() {
                return '/' + uid + '/evento/';
             }
            });


            var CadastrarUsuario = Backbone.View.extend({
                el: '.page',
                render: function() {
                    var template = _.template($('#template_CadastroUsuarioView').html(), {});
                    this.$el.html(template);
                },
                events: {
                    'submit .cadastrar-usuario-form': 'salvarUsuarioNovo',
                },
                salvarUsuarioNovo: function(ev) {
                    var dadosUsuario = $(ev.currentTarget).serializeObject();
                    console.log(dadosUsuario);
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

            var Amigos = Backbone.View.extend({
                el: '.page',
                render: function() {
                    var template = _.template($('#template_AmigosView').html(), {});
                    this.$el.html(template);
                },
            });

            var Convites = Backbone.View.extend({
                el: '.page',
                render: function() {
                    var ec = new EventosConvidado();
                    var that = this;
                    uid = usrLog.login;
                    ec.fetch({success: function() {
                    var template = _.template($('#template_ConvitesView').html(), {ec: ec.models});
                    that.$el.html(template);

    
}});


                },
            });

            var Eventos = Backbone.View.extend({
                el: '.page',
                render: function() {
                    var eo = new EventosOrganizado();
                    var that = this;
                    uid = usrLog.login;
                    eo.fetch({success: function() {
                    var template = _.template($('#template_EventosView').html(), {eo: eo.models});
                    that.$el.html(template);
}});


                },
            });


            var ListaCompras = Backbone.View.extend({
                el: '.page',
                render: function() {
                    var template = _.template($('#template_ListaComprasView').html(), {});
                    this.$el.html(template);
                },
            });

            


            var UsuarioLogado = Backbone.View.extend({
                el: '.page',
                render: function() {
                var ec = new EventosConvidado();
                var eo = new EventosOrganizado();
                var that = this;
                uid = usrLog.login;
                ec.fetch({success: function() {
                eo.fetch({success: function() {
                            var template = _.template($('#template_HomeView').html(), {ec: ec.models, eo: eo.models});
                            that.$el.html(template);    
    }});
}});
                },
            });

                var MeuCadastro = Backbone.View.extend({
                el: '.page',
                render: function() {
                    var template = _.template($('#template_MeuCadastroView').html(), {});
                    this.$el.html(template);
                },
                events: {
                    'submit .atualizar-usuario-form': 'atualizarUsuario',
                },
                atualizarUsuario: function(ev) {
                    var dadosUsuario = $(ev.currentTarget).serializeObject();
                    var usuario = new UsuarioLogin({id: usrLog.login, login: usrLog.login});
                    var dadosCompletos = new Object();
                    dadosCompletos.login = usrLog.login;
                    dadosCompletos.senha = dadosUsuario.senha;
                    dadosCompletos.email = dadosUsuario.email;
                    dadosCompletos.celular = usrLog.celular;
                    dadosCompletos.oauthProvider = usrLog.oauthProvider;
                    dadosCompletos.oauthUid = usrLog.oauthUid;
                    dadosCompletos.twitterOauthToken = usrLog.twitterOauthToken;
                    dadosCompletos.twitterOauthTokenSecret = usrLog.twitterOauthTokenSecret;
                    console.log(usrLog);
                    //dadosCompletos.email = dadosUsuario.email;
                    console.log(dadosCompletos);
                    //console.log(usrLog);
                    //console.log(usuario);
                    //console.log(usuario.id);
                    usuario.save(dadosCompletos, {
                        success: function(usuario) {
                            router.navigate('meucadastro', {trigger: true});
                        }
                    });
                    return false;
                }
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

        
             var u = new Usuario();


            var Router = Backbone.Router.extend({
                routes: {
                    '': 'home',
                    'cadastrar': 'cadastrarUsuario',
                    'logar': 'logarUsuario',
                    'logado': 'usuarioLogado',
                    'errado': 'dadosErrados',
                    'eventos': 'eventos',
                    'convites': 'convites',
                    'amigos': 'amigos',
                    'meucadastro': 'meucadastro',
                    'listacompras':'listacompras',

                }
            });
            var cadastrarUsuario = new CadastrarUsuario();
            var logarUsuario = new Logar();
            var meucadastro = new MeuCadastro();
            var usuarioLogado = new UsuarioLogado();
            var router = new Router();
            var home = new Home();
            var dadosErrados = new DadosErrados();
            var amigos = new Amigos();
            var convites = new Convites();
            var eventos = new Eventos();
            var listacompras = new ListaCompras();
            router.on('route:home', function() {
                    u = usrLog;
                if(usrLog == "" || usrLog == null){
                    home.render();

                } else{
                    usuarioLogado.render();
                }
            });


            router.on('route:cadastrarUsuario', function() {
                cadastrarUsuario.render();
            });
            router.on('route:eventos', function() {
                eventos.render();
            });
            router.on('route:amigos', function() {
                amigos.render();
            });
            router.on('route:listacompras', function() {
                listacompras.render();
            });
            router.on('route:convites', function() {
                convites.render();
            });
            router.on('route:meucadastro', function() {
                meucadastro.render();
            });
            router.on('route:logarUsuario', function() {
                
                logarUsuario.render();
            });
            router.on('route:usuarioLogado', function() {
                
                home.render();
            });
            router.on('route:dadosErrados', function() {
                
                dadosErrados.render();
            });

            Backbone.history.start();