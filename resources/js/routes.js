import Vue from 'vue';
import VueRouter from 'vue-router';

import Upload from './pages/Upload';
import Form from './pages/Form';

Vue.use(VueRouter);

export default new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Upload',
      component: Upload,
    },
    {
      path: '/form',
      name: 'Form',
      component: Form,
    },
  ]
});