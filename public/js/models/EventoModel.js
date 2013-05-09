var EventoModel = Backbone.Model.extend({
    defaults: {
        nome: "",
        descricao: "",
        data: "",
        hora: "",
        endereco: "",
        complemento: "",
        cidade: "",
        estado: "",
        cep: "",
        tipo: "",
        usuario: ""
    },
    validate: function(attrs) {
        if (attrs.nome == '')
            return 'O nome é obrigatório';
        if (attrs.descricao == '')
            return 'A descrição é obrigatória';
        if (attrs.data == '')
        	return 'A data é obrigatória';
        if (attrs.hora == '')
        	return 'A hora é obrigatória';
        if (attrs.endereco = '')
        	return 'O endereço é obrigatório';
        if (attrs.cidade = '')
        	return 'A cidade é obrigatória';
        if (attrs.estado = '')
        	return 'O estado é obrigatório'
    }
});

