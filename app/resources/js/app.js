// import Vue from "vue";
// import App from "./App.vue";
// import VueRouter from 'vue-router';
// import axios from 'axios';
// import { routes } from './routes';
// import router from "./router";
// import store from "./store";
// import store from './stores'
// import App from './App.vue';
// import Vuex from 'vuex'

// window.axios = axios;
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Vue.use(Vuex)
// Vue.use(VueRouter);

// Vue.component('app', App);

// // console.log(routes)
// // const router = new VueRouter({ mode: 'history', routes: routes});
// const app = new Vue({
//     el: '#app',
//     components: {
//         App,
//     },
//     router: routes,
//     store: store
// });


import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";

import ApiService from "./common/api";
ApiService.init();

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");