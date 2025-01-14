/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

import Vue from 'vue';
import vue from 'vue';

window.Vue = vue;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('query-message', require('./components/base/QueryMessage.vue').default);
Vue.component('invention-search', require('./components/InventionSearch.vue').default);
Vue.component('inventions-list', require('./components/InventionsList.vue').default);
Vue.component('invention-form', require('./components/InventionForm.vue').default);
Vue.component('invention', require('./components/Invention.vue').default);
Vue.component('domains-list', require('./components/DomainsList.vue').default);
Vue.component('domain', require('./components/Domain.vue').default);
Vue.component('domain-inventions', require('./components/DomainInventions.vue').default);
Vue.component('domain-form', require('./components/DomainForm.vue').default);







/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
