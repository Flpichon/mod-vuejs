import '@babel/polyfill'
import 'mutationobserver-shim'
import moment from 'moment'
import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import './plugins/bootstrap-vue'
import App from './App.vue'
import './plugins/vuetify'
import './plugins/axios'
import router from './router'
import store from './store'
import Notifications from 'vue-notification'
import './plugins/element.js'
import "./filters"
import VuetifyDialog from 'vuetify-dialog'


Vue.config.productionTip = false
Vue.use(Vuetify, {
  theme: {
    primary: '#3f51b5',
    secondary: '#b0bec5',
    accent: '#8c9eff',
    error: '#b71c1c'
  }
});
Vue.use(Notifications);
Vue.use(VuetifyDialog, {
  confirm: {
    actions: {
      false: 'Annuler',
      true: {
        text: 'Oui',
        color: 'primary'
      }
    },
    icon: false,
    width: 500
  },
  warning: {},
  error: {},
  prompt: {}
})
new Vue({
  router,
  store,
  moment,
  render: h => h(App)
}).$mount('#app')

