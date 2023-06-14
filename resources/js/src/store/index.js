import Vue from 'vue'
import Vuex from 'vuex'

// Modules
import app from './app'
import appConfig from './app-config'
import verticalMenu from './vertical-menu'
// eslint-disable-next-line import/no-cycle
import auth from './auth'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    auth,
    app,
    appConfig,
    verticalMenu,
  },
  strict: process.env.DEV,
})
