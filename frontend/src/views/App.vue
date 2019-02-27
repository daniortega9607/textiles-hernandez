<template>
  <div :class="{'show-sidebar':showSidebar, 'h-100':true}" v-if="authenticated">
    <MainNavbar :user="user" :handleLogout="handleLogout"/>
    <Sidebar
      :user="user"
      :handleLogout="handleLogout"
      :showSidebar="showSidebar"
      :menu="menu"
    />
    <main id="content-wrapper" class="h-100">
      <div class="py-4">
        <router-view id="main-wrapper"/>
      </div>
    </main>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';
import MainNavbar from '../components/MainNavbar';
import Sidebar from '../components/Sidebar';

export default {
  components:{ MainNavbar, Sidebar },
  async created(){
    if(!await this.isAuthenticated()) {
      this.logout({ callback: this.redirectToLogin });
    }
  },
  methods: {
    redirectToLogin() {
      this.$router.replace('/login');
    },
    handleLogout() {
      this.logout({ callback: this.redirectToLogin })
    },
    ...mapActions('auth',['isAuthenticated', 'logout'])
  },
  computed: {
    ...mapState('auth',['authenticated','user']),
    ...mapState('app',['showSidebar','menu']),
  }
}
</script>

<style scoped>
#content-wrapper {
  margin-left: 0px;
  overflow: auto;
  transition: all 0.5s;
}

#main-wrapper {
  padding-top: 50px;
}

.show-sidebar #content-wrapper {
  margin-left: 220px;
}

@media (max-width: 767px) {
  .show-sidebar #content-wrapper {
    margin-left: 0px;
  }
}
</style>
