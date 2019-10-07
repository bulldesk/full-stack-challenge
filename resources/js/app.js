import Vue from 'vue';
import router from './routes';
import store from './store';
import './bootstrap';

import App from './pages/App';

export default new Vue({
  el: '#app',
  router,
  store,
  render: h => h(App),
});