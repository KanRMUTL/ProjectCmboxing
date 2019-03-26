
require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');
Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('saling', require('./components/saling.vue'));

const app = new Vue({
    el: '#vue'
});
