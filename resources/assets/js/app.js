
require('./bootstrap');
import swal from 'sweetalert';
import store from './store'
// import moment from 'moment';
window.Vue = require('vue');
window.axios = require('axios');
window.moment = require('moment');

Vue.component('profile-img', require('./components/profile-img.vue'));
//  คลังสินค้า
Vue.component('saling', require('./components/pos/saling.vue'));
Vue.component('product', require('./components/pos/product.vue'));
Vue.component('edit-product', require('./components/pos/edit_product.vue'));
Vue.component('report', require('./components/pos/report.vue'));

//ทั่วไป
Vue.component('profile', require('./components/marketing/user/profile.vue'));
Vue.component('password-reset', require('./components/marketing/user/passwordReset.vue'));
Vue.component('personal-profile', require('./components/marketing/employeeProfile/personal-profile.vue'));
Vue.component('saling-profile', require('./components/marketing/employeeProfile/saling-profile.vue'));
Vue.component('commission', require('./components/marketing/employeeProfile/commission.vue'));
Vue.component('income', require('./components/marketing/employeeProfile/income.vue'));
Vue.component('saling-detail', require('./components/marketing/employeeProfile/saling-detail.vue'));
Vue.component('chart', require('./components/marketing/chart/chart.vue'));

//  ============= เว็บออนไลน์ ==============
// User
Vue.component('booking', require('./components/shopping/booking/booking.vue'));
Vue.component('seat', require('./components/shopping/booking/seat.vue'));
Vue.component('booking-detail', require('./components/shopping/booking/booking-detail.vue'));

Vue.component('paypal-button', require('./components/Paypal/paypal-button.vue'));

Vue.component('my-ticket', require('./components/shopping/myProduct/ticket/My-Ticket.vue'));
Vue.component('ticket-detail', require('./components/shopping/myProduct/ticket/ticket-detail.vue'));
Vue.component('my-course', require('./components/shopping/myProduct/course/My-Course.vue'));

Vue.component('ticket', require('./components/shopping/pages/ticket/ticket.vue'));
Vue.component('single-ticket', require('./components/shopping/pages/ticket/single-ticket.vue'));
Vue.component('paypal-button-ticket', require('./components/shopping/pages/ticket/paypal-button-ticket.vue'));

Vue.component('web-footer', require('./components/shopping/pages/footer/footer.vue'));

Vue.component('courses-index', require('./components/shopping/course/index.vue'));
Vue.component('courses', require('./components/shopping/course/courses.vue'));
Vue.component('trainer', require('./components/shopping/course/trainer.vue'));
Vue.component('register-course', require('./components/shopping/course/register-course.vue'));

Vue.component('user-profile', require('./components/shopping/profile/user-profile.vue'));
Vue.component('customer-resetpassword', require('./components/shopping/profile/reset-password.vue'));
// Admin
Vue.component('course', require('./components/shopping/addmin/course/course.vue'));
Vue.component('report-course', require('./components/shopping/addmin/course/report-course.vue'));
Vue.component('manage-trainer', require('./components/shopping/addmin/trainer/manage.vue'));
Vue.component('sale-ticket-online', require('./components/shopping/addmin/ticket/sale-ticket-online.vue'));
Vue.component('ticket-online-detail', require('./components/shopping/addmin/ticket/ticket-online-detail.vue'));


const app = new Vue({
    store,
    el: '#vue'
});

const nav = new Vue({
    store,
    el: '#nav'
})

