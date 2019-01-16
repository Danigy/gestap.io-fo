import Vue from 'vue'
import App from './App.vue'
import router from './router'
import moment from 'moment'

Vue.config.productionTip = false

Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).lang('fr').format('LLL')
  }
});

new Vue({
  router,
  render: h => h(App)
}).$mount('#app');
