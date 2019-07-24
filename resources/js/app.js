/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

import VueSocketio from 'vue-socket.io';
import socketio from 'socket.io-client';
const socketServer = 'qblog-laravel.herokuapp.com:'+process.env.PORT;
Vue.use(VueSocketio,  socketio(':51289'));   //(process.env.ROOT_URL+':'+process.env.PORT) );
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
///chat public
Vue.component('Message', require('./components/Public_chat/Message.vue').default);
Vue.component('User', require('./components/Public_chat/User.vue').default);
///chat private
Vue.component('chat-app', require('./components/Private_chat/ChatApp.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

Vue.prototype.$userId = document.querySelector("meta[name='user-id']").getAttribute('content');