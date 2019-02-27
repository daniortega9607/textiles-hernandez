import Vue from 'vue';
import Vuex from 'vuex';
import auth from './auth';
import app from './app';
import entity from './entity';
Vue.use(Vuex);

const Store = {
  modules:{
    auth,
    app,
    entity
  }
}

export default new Vuex.Store(Store);