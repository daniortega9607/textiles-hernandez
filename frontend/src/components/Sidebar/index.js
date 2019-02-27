import { mapState, mapActions } from 'vuex';
import './styles.scss';

const NavLink = {
  props: {
    item: { required: true }
  },
  data() {
    return {
      show: false
    }
  },
  methods: {
    toggleChildrenMenu() {
      this.show = !this.show;
    },
    shouldToggleSidebar() {
      if (window.innerWidth < 992) this.toggleSidebar();
    },
    ...mapActions('app', ['toggleSidebar'])
  },
  render(h) {
    return this.item.children
      ? (
        <div>
          <a class="nav-link pointer" onClick={this.toggleChildrenMenu}>
            {this.item.name}
            {
              this.show
                ? <i class="fas fa-arrow-up float-right"></i>
                : <i class="fas fa-arrow-down float-right"></i>
            }
          </a>
          {
            this.show
            ? this.item.children.map(item => <NavLink item={item} class='pl-5' />)
            : null
          }
        </div>
      )
      : (
        <router-link to={this.item.to} class="nav-link" nativeOnClick={this.shouldToggleSidebar}>
          {this.item.name}
        </router-link>
      )
  }
}

const MainSidebar = {
  props: {
    user: { required: true },
    handleLogout: { required: true },
    showSidebar: { default: false },
    menu: { default: () => [] }
  },
  render(h) {
    return (
      <div id='sidebar-wrapper' class={{ 'show-sidebar': this.showSidebar }}>
        <div class="h-100 sidebar-component">
          <nav class="nav flex-column">
            { this.menu.map(item => <NavLink item={item} />) }
            <a class="nav-link" onClick={this.handleLogout}>
              Cerrar Sesión
              <i class="fas fa-sign-out-alt float-right"></i>
            </a>
          </nav>
        </div>
      </div>
    )
  }
}

export default MainSidebar;
