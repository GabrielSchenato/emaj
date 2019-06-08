import { sync } from 'vuex-router-sync'
import Vue from "vue";
import Vuex from 'vuex'
import VuexStore from "./vuex/store";
import VueAxios from 'vue-axios'
import VueAuth from '@websanova/vue-auth'
import auth from './auth'
import axios from 'axios'
import App from "./App.vue";
import router from "./router/";
import VeeValidate, { Validator } from 'vee-validate'
import pt_BR from "vee-validate/dist/locale/pt_BR";
import 'roboto-fontface/css/roboto/roboto-fontface.css'
import 'font-awesome/css/font-awesome.css'
import 'es6-promise/auto'
import './plugins/vuetify'
import mixin from './plugins/mixin'
import './util/filters'
import './util/vuetify-money/';

Validator.localize({pt_BR: pt_BR});
Vue.use(VeeValidate, {locale: 'pt_BR'});

window.$ = window.jQuery = require('jquery');

Vue.config.productionTip = false;

Vue.use(VueAxios, axios);
Vue.use(Vuex);

axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api/v1/`;

Vue.router = router;

const store = new Vuex.Store(VuexStore);

Vue.use(VueAuth, auth);

sync(store, router);

Vue.mixin(mixin);

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");
