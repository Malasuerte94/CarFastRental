require("./bootstrap");

import Vue from 'vue';
import moment from "moment";
import VueRouter from "vue-router";
import Vuex from 'vuex';
import Alpine from 'alpinejs';
import Index from "./Index";
import router from "./routes";
import FatalError from "./shared/components/FatalError";
import StarRating from "./shared/components/StarRating";
import Success from "./shared/components/Success";
import ValidationErrors from "./shared/components/ValidationErrors";
import storeDefinition from "./store";
import axios from 'axios';

window.Alpine = Alpine;
Alpine.start();

window.Vue = require("vue");
Vue.use(VueRouter);
Vue.use(Vuex);

Vue.filter("fromNow", value => moment(value).fromNow());

Vue.component("star-rating", StarRating);
Vue.component("fatal-error", FatalError);
Vue.component("success", Success);
Vue.component("v-errors", ValidationErrors);

const store = new Vuex.Store(storeDefinition);

window.axios.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (401 === error.response.status) {
            store.dispatch("logout");
        }

        return Promise.reject(error);
    }
);

const app = new Vue({
    el: "#app",
    router,
    store,
    components: {
        index: Index
    },
    async beforeCreate() {
        this.$store.dispatch("loadStoredState");

        // await axios.get('/sanctum/csrf-cookie');
        // await axios.post('/login', {
        //     email: 'zschuppe@example.org',
        //     password: 'password'
        // });
    },
});