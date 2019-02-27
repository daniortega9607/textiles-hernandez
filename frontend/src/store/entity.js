import Entities from "../utils/entities";

const state = {
  colores: Entities.colores,
  disenos: Entities.disenos,
  telas: Entities.telas,
  modelos: Entities.modelos,
  clientes: Entities.clientes,
  saldo_clientes: Entities.saldo_clientes,
  proveedores: Entities.proveedores,
  saldo_proveedores: Entities.saldo_proveedores,
  usuarios: Entities.usuarios,
  ajustes: Entities.ajustes,
  reporte_ventas: Entities.reporte_ventas,
  reporte_compras: Entities.reporte_compras,
  ventas: Entities.ventas,
  almacen: Entities.almacen,
};

const getters = {};

const actions = {
  getEntityInfo({state}, { entity }) {
    return state[entity];
  }
};

const mutations = {};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};