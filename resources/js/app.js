require('./bootstrap');

import Vue from "vue";
import VueRouter from "vue-router";
import axios from "axios";

import router from "./router/index";
import App from "./App.vue";

Vue.component("pagination", require("./components/PaginationComponent.vue").default);

Vue.prototype.$http = axios;

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router,
    components: { App }
});