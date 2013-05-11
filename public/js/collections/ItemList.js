var ItemList = Backbone.Collection.extend({
	model: ItemModel
	url: '/itens'
});

var Itens = new ItemList();