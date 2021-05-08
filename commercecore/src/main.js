import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import Vuelidate from 'vuelidate'
import { routes } from './routes'
import axios from 'axios'
import '@fortawesome/fontawesome-free/css/all.css'
import 'vue-select/dist/vue-select.css';
import './index.css'
import vSelect from 'vue-select'

axios.defaults.baseURL = "http://localhost:8000/api"
axios.defaults.headers.common['Content-Type'] = 'application/json'

Vue.use( VueRouter )
Vue.use( Vuelidate )
Vue.config.productionTip = false
Vue.component('v-select', vSelect)

const router = new VueRouter({ routes })

new Vue({
  render: h => h(App),
  router,
}).$mount('#app')
