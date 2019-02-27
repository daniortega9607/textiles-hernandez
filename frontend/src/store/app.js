import { routes } from "../router";
import { fetch } from "../utils";

const getMenu = (router) => {
  let routes = [];
  router.forEach(route => {
    if(route.children && route.display_name) {
      const children = getMenu(route.children);
      if(children.length) {
        routes.push({ name: route.display_name, children });
      }
    } else if(route.display_name) {
      routes.push({ to: route.path, name: route.display_name });
    } else if(route.children) {
      const children = getMenu(route.children);
      if(children.length) routes = routes.concat(children);
    }
  });
  return routes;
};

const state = {
  showSidebar: window.innerWidth > 991,
  selectedOffice: {},
  offices: [],
  menu: getMenu(routes)
};

const getters = {};

const actions = {
  async setOffices({commit}) {
    const [err,offices] = await fetch({url:'/api/offices'});
    if(!err) commit('setOffices',{ offices })
  },
  selectOffice({commit}, office){
    commit('selectOffice', office);
  },
  toggleSidebar({ commit }) {
    commit('toggleSidebar')
  }
};

const mutations = {
  selectOffice(state, office) {
    state.selectedOffice = office;
  },
  setOffices(state, { offices }){
    state.offices = offices;
  },
  toggleSidebar(state) {
    state.showSidebar = !state.showSidebar;
  }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};