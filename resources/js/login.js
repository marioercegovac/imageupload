require('./bootstrap');

window.Vue = require('vue');

import loginComponent from './components/LoginComponent.vue';
import VeeValidate from 'vee-validate';

Vue.use(VeeValidate);

const app = new Vue({
    el: '#app',
    components: {
        'co-login': loginComponent,
    },
});
