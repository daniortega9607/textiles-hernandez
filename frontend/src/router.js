import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './views/App'

Vue.use(VueRouter)

const RouterView = () => <div></div> //<router-view></router-view>;

export const routes = [
  {
    path: '/',
    component: App,
    children: [
      { path: '', component: RouterView },
      { path: '/home', component: RouterView, display_name: 'Inicio' },
    ]
  },
  { path:'/login', name:'login', component: () => import('./views/Login.vue') },
  { path:'/about', name:'about', component: () => import('./views/About') }
  /*{
    path: '/login',
    name: 'login',
    props:{message:"Crayoli"},
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about"  './views/Login')
  }*/
]

export default new VueRouter({ mode: 'history', routes })
