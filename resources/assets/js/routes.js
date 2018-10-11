import Vue from 'vue'
import VueRouter from 'vue-router'
import LoginComponent from './components/LoginComponent'
import AdminPage from './pages/AdminPage'


Vue.use(VueRouter)

const router = new VueRouter({
    routes: [
      {
        path: '/',
        name: 'login',
        component: LoginComponent
      },
      {
        path: '/admin',
        name: 'admin',
        component: AdminPage
      }
    ]
  })

export {router};