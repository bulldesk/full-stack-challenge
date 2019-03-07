var elixir = require('laravel-elixir');

elixir(function(mix){

	mix.styles([
		'../../../node_modules/bootstrap/dist/css/bootstrap.css'
	], 'public/css/app.css');

});