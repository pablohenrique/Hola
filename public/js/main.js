function htmlEncode(value){
      return $('<div/>').text(value).html();
    }


function require_template(tmpl_dir, templateName) {
    var template = $('#template_' + templateName);
    if (template.length === 0) {
        //var tmpl_dir = 'template';
        var tmpl_url = 'template/' + tmpl_dir + '/' + templateName + '.html';
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

require_template('index','barra');
require_template('index','acessar');
require_template('index','cadastrar');
require_template('index','carrossel');
require_template('account','cabecalho');
require_template('ads','anuncio');
require_template('app','navbar');
require_template('app','home');
require_template('events','cadastrar');
require_template('events','eventos');
require_template('friends','amigos');
require_template('shopping','compras');
require_template('tickets','convites');
require_template('tickets','informacao');



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
                    this.$el.find(".top").empty();
                    this.$el.find(".main").empty();
                    var barra = _.template($('#template_barra').html(), {});
                    this.$el.find(".top").append(barra);
                    var cadastrar = _.template($('#template_cadastrar').html(), {});
                    this.$el.find(".main").append(cadastrar);
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
                    var barra = _.template($('#template_barra').html(), {});
                    this.$el.find(".top").append(barra);
                    var carrossel = _.template($('#template_carrossel').html(), {});
                    this.$el.find(".main").append(carrossel);

                },
            });

            var Amigos = Backbone.View.extend({
                el: '.page',
                render: function() {
                    var that = this;
                    that.$el.find(".top").empty();
                    that.$el.find(".main").empty();
                    var navbar = _.template($('#template_navbar').html(), {});
                    that.$el.find(".top").append(navbar);
                    var home = _.template($('#template_amigos').html(),  {});
                    that.$el.find(".main").append(home);
                    var ads = _.template($('#template_anuncio').html(),{});
                    that.$el.find(".main").append(ads);  
                },
            });

            var Convites = Backbone.View.extend({
                el: '.page',
                render: function() {
                    var ec = new EventosConvidado();
                    var that = this;
                    that.$el.find(".top").empty();
                    that.$el.find(".main").empty();
                    uid = usrLog.login;
                    ec.fetch({success: function() {
                   var navbar = _.template($('#template_navbar').html(), {});
                    that.$el.find(".top").append(navbar);
                    var home = _.template($('#template_convites').html(),  {ec: ec.models});
                    that.$el.find(".main").append(home);
                    var ads = _.template($('#template_anuncio').html(),{});
                    that.$el.find(".main").append(ads);  

    
}});


                },
            });

            var Eventos = Backbone.View.extend({
                el: '.page',
                render: function() {
                    var eo = new EventosOrganizado();
                    var that = this;
                    that.$el.find(".top").empty();
                    that.$el.find(".main").empty();
                    uid = usrLog.login;
                    eo.fetch({success: function() {
                    var navbar = _.template($('#template_navbar').html(), {});
                    that.$el.find(".top").append(navbar);
                    var home = _.template($('#template_eventos').html(),  {eo: eo.models});
                    that.$el.find(".main").append(home);
                    var ads = _.template($('#template_anuncio').html(),{});
                    that.$el.find(".main").append(ads);   
}});


                },
            });


            var ListaCompras = Backbone.View.extend({
                el: '.page',
                render: function() {
                    var that = this;
                    that.$el.find(".top").empty();
                    that.$el.find(".main").empty();
                    var navbar = _.template($('#template_navbar').html(), {});
                    that.$el.find(".top").append(navbar);
                    var home = _.template($('#template_compras').html(),  {});
                    that.$el.find(".main").append(home);
                    var ads = _.template($('#template_anuncio').html(),{});
                    that.$el.find(".main").append(ads); 
                },
            });




                var UsuarioLogado = Backbone.View.extend({
                el: '.page',
                render: function() {
                var ec = new EventosConvidado();
                var eo = new EventosOrganizado();
                var that = this;
                that.$el.find(".top").empty();
                that.$el.find(".main").empty();
                uid = usrLog.login;
                ec.fetch({success: function() {
                eo.fetch({success: function() {
                   var navbar = _.template($('#template_navbar').html(), {});
                    that.$el.find(".top").append(navbar);
                    var home = _.template($('#template_home').html(),  {ec: ec.models, eo: eo.models});
                    that.$el.find(".main").append(home);
                    var ads = _.template($('#template_anuncio').html(),{});
                    that.$el.find(".main").append(ads);   
    }});
}});
                },
            });

                var MeuCadastro = Backbone.View.extend({
                el: '.page',
                render: function() {
                    var that = this;
                    that.$el.find(".top").empty();
                    that.$el.find(".main").empty();
                    var navbar = _.template($('#template_navbar').html(), {});
                    that.$el.find(".top").append(navbar);
                    var home = _.template($('#template_cabecalho').html(),  {});
                    that.$el.find(".main").append(home);
                    var ads = _.template($('#template_anuncio').html(),{});
                    that.$el.find(".main").append(ads);  
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
                    this.$el.find(".top").empty();
                    this.$el.find(".main").empty();
                    var barra = _.template($('#template_barra').html(), {});
                    this.$el.find(".top").append(barra);
                    var acessar = _.template($('#template_acessar').html(), {});
                    this.$el.find(".main").append(acessar);
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