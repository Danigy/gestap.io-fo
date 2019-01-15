import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import Router from 'vue-router'
import Home from './views/Login.vue'

Vue.use(Router)
Vue.use(BootstrapVue)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'Login',
      component: Home
    },
    {
      path: '/Dashboard',
      name: 'Dashboard',
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import(/* webpackChunkName: "about" */ './views/Dashboard.vue')
    },
    {
      path: '/Users',
      name: 'Users',
      component: () => import('./views/Users.vue')
    },
    {
      path: '/Groups',
      name: 'Groups',
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import(/* webpackChunkName: "about" */ './views/Groups.vue')
    },
    {
      path: '/Lessons',
      name: 'Lessons',
      component: () => import('./views/Lessons.vue')
    }
  ]
})
