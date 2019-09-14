require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
import App from './App.vue';
Vue.use(VueAxios, axios);

//import BootstrapVue from 'bootstrap-vue';
//Vue.use(BootstrapVue);

import Home from './components/Home.vue';
import CreateUser from './components/CreateUser.vue';
import Users from './components/Users.vue';
import EditUser from './components/EditUser.vue';

const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'create',
        path: '/create',
        component: CreateUser
    },
    {
        name: 'users',
        path: '/users',
        component: Users
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditUser
    }
  ];
  

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');