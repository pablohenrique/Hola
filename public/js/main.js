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
                if(usrLog == "" || usrLog == null){
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
                home.render();
            });
            router.on('route:dadosErrados', function() {
                dadosErrados.render();
            });

            Backbone.history.start();