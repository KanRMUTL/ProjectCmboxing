
require('./bootstrap');
import swal from 'sweetalert';

window.Vue = require('vue');
window.axios = require('axios');

//  คลังสินค้า
Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('saling', require('./components/pos/saling.vue'));
Vue.component('product', require('./components/pos/product.vue'));
Vue.component('edit-product', require('./components/pos/edit_product.vue'));
Vue.component('report', require('./components/pos/report.vue'));

//ทั่วไป
Vue.component('profile', require('./components/marketing/user/profile.vue'));

// เว็บออนไลน์
Vue.component('booking', require('./components/shopping/booking.vue'));
Vue.component('course', require('./components/shopping/addmin/course/course.vue'));
Vue.component('manage-trainer', require('./components/shopping/addmin/trainer/manage.vue'));
Vue.component('courses', require('./components/shopping/course/courses.vue'));
Vue.component('trainer', require('./components/shopping/course/trainer.vue'));
Vue.component('register-course', require('./components/shopping/course/register-course.vue'));

const app = new Vue({
    el: '#vue'
});
