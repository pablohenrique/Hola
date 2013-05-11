var PostFormView = Backbone.View.extend({
    tagName: 'form',
    className: 'page-form',
    id: 'usuario-form',
    attributes: {
        action: 'usuarios',
        method: 'POST'
    },
    events: {
        "submit" : "salvarUsuario"
    },
 
    initialize: function(model) {
        _.bindAll(this, 'render', 'salvarUsuario', 'goToIndex');
 
        this.template = $('#usuario-form').html();
        this.model = new PostModel();
 
        this.model.on("error", this.showError);
        this.model.on("sync", this.goToIndex);
        this.render();
    },
 
    render: function() {
        var rendered = _.template(this.template);
        this.$el.html(rendered);
 
        this.loginInput = this.$el.find('#usuario-login');
        this.emailInput = this.$el.find('#usuario-email');
        this.celularInput = this.$el.find('#usuario-celular');
 		this.senhaInput = this.$el.find('#usuario-senha');
        $('body').append(this.el);
    },
 
    salvarUsuario: function(e) {
        e.preventDefault();
 
        var login = this.loginInput.val();
        var email = this.emailInput.val();
        var celular = this.celularInput.val();
        var senha = this.senhaInput.val();
 
        this.model.set({
            login: login,
            email: email,
            celular: celular,
            senha: senha
        });
 
        if (this.model.isValid())
            this.model.save();
    },
 
    showError:function(model, error) {
        window.alert('Ocorreu um erro, motivo: ' + error);
    },
 
    goToIndex: function() {
        window.location = 'index.html';
    }
});
