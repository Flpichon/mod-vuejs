import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
import Eleve from './views/Eleve.vue'
import Matiere from './views/Matiere.vue'
import NotFound from './views/NotFound'
Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (about.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import(/* webpackChunkName: "about" */ './views/About.vue')
    },
    {
      path: '/404', component: NotFound
    },
    {
      path: '*', redirect: '/404'
    },
    {
      path: '/eleve',
      name: 'eleve',
      component: Eleve
    },
    {
      path: '/matiere',
      name: 'matiere',
      component: Matiere
    },
  ]
})
