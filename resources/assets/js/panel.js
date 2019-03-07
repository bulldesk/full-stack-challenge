require('./bootstrap');

window.Vue = require('vue')

Vue.filter('formatDate', function (d) {
	d = d.split(" ");
	if (d.length == 2) {
		var date = d[0];
		var time = d[1];
		d = date.substring(8, 10) + "/" + date.substring(5, 7) + "/" + date.substring(0,4);
		d += " " + time.substring(0, 5);
	}
	return d;
});

Vue.component(
	'panel-component',
	require('./components/PanelComponent.vue')
);

const panel = new Vue({
	el: "#panel"
});