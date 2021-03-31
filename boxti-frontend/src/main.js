import Vue from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify';
import MultiFiltersPlugin from './plugins/MultiFilters'

Vue.config.productionTip = false

Vue.use(MultiFiltersPlugin);

new Vue({
  router,
  vuetify,
  render: h => h(App)
}).$mount('#app')
