import Vue from 'vue';
import VueRouter from 'vue-router';

import Login from './pages/Login';
import Registration from './pages/Registration';
import Upload from './pages/Upload';
import Form from './pages/Form';
import Final from './pages/Final';

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Login',
      component: Login,
      meta: {
        public: true,
      },
    },
    {
      path: '/registration',
      name: 'Registration',
      component: Registration,
      meta: {
        public: true,
      },
    },
    {
      path: '/upload',
      name: 'Upload',
      component: Upload,
      meta: {
        public: false,
      },
    },
    {
      path: '/form',
      name: 'Form',
      component: Form,
      meta: {
        public: false,
      }
    },
    {
      path: '/final',
      name: 'Final',
      component: Final,
      meta: {
        public: false,
      }
    },
  ]
});

router.beforeEach((to, from, next) => {

  const isLogged = localStorage.getItem('token') !== null;

  if (to.path === '/' && isLogged) {
    next({ path: '/upload' });
  }

  if (to.meta.public) {
    return next();
  }

  return isLogged
    ? next()
    : next({ path: '/' });
});

export default router;