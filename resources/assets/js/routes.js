import Vue from 'vue'
import VueRouter from 'vue-router'
import LoginPage from './pages/LoginPage'
import ImportacaoPage from './pages/ImportacaoPage'
import HomePage from './pages/HomePage'
import LeadsListPage from './pages/LeadsListPage'

Vue.use(VueRouter)

const router = new VueRouter({
    routes: [
      {
        path: '/',
        name: 'login',
        component: LoginPage
      },
      {
        path: '/importar',
        name: 'importar',
        component: ImportacaoPage
      },
      {
        path: '/home',
        name: 'home',
        component: HomePage
      },
      {
        path: '/leads',
        name: 'leads',
        component: LeadsListPage
      }
    ]
})

export {router};