import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './views/App'
import Welcome from './views/Welcome'
import List from './views/inventory/List'
import Login from './views/users/Login'
import Register from './views/users/Register'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Welcome
        },
        {
        	path: '/inventory',
        	name: 'list',
        	component: List
        },
        {
        	path: '/login',
        	name: 'login',
        	component: Login
        },
        {
        	path: '/users/register',
        	name: 'register',
        	component: Register
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});