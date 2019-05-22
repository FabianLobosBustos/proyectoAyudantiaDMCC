
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

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.component('formulario-component', require('./components/student/FormularioComponent.vue').default);
Vue.component('home-component', require('./components/student/HomeComponent.vue').default);
Vue.component('mensaje-component', require('./components/student/MensajeComponent.vue').default);
Vue.component('ingreso-component', require('./components/student/IngresoComponent.vue').default);
Vue.component('example-component', require('./components/student/ExampleComponent.vue').default);
Vue.component('asignatura-component', require('./components/student/AsignaturaComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
