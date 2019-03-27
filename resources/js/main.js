import Vue from "vue";
import './plugins/vuetify'
import App from "./App.vue";
import router from "./router/";
import store from "./store";
import "./registerServiceWorker";
import 'roboto-fontface/css/roboto/roboto-fontface.css'
import 'font-awesome/css/font-awesome.css'
import VeeValidate, { Validator } from 'vee-validate'
import pt_BR from "vee-validate/dist/locale/pt_BR";

Validator.localize({pt_BR: pt_BR});
Vue.use(VeeValidate, {locale: 'pt_BR'});


window.$ = window.jQuery = require('jquery');

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");
