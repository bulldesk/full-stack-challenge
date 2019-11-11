// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import VueResource from 'vue-resource'
import VueMaterial from 'vue-material'
import CxltToastr from 'cxlt-vue2-toastr'

import 'vue-material/dist/vue-material.min.css'
import 'vue-material/dist/theme/default.css'
import 'cxlt-vue2-toastr/dist/css/cxlt-vue2-toastr.css'

Vue.use(VueMaterial)
Vue.use(VueResource)

Vue.use(CxltToastr)

Vue.router = router

Vue.http.options.root = process.env.API

Vue.config.productionTip = false

Vue.use(require('@websanova/vue-auth'), {
  auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
  http: require('@websanova/vue-auth/drivers/http/vue-resource.1.x.js'),
  router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
  rolesVar: 'type',
  loginData: {url: 'auth/login', method: 'POST', redirect: '/', fetchUser: false},
  fetchData: {url: 'auth/me', method: 'POST'},
  refreshData: {url: 'auth/refresh', method: 'POST', atInit: false}
})

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
