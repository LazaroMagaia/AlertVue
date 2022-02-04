

require('./bootstrap');
require('../css/app.css');
window.Vue = require('vue').default;
import Vue from 'vue';
import vueValidade from 'vuelidate';

Vue.use(vueValidade);
Vue.component('home-component', require('./components/Home.vue').default);
Vue.component('alert-component', require('./components/Admin/Alertas.vue').default);
Vue.component('create-component', require('./components/Admin/CreatAlert.vue').default);
Vue.component('edit-component', require('./components/Admin/EditAlert.vue').default);
Vue.component('show-component', require('./components/Admin/ShowAlert.vue').default);
const app = new Vue({
    el: '#app',
});
