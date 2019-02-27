import { 
  CurrencyFormatter,
  ColorBox,
  UserType,
  UserTypes,
  DateFormatter,
  NumberFormatted,
  NumberFormatter,
  currencies
} from "../utils";
import SearchBoxList from "../components/Form/SearchBoxList";

const validateBalance = function() {
  const total = NumberFormatted(this.total);
  const balance = NumberFormatted(this.balance);
  if(parseFloat(balance) > 0) {
    if(total == balance){
      return 'table-danger'
    } else return 'table-info'
  }
  else return 'table-success'
}

export const colores = {
  url: '/colors',
  display_name: 'Colores',
  single_name: 'Color',
  primary_field: 'name',
  showAddButton: true,
  showDeleteButton: true,
  showEditButton: true,
  model: {
    id: { auto_generated: true },
    name: { default: null, required: true, render_type: 'text', editable: true, autofocus: true, display_name: 'Nombre' },
    value: { default: '#ffffff', required: true, render_type: 'color', editable: true, display_name: 'Color' }
  },
  fields: [
    { display_name: 'ID', display: true, key: 'id', is_primary: true },
    { display_name: 'Nombre', display: true, key: 'name' },
    { display_name: 'Color', display: true, key: 'value', formatter: ColorBox }
  ]
}

export const disenos = {
  url: '/designs',
  display_name: 'Diseños',
  single_name: 'Diseño',
  primary_field: 'name',
  showAddButton: true,
  showDeleteButton: true,
  showEditButton: true,
  model: {
    id: { auto_generated: true },
    name: { default: null, required: true, render_type: 'text', editable: true, autofocus: true, display_name: 'Nombre' },
  },
  fields: [
    { display_name: 'ID', display: true, key: 'id', is_primary: true },
    { display_name: 'Nombre', display: true, key: 'name' },
  ]
}

export const telas = {
  url: '/fabrics',
  display_name: 'Telas',
  single_name: 'Tela',
  primary_field: 'name',
  showAddButton: true,
  showDeleteButton: true,
  showEditButton: true,
  model: {
    id: { auto_generated: true },
    name: { default: null, required: true, render_type: 'text', editable: true, autofocus: true, display_name: 'Nombre' },
    buy_price: { default: null, render_type: 'number', editable: true, display_name: 'Precio de Compra' },
    sell_price: { default: null, render_type: 'number', editable: true, display_name: 'Precio de Venta' },
  },
  fields: [
    { display_name: 'ID', display: true, key: 'id', is_primary: true },
    { display_name: 'Nombre', display: true, key: 'name' },
    { display_name: 'Precio de Compra', display: true, key: 'buy_price', formatter: CurrencyFormatter, render_type: 'number' },
    { display_name: 'Precio de Venta', display: true, key: 'sell_price', formatter: CurrencyFormatter, render_type: 'number' },
  ]
}

export const modelos = {
  url: '/fabric_patterns',
  display_name: 'Modelos',
  single_name: 'Modelo',
  primary_field: 'sku',
  showAddButton: true,
  showDeleteButton: true,
  showEditButton: true,
  model: {
    id: { auto_generated: true },
    sku: { default: null, required: true, render_type: 'text', editable: true, autofocus: true, display_name: 'Código' },
    fabric_id: { 
      default: null, required: true, render_type: 'custom', editable: true, display_name: 'Tela',
      renderer: SearchBoxList, props: { entity:telas }
    },
    design_id: { 
      default: null, render_type: 'custom', editable: true, display_name: 'Diseño',
      renderer: SearchBoxList, props: { entity:disenos }
    },
    color_id: { 
      default: null, render_type: 'custom', editable: true, display_name: 'Color',
      renderer: SearchBoxList, props: { entity:colores }
    },
  },
  fields: [
    { display_name: 'ID', display: true, key: 'id', is_primary: true },
    { display_name: 'Código', display: true, key: 'sku' },
    { display_name: 'Tela', display: true, key: 'fabric.name' },
    { display_name: 'Diseño', display: true, key: 'design.name' },
    { display_name: 'Color', display: true, key: 'color.name' },
  ]
}

export const clientes = {
  url: '/customers',
  display_name: 'Clientes',
  single_name: 'Cliente',
  primary_field: 'name',
  showAddButton: true,
  showDeleteButton: true,
  showEditButton: true,
  model: {
    id: { auto_generated: true },
    name: { default: null, required: true, render_type: 'text', editable: true, autofocus: true, display_name: 'Nombre' },
    address: { default: null, render_type: 'text', editable: true, display_name: 'Direccion' },
    telephone: { default: null, render_type: 'text', editable: true, display_name: 'Telefono' },
    mobilephone: { default: null, render_type: 'text', editable: true, display_name: 'Celular' },
    email: { default: null, render_type: 'email', editable: true, display_name: 'Correo' },
    credit_days: { default: null, render_type: 'number', editable: true, display_name: 'Dias de Crédito' },
    comments: { default: null, render_type: 'textarea', editable: true, display_name: 'Observaciones' },
  },
  fields: [
    { display_name: 'ID', display: true, key: 'id', is_primary: true },
    { display_name: 'Nombre', display: true, key: 'name' },
    { display_name: 'Direccion', display: true, key: 'address' },
    { display_name: 'Telefono', display: true, key: 'telephone' },
    { display_name: 'Celular', display: true, key: 'mobilephone' },
    { display_name: 'Correo', display: true, key: 'email' },
    { display_name: 'Dias de Credito', display: true, key: 'credit_days' },
    { display_name: 'Observaciones', display: true, key: 'comments' },
  ]
}

export const saldo_clientes = {
  url: '/customers',
  display_name: 'Saldo de Clientes',
  fields: [
    { display_name: 'ID', display: true, key: 'id', is_primary: true },
    { display_name: 'Nombre', display: true, key: 'name' },
    { display_name: 'Saldo', display: true, key: 'balance.total', is_primary: true, formatter: CurrencyFormatter, render_type: 'number' },
    { display_name: 'Direccion', display: true, key: 'address' },
    { display_name: 'Telefono', display: true, key: 'telephone' },
    { display_name: 'Celular', display: true, key: 'mobilephone' },
    { display_name: 'Correo', display: true, key: 'email' },
    { display_name: 'Dias de Credito', display: true, key: 'credit_days' },
    { display_name: 'Observaciones', display: true, key: 'comments' },
  ]
}

export const proveedores = {
  url: '/suppliers',
  display_name: 'Proveedores',
  single_name: 'Proveedor',
  primary_field: 'name',
  showAddButton: true,
  showDeleteButton: true,
  showEditButton: true,
  model: {
    id: { auto_generated: true },
    name: { default: null, required: true, render_type: 'text', editable: true, autofocus: true, display_name: 'Nombre' },
    address: { default: null, render_type: 'text', editable: true, display_name: 'Direccion' },
    telephone: { default: null, render_type: 'text', editable: true, display_name: 'Telefono' },
    mobilephone: { default: null, render_type: 'text', editable: true, display_name: 'Celular' },
    email: { default: null, render_type: 'email', editable: true, display_name: 'Correo' },
    credit_days: { default: null, render_type: 'number', editable: true, display_name: 'Dias de Crédito' },
    comments: { default: null, render_type: 'textarea', editable: true, display_name: 'Observaciones' },
  },
  fields: [
    { display_name: 'ID', display: true, key: 'id', is_primary: true },
    { display_name: 'Nombre', display: true, key: 'name' },
    { display_name: 'Direccion', display: true, key: 'address' },
    { display_name: 'Telefono', display: true, key: 'telephone' },
    { display_name: 'Celular', display: true, key: 'mobilephone' },
    { display_name: 'Correo', display: true, key: 'email' },
    { display_name: 'Observaciones', display: true, key: 'comments' },
  ]
}

export const saldo_proveedores = {
  url: '/suppliers',
  display_name: 'Saldo de Proveedores',
  fields: [
    { display_name: 'ID', display: true, key: 'id', is_primary: true },
    { display_name: 'Nombre', display: true, key: 'name' },
    { display_name: 'Saldo', display: true, key: 'balance.total', is_primary: true, formatter: CurrencyFormatter, render_type: 'number' },
    { display_name: 'Direccion', display: true, key: 'address' },
    { display_name: 'Telefono', display: true, key: 'telephone' },
    { display_name: 'Celular', display: true, key: 'mobilephone' },
    { display_name: 'Correo', display: true, key: 'email' },
    { display_name: 'Dias de Credito', display: true, key: 'credit_days' },
    { display_name: 'Observaciones', display: true, key: 'comments' },
  ]
}

export const usuarios = {
  url: '/users',
  display_name: 'Usuarios',
  single_name: 'Usuario',
  primary_field: 'name',
  showAddButton: true,
  showDeleteButton: true,
  showEditButton: true,
  model: {
    id: { auto_generated: true },
    name: { default: null, required: true, render_type: 'text', editable: true, autofocus: true, display_name: 'Nombre' },
    email: { default: null, required: true, render_type: 'email', editable: true, display_name: 'Correo' },
    user_type: { default: null, required: true, render_type: 'select', editable: true, display_name: 'Tipo de Usuario', values: UserTypes},
    password: { default: null, required: true, render_type: 'password', display_name: 'Contraseña' },
    c_password: { default: null, required: true, render_type: 'password', display_name: 'Confirma Contraseña' },
  },
  fields: [
    { display_name: 'ID', display: true, key: 'id', is_primary: true },
    { display_name: 'Nombre', display: true, key: 'name' },
    { display_name: 'Correo', display: true, key: 'email' },
    { display_name: 'Tipo de usuario', display: true, key: 'user_type', formatter: UserType },
  ]
}

export const ajustes = {
  url: '/users',
  primary_field: 'name',
  model: {
    id: { auto_generated: true },
    name: { default: null, required: true, render_type: 'text', editable: true, autofocus: true, display_name: 'Nombre' },
    email: { default: null, required: true, render_type: 'email', editable: true, display_name: 'Correo' },
    password: { default: null, render_type: 'password', editable:true, display_name: 'Contraseña actual' },
    n_password: { default: null, render_type: 'password', editable:true, display_name: 'Contraseña nueva' },
    c_password: { default: null, render_type: 'password', editable:true, display_name: 'Confirmar Contraseña nueva' },
  },
}

export const almacen = {
  url: '/stocks',
  display_name: 'Almacen',
  single_name: 'Almacen',
  primary_field: 'name',
  showAddButton: true,
  model: {
    id: { auto_generated: true },
    fabric_pattern_id: { 
      default: null, required:true, editable:true, autofocus: true, render_type: 'custom', display_name: 'Modelo',
      renderer: SearchBoxList, props: { entity:modelos }
    }
  },
  fields: [
    { display_name: 'ID', display: true, key: 'id', is_primary: true },
    { display_name: 'Tela', display: true, key: 'name' },
    { display_name: 'Cantidad Restante', display: true, key: 'remaining_quantity', formatter: NumberFormatter, render_type: 'number' },
  ]
}

export const ventas = {
  url: '/sales',
  display_name: 'Ventas',
  single_name: 'Venta',
  primary_field: 'id',
  showAddButton: true,
  showDeleteButton: true,
  showEditButton: true,
  model: {
    id: { auto_generated: true },
    customer_id: { 
      default: null, render_type: 'custom', editable: true, display_name: 'Cliente',
      renderer: SearchBoxList, props: { entity:clientes }
    },
    currency: { default: 1, required: true, render_type: 'select', editable: true, display_name: 'Tipo de Cambio', values: currencies},
    update_stock: { default: true, render_type: 'checkbox', display_name: 'Actualizar Almacen', props: { label:'Si' } },
    /*fabric_pattern_id: { 
      default: null, render_type: 'custom', display_name: 'Modelo',
      renderer: SearchBoxList, props: { entity:modelos }
    },
    price: { default: null, render_type: 'number', display_name: 'Precio Unitario' },*/
  },
  fields: [
    { display_name: 'ID', display: true, key: 'id', is_primary: true },
    { display_name: 'Fecha', display: true, key: 'created_at',formatter: DateFormatter, render_type: 'datetime' },
    { display_name: 'Cliente', display: true, key: 'customer.name' },
    { display_name: 'Moneda', display: true, key: 'currency' },
    { display_name: 'Total', display: true, key: 'total', is_primary: true, formatter: CurrencyFormatter, render_type: 'number' },
    { display_name: 'Saldo', display: true, key: 'balance', is_primary: true, formatter: CurrencyFormatter, render_type: 'number' },
    { display_name: 'Comisión', display: true, key: 'commission', is_primary: true, formatter: CurrencyFormatter, render_type: 'number' },
    { display_name: 'Vendedor', display: true, key: 'user.name' },
  ]
}

export const reporte_ventas = {
  url: '/sales',
  getClass: validateBalance,
  display_name: 'Reporte de Ventas',
  fields: [
    { display_name: 'ID', display: true, key: 'id', is_primary: true },
    { display_name: 'Fecha', display: true, key: 'created_at',formatter: DateFormatter, render_type: 'datetime' },
    { display_name: 'Cliente', display: true, key: 'customer.name' },
    { display_name: 'Moneda', display: true, key: 'currency' },
    { display_name: 'Total', display: true, key: 'total', is_primary: true, formatter: CurrencyFormatter, render_type: 'number' },
    { display_name: 'Saldo', display: true, key: 'balance', is_primary: true, formatter: CurrencyFormatter, render_type: 'number' },
    { display_name: 'Comisión', display: true, key: 'commission', is_primary: true, formatter: CurrencyFormatter, render_type: 'number' },
    { display_name: 'Ganancia', display: true, key: 'revenue', is_primary: true, formatter: CurrencyFormatter, render_type: 'number' },
    { display_name: 'Vendedor', display: true, key: 'user.name' },
  ]
}

export const reporte_compras = {
  url: '/purchases',
  getClass: validateBalance,
  display_name: 'Reporte de Compras',
  fields: [
    { display_name: 'ID', display: true, key: 'id', is_primary: true },
    { display_name: 'Fecha', display: true, key: 'created_at',formatter: DateFormatter, render_type: 'datetime' },
    { display_name: 'Proveedor', display: true, key: 'supplier.name' },
    { display_name: 'Moneda', display: true, key: 'currency' },
    { display_name: 'Total', display: true, key: 'total', is_primary: true, formatter: CurrencyFormatter, render_type: 'number' },
    { display_name: 'Saldo', display: true, key: 'balance', is_primary: true, formatter: CurrencyFormatter, render_type: 'number' },
    { display_name: 'Comprador', display: true, key: 'user.name' },
  ]
}

export default {
  colores,
  disenos,
  telas,
  modelos,
  clientes,
  saldo_clientes,
  proveedores,
  saldo_proveedores,
  usuarios,
  ajustes,
  ventas,
  reporte_ventas,
  reporte_compras,
  almacen
}