require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'
import User from './components/User.vue'
import Dashboard from './components/Dashboard.vue'

Vue.use(VueRouter)

let routes = [
    { path: '/user', component: User },
    { path: '/dashboard', component: Dashboard }
  ]

  const router = new VueRouter({
    routes // short for `routes: routes`
  })

  const app = new Vue({
    router
  }).$mount('#app')