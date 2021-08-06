/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('principal', require('./components/Principal.vue').default);
Vue.component('type-room', require('./components/TypeRoom.vue').default);
Vue.component('room', require('./components/Room.vue').default);
Vue.component('client', require('./components/Client.vue').default);
Vue.component('links', require('./components/Links.vue').default);
Vue.component('worker', require('./components/Worker.vue').default);
Vue.component('category', require('./components/Category.vue').default);
Vue.component('provider', require('./components/Provider.vue').default);
Vue.component('product', require('./components/Product.vue').default);
Vue.component('reception', require('./components/Reception.vue').default);
Vue.component('certificate', require('./components/Certificate.vue').default);
Vue.component('companion', require('./components/Companion.vue').default);
Vue.component('checkbook', require('./components/Checkbook.vue').default);
Vue.component('ticket', require('./components/Ticket.vue').default);
Vue.component('servicie', require('./components/Servicie.vue').default);
Vue.component('buy', require('./components/Buy.vue').default);
Vue.component('user', require('./components/User.vue').default);
Vue.component('role', require('./components/Role.vue').default);
Vue.component('spinner', require('./components/Spinner.vue').default);
Vue.component('export', require('./components/Export.vue').default);
Vue.component('box', require('./components/Box.vue').default);
Vue.component('adminbox', require('./components/Adminbox.vue').default);
Vue.component('panel', require('./components/Panel.vue').default);
Vue.component('linec', require('./components/Linec.vue').default);
Vue.component('bar', require('./components/bar.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        indice: 28,
    }
});

