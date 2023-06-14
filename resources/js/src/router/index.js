import Vue from 'vue'
import VueRouter from 'vue-router'
import { locale } from '@/libs/i18n'
import mainRoutes from './routes/main'
import errorRoutes from './routes/errors'
import store from '../store/index'

Vue.use(VueRouter)

let routes = []
routes = routes.concat(mainRoutes)
routes = routes.concat(errorRoutes)

const router = new VueRouter({
  mode: 'history',
  base: `${locale}`,
  scrollBehavior() {
    return { x: 0, y: 0 }
  },
  routes,
})

// ? For splash screen
// Remove afterEach hook if you are not using splash screen
router.afterEach(() => {
  // Remove initial loading
  const appLoading = document.getElementById('loading-bg')
  if (appLoading) {
    appLoading.style.display = 'none'
  }
})
router.beforeEach(async (to, from, next) => {
  if (to.meta.loggedIn === true) {
    if (store.getters['auth/getLoggedIn'] !== true) {
      return next({ name: 'login' })
    }
    let roleIsGood = false
    to.meta.roles.forEach(value => {
      if (store.getters['auth/getUserData'].role === value) {
        roleIsGood = true
      }
    })
    if (roleIsGood !== true) {
      return next({ name: 'error-403' })
    }
  } else if (to.meta.loggedIn === false) {
    if (store.getters['auth/getLoggedIn'] === true) {
      return next({ name: 'home' })
    }
  }

  return next()
})

export default router
