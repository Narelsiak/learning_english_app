import useJwt from '@/auth/jwt/useJwt'
import axios from 'axios'

export default {
  namespaced: true,
  state: {
    userData: '',
    loggedIn: JSON.stringify(false),
    user_id: JSON.stringify(0),
    bearerToken: '',
  },
  getters: {
    getLoggedIn: state => {
      const { loggedIn } = state
      if (JSON.parse(window.localStorage.getItem('loggedIn')) !== JSON.parse(loggedIn) && JSON.parse(window.localStorage.getItem('loggedIn')) === false) {
        // commit('auth/setLoggedOut')
        return false
      }
      if (JSON.parse(window.localStorage.getItem('loggedIn')) !== JSON.parse(loggedIn) && JSON.parse(window.localStorage.getItem('loggedIn')) === true) {
        return true
      }
      return JSON.parse(loggedIn)
    },
    getUserId: state => {
      let { user_id } = state
      // eslint-disable-next-line camelcase
      if (JSON.parse(user_id) === 0) {
        // eslint-disable-next-line camelcase
        user_id = window.localStorage.getItem('user_id') ?? user_id
      }
      // eslint-disable-next-line camelcase
      return JSON.parse(user_id)
    },
    getUserData: state => {
      let { userData } = state
      if (userData === '') {
        userData = window.localStorage.getItem('userData') ?? userData
      }
      return JSON.parse(userData)
    },
    getUserLives: state => {
      let { userLives } = state
      if (userLives === '') {
        userLives = window.localStorage.getItem('userLives') ?? userLives
      }
      return JSON.parse(userLives)
    },
    getBearerToken: state => {
      let { loggedIn } = state
      loggedIn = JSON.parse(loggedIn)
      if (JSON.parse(window.localStorage.getItem('loggedIn')) !== loggedIn && JSON.parse(window.localStorage.getItem('loggedIn')) === false) {
        loggedIn = false
      } else if (JSON.parse(window.localStorage.getItem('loggedIn')) !== loggedIn && JSON.parse(window.localStorage.getItem('loggedIn')) === true) {
        loggedIn = true
      }

      if (loggedIn) {
        let { bearerToken } = state
        if ((bearerToken && JSON.parse(bearerToken) === '') || !bearerToken) {
          bearerToken = window.localStorage.getItem('bearerToken') ?? bearerToken
        }
        return JSON.parse(bearerToken)
      }
      return ''
    },
  },
  mutations: {
    updateUserData(state, val) {
      state.userData = JSON.stringify(val)
      window.localStorage.setItem('userData', JSON.stringify(val))
    },
    updateUserId(state, val) {
      state.user_id = JSON.stringify(val)
      window.localStorage.setItem('user_id', JSON.stringify(val))
    },
    setBearerToken(state, value) {
      state.bearerToken = JSON.stringify(value)
      window.localStorage.setItem('bearerToken', JSON.stringify(value))
    },
    setLoggedIn(state) {
      state.loggedIn = JSON.stringify(true)
      window.localStorage.setItem('loggedIn', JSON.stringify(true))
    },
    setLoggedOut(state) {
      state.loggedIn = JSON.stringify(false)
      window.localStorage.clear()
      window.localStorage.setItem('loggedIn', JSON.stringify(false))
    },
  },
  actions: {
    login({ commit }, payload) {
      return useJwt.login(payload)
        .then(res => {
          if (res.data.success) {
            commit('setLoggedIn')
            commit('updateUserId', res.data.data.user_id)
            commit('setBearerToken', res.data.data.token)
          }
        })
    },
    logout({ commit }) {
      return useJwt.logout()
        .then(() => {
          commit('setLoggedOut')
        })
        .catch(error => {
          console.error('Błąd wylogowania:', error)
          commit('setLoggedOut')
        })
    },
    loadUserData({ commit, dispatch }) {
      return useJwt.userData()
        .then(res => {
          commit('updateUserData', res.data.data)
        })
        .catch(err => {
          dispatch('logout')
        })

    },
    register({ commit }, payload) {
      return useJwt.register(payload)
        .then(res => {
          console.log(res.data.success)
          if (res.data.success) {
            commit('setLoggedIn')
            commit('updateUserId', res.data.data.user_id)
            commit('setBearerToken', res.data.data.token)
          }
        })
    },
    setLifeCount({ commit }, newValue) {
      commit('updateLifeCount', newValue)
    },
  },
}
