var TipoModel = Backbone.Model.extend({
    defaults: {
        nome: ""
    },
    validate: function(attrs) {
        if (attrs.nome == '')
            return 'O nome é obrigatório'
    }
});

