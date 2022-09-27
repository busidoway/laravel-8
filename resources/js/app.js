/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// import UserVideo from "./components/UserVideo";

Vue.component('user-video', require('./components/admin/UserVideo.vue').default);

Vue.component('menu-list', require('./components/admin/MenuList.vue').default);

Vue.component('program-list', require('./components/admin/ProgramList.vue').default);

// Vue.component('user-video', {
//     template: UserVideo
// })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app_video = new Vue({
    el: '#app_video'
});

const app_menu = new Vue({
    el: '#app_menu_list'
});

const app_program_list = new Vue({
    el: '#app_program_list'
});