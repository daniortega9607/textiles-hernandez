import Vue from 'vue'
import VueRouter from 'vue-router'
import App from './views/App'
import Settings from './views/Settings';

Vue.use(VueRouter)

const RouterView = () => <router-view></router-view>;
const DummyView = () => <div></div>;

export const routes = [
  {
    path: '/',
    component: App,
    children: [
      { path: '', component: DummyView },
      { path: '/home', component: DummyView, display_name: 'Inicio' },
      {
        path: '/gestion', component: RouterView, display_name: 'Gestion',
        children: [
          { path: '/colores', redirect:'/colores/lista', display_name: "Colores" },
          { path: '/disenos', redirect:'/disenos/lista', display_name: "Diseños" },
          { path: '/telas', redirect:'/telas/lista', display_name: "Telas" },
          { path: '/modelos', redirect:'/modelos/lista', display_name: "Modelos" },
          { path: '/sucursales', redirect:'/sucursales/lista', display_name: "Sucursales" },
          { path: '/clientes', redirect:'/clientes/lista', display_name: "Clientes" },
          { path: '/proveedores', redirect:'/proveedores/lista', display_name: "Proveedores" },
          { path: '/usuarios', redirect:'/usuarios/lista', display_name: "Usuarios" },
        ]
      },
      /*{
        path: '/reporte', component: RouterView, name: 'Reportes',
        children: [
          { path: '/reporte/ventas', redirect: '/ventas/reporte', name:'Reporte de Ventas' },
          { path: '/reporte/compras', redirect: '/compras/reporte', name:'Reporte de Compras' },
          { path: '/reporte/clientes', redirect: '/clientes/reporte', name:'Saldo de Clientes' },
          { path: '/reporte/proveedores', redirect: '/proveedores/reporte', name:'Saldo de Proveedores' },
        ]
      },*/
      //{ path: '/:entity/lista', component: EntityList },
      //{ path: '/:entity/lista/:id', component: EntityDetails },
      { path: '/ajustes', component: Settings, display_name:'Ajustes' },
    ]
  },
  { path:'/login', name:'login', component: () => import('./views/Login.vue') },
  { path: '*', redirect: '/' }
]

export default new VueRouter({ mode: 'history', routes })
