import Vue from 'vue'
import VueRouter from 'vue-router'

require('./bootstrap')

Vue.use(VueRouter)

import App from './views/App'
import Welcome from './views/Welcome'
import InventoryList from './views/inventory/InventoryList'
import InventoryCreateForm from './views/inventory/InventoryCreateForm'
import Login from './views/users/Login'
import Register from './views/users/Register'

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);


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
        	name: 'inventory',
        	component: InventoryList
        },
        {
            path: '/inventory/add',
            name: 'addInventory',
            component: InventoryCreateForm,
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