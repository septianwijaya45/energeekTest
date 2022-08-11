require('./bootstrap');

import Vue from 'vue/dist/vue'

import VueRouter from 'vue-router';
import routes from './routes';
import Select2 from 'vue3-select2-component';

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    components: {
        Select2
    },
    router: new VueRouter(routes),
});