var TipoList = Backbone.Collection.extend({
	model: TipoModel
	url: '/tipos'
});

var Tipos = new TipoList();