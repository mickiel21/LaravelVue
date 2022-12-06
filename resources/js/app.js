/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 import Vue from 'vue';
 
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
 Vue.component("AddButton", require('./components/layouts/AddButton').default);
 Vue.component("NavBar", require('./components/layouts/NavBar').default);
 Vue.component("SideBar", require('./components/layouts/SideBar').default);
 Vue.component("LoginContainer", require('./container/LoginContainer').default);
 
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
 import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
 // Make BootstrapVue available throughout your project
 Vue.use(BootstrapVue)
 
 const options = {
    confirmButtonColor: "#118442",
    cancelButtonColor: "#921806"
};
 Vue.use(VueSweetalert2, options);
 // Optionally install the BootstrapVue icon components plugin


 Vue.use(IconsPlugin)
 const app = new Vue({
     el: '#app',
     router,
     store
 });
 