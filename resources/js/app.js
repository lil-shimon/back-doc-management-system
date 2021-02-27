require("./bootstrap");

import Vue from "vue";
import "@mdi/font/css/materialdesignicons.css";
import "vue2-admin-lte/src/lib/css";
import "vue2-admin-lte/src/lib/script";
import VueCurrencyInput from 'vue-currency-input';

Vue.use(VueCurrencyInput);


import store from "./store";
import router from "./router";

import App from "./components/App.vue";

window.Vue = require("vue");
window.state = store.state;
window.user_info = store.user_info;
window.beforeTo = "";
window.beforeFrom = "";

axios.interceptors.request.use(config => {
    config.headers["Authorization"] = `Bearer ${localStorage.getItem(
        "jwt-token"
    )}`;
    return config;
});

axios.interceptors.response.use(
    response => {
        // ...get the token from the header or response data if exists, and save it.
        const token =
            response.headers["Authorization"] || response.data["token"];
        if (token) {
            localStorage.setItem("jwt-token", token);
        }

        return response;
    },
    error => {
        // Also, if we receive a Bad Request / Unauthorized error
        console.log(error);
        return Promise.reject(error);
    }
);

const app = new Vue({
    el: "#app",
    router: router,
    components: { App },
    template: "<App />",
    created() {
        store.init();
    }
});
