import './bootstrap'
import Vue from 'vue'
import router from './router'
import store from './store'
import './registerServiceWorker'

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render(h) { return <router-view></router-view> }
}).$mount('#app')
