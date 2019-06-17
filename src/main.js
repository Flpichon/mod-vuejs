import '@babel/polyfill'
import 'mutationobserver-shim'
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

Vue.config.productionTip = false
Vue.use(Vuetify);
Vue.use(Notifications);
new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')

