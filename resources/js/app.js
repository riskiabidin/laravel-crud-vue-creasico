require('./bootstrap');
window.Vue = require('vue');
import Vue from 'vue';
import VueRouter from 'vue-router'
import VueAxios from 'vue-axios';
import axios from 'axios';
import { Form, HasError, AlertError } from 'vform';
import Swal from 'sweetalert2';
import VueNoty from 'vuejs-noty';
import 'vuejs-noty/dist/vuejs-noty.css'

// import component
import User from './components/User.vue'
import Dashboard from './components/Dashboard.vue'
import Register from './components/Register.vue'
import EditUser from './components/EditUser.vue'
import Category from './components/Category.vue'
import Supplier from './components/Supplier.vue'
import Produk from './components/Produk.vue'
import Pembelian from './components/Pembelian.vue'
import Insert_Pembelian from './components/Insert_Pembelian.vue'
import Edit_Pembelian from './components/Edit_Pembelian.vue'
import Member from './components/Member.vue'
import Penjualan from './components/Penjualan.vue'
import Insert_Penjualan from './components/Insert_Penjualan.vue'
import Edit_Penjualan from './components/Edit_Penjualan.vue'




Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VueNoty);
window.Form = Form;


const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
window.Swal = Swal;
window.Toast = Toast;


import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
  });

let routes = [
    { 
      path: '/user', 
      component: User, 
      name:'user' 
    },
    { 
      path: '/dashboard', 
      component: Dashboard 
    },
    { 
      path: '/register', 
      component: Register 
    },
    { 
      path: '/editUser/:id', 
      component: EditUser 
    },
    { 
      path: '/category', 
      component: Category 
    },
    { 
      path: '/supplier', 
      component: Supplier 
    },
    { 
      path: '/produk', 
      component: Produk 
    },
    { 
      path: '/pembelian', 
      component: Pembelian,
      name:'pembelian' 

    },
    { 
      path: '/insert_pembelian', 
      component: Insert_Pembelian
    },
    { 
      path: '/editpembelian/:id', 
      component: Edit_Pembelian
    },
    { 
      path: '/member', 
      component: Member,
      name:'member' 

    },
    { 
      path: '/penjualan', 
      component: Penjualan,
      name:'penjualan' 

    },
    { 
      path: '/insert_penjualan', 
      component: Insert_Penjualan
    },
    { 
      path: '/editPenjualan/:id', 
      component: Edit_Penjualan
    },

  ]

  const router = new VueRouter({
    routes // short for `routes: routes`
  })

  const app = new Vue({
    router
  }).$mount('#app')