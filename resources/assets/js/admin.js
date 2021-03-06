
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Toastr notifier lib
 */
window.toastr = require('toastr');

window.toastr.options = {
    "timeOut": "5000"
}

require('../../../public/js/admin/api_asvae/installer.js');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.http.headers.common['X-CSRF-TOKEN'] = Laravel.csrfToken;

Vue.component('services', require('./components/admin/services/ServiceComponent.vue'));
Vue.component('specialities', require('./components/admin/specialities/SpecialityComponent.vue'));

const app = new Vue({
    el: '#app'
});