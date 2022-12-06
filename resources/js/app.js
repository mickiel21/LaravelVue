/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue').default;
 
 import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
 import 'bootstrap-vue/dist/bootstrap-vue.css'
 
 import store from "./store/index";
 

 import Login from './pages/auth/Login'

 
 /**
  * The following block of code may be used to automatically register your
  * Vue components. It will recursively scan this directory for the Vue
  * components and automatically register them with their "basename".
  *
  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
  */
 
 // const files = require.context('./', true, /\.vue$/i)
 // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
 
 Vue.component('App', require('./container/App.vue').default);
 Vue.component("add-button", require('./components/layouts/AddButton'));
 Vue.component("nav-bar", require('./components/layouts/NavBar'));
 Vue.component("side-bar", require('./components/layouts/SideBar'));
 
 /**
  * Next, we will create a fresh Vue application instance and attach it to
  * the page. Then, you may begin adding components to this application
  * or customize the JavaScript scaffolding to fit your unique needs.
  */
 // ROUTER
 import VueRouter from "vue-router";
 const routes = [
     { path: "/login", component: Login },
 ];
 const router = new VueRouter({ mode: "history", routes: routes });
 
 Vue.use(VueRouter);
 // Make BootstrapVue available throughout your project
 Vue.use(BootstrapVue)
 // Optionally install the BootstrapVue icon components plugin
 Vue.use(IconsPlugin)
 const app = new Vue({
     el: '#app',
     router,
     store
 });
 