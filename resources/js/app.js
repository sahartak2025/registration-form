import './bootstrap';

import Vue from 'vue';
import Vuetify from 'vuetify'

Vue.use(Vuetify)

import vuetify from './vuetify';
Vue.component('registration-form', require('./components/RegistrationForm').default);

const app = new Vue({
    el: '#app',
    vuetify
});
