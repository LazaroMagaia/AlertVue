

require('./bootstrap');
require('../css/app.css');
window.Vue = require('vue').default;
import Vue from 'vue';

Vue.component('home-component', require('./components/Home.vue').default);
Vue.component('indexalert-component', require('./components/Admin/Alert.vue').default);
const app = new Vue({
    el: '#app',
});
