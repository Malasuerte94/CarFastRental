import { createApp } from 'vue';
import { createStore } from 'vuex';
import moment from 'moment';
import Alpine from 'alpinejs';
import Index from './Index';
import router from './routes';
import FatalError from './shared/components/FatalError';
import StarRating from './shared/components/StarRating';
import Loader from './shared/components/Loader';
import Success from './shared/components/Success';
import ValidationErrors from './shared/components/ValidationErrors';
import storeDefinition from './store';
import DatePicker from 'vue-datepicker-next'
import Vue3MobileDetection from "vue3-mobile-detection";
import Spacer from './shared/components/Spacer';
import ApiService from './services/apiService';

const app = createApp({
  components: {
    Index,
  },
  async beforeCreate() {
    this.$store.dispatch('loadStoredState');
    this.$store.dispatch('loadUser');
  },
});

app.config.globalProperties.$filters = {
  fromNow: (value) => moment(value).fromNow(),
  dateformating: (value) => moment(value).format('DD-MM-YYYY'),
};

app.use(router);
app.use(DatePicker);
app.use(Vue3MobileDetection);
app.use(ApiService);
app.use(createStore(storeDefinition));

app.component('star-rating', StarRating);
app.component('loader', Loader);
app.component('fatal-error', FatalError);
app.component('success', Success);
app.component('v-errors', ValidationErrors);
app.component('Spacer', Spacer);

app.mount('#app');

window.Alpine = Alpine;
Alpine.start();
