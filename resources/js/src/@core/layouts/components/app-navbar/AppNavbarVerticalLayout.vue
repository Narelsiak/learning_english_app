<template>
  <div class="navbar-container d-flex content align-items-center">
    <!-- Left Col -->
    <div class="bookmark-wrapper align-items-center flex-grow-1 d-none d-lg-flex">
      <!-- Bookmarks Container -->
      <!--      <bookmarks />-->
<!--      <dark-Toggler class="d-none d-md-block d-lg-block" />-->
    </div>

    <b-navbar-nav class="nav align-items-center ml-auto">
      <!--      <notification-dropdown />-->
      <user-dropdown />
    </b-navbar-nav>
  </div>
</template>

<script>
import {
  BLink, BNavbarNav,
} from 'bootstrap-vue'
import DarkToggler from './components/DarkToggler.vue'
// import NotificationDropdown from './components/NotificationDropdown.vue'
import UserDropdown from './components/UserDropdown.vue'

export default {
  components: {
    BLink,
    // Navbar Components
    BNavbarNav,
    DarkToggler,
    // NotificationDropdown,
    UserDropdown,
  },
  props: {
    toggleVerticalMenuActive: {
      type: Function,
      default: () => {},
    },
  },
}
</script>
