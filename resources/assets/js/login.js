require('./bootstrap');

window.Vue = require('vue')

Vue.component(
	'login-component',
	require('./components/LoginComponent.vue')
);

const login = new Vue({
	el: "#login"
});