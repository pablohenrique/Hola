var ItemModel = Backbone.Model.extend({
    defaults: {
        nome: "",
        usuario: ""
    },
    validate: function(attrs) {
        if (attrs.nome == '')
            return 'O nome é obrigatório'
    }
});

