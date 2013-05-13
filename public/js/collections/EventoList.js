var EventoList = Backbone.Collection.extend({
	model: EventoModel
	url: '/eventos'
});

var Eventos = new EventoList();