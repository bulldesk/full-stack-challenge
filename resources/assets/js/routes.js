import Home from './components/Home.vue';
import Login from './components/auth/Login.vue';

export const routes = [
    {
        path: '/',
        component: Home,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/login',
        component: Login
    },
    {
        path: '/importLeads',
        component: Home,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/storeLeads',
        component: Home,
        meta: {
            requiresAuth: true
        }
    },
];