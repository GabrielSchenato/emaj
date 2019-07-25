import Vue from 'vue'
import Vuetify from 'vuetify/lib'
import pt from 'vuetify/es5/locale/pt'
import 'vuetify/src/stylus/app.styl'
import '../theme/default.styl'
import colors from 'vuetify/es5/util/colors'
import '@mdi/font/css/materialdesignicons.css' 
Vue.use(Vuetify, {
  theme: {
    primary: colors.grey.darken3,
    secondary: '#424242',
    accent: '#82B1FF',
    error: '#FF5252',
    info: '#2196F3',
    success: '#4CAF50',
    warning: '#FFC107',
  },
  customProperties: true,
  iconfont: ['fa4', 'mdi'],
  lang: {
    locales: { pt },
    current: 'pt'
  }
});
