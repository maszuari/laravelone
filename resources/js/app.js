require('./bootstrap');

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';
import App from './App.vue';
Vue.use(VueAxios, axios);

import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue)

const router = new VueRouter({ mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');