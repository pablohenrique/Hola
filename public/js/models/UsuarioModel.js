var UsuarioModel = Backbone.Model.extend({
    defaults: {
        login: "",
        senha: "",
        email: "",
        celular: ""
    },
    validate: function(attrs) {
        if (attrs.login == '')
            return 'O nome é obrigatório';
        if (attrs.senha == '')
            return 'A descrição é obrigatória';
        if (attrs.email == '')
        	return 'A data é obrigatória';
        if (attrs.celular == '')
        	return 'A hora é obrigatória'
    }
});

