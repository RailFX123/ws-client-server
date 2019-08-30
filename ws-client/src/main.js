import Vue from 'vue'
import VueRouter from 'vue-router'
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'

Vue.use(Buefy)

Vue.config.productionTip = false
    //Vue.http.options.emulateJSON = true

Vue.use(VueRouter)

import Dashboard from './components/Principal.vue';

const routes = [
    { path: '/', component: Dashboard },
]

const router = new VueRouter({
    mode: 'history',
    routes
})

new Vue({
    router,
    render: h => h(Dashboard)
}).$mount('#app')