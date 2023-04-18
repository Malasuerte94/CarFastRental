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
import Loader from "./shared/components/Loader";
import Success from "./shared/components/Success";
import ValidationErrors from "./shared/components/ValidationErrors";
import storeDefinition from "./store";
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import VueMobileDetection from "vue-mobile-detection";

window.Alpine = Alpine;
Alpine.start();

window.Vue = require("vue");
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(DatePicker);
Vue.use(VueMobileDetection);

Vue.filter("fromNow", value => moment(value).fromNow());
Vue.filter("dateformating", value => moment(value).format("DD-MM-YYYY"));

Vue.component("star-rating", StarRating);
Vue.component("loader", Loader);
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
        this.$store.dispatch("loadUser");
    },
});
