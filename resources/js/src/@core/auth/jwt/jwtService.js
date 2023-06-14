// eslint-disable-next-line import/no-cycle
import store from '@/store'
import jwtDefaultConfig from './jwtDefaultConfig'
import { locale } from "@/libs/i18n"

export default class JwtService {
  // Will be used by this service for making API calls
  axiosIns = null

  // jwtConfig <= Will be used by this service
  jwtConfig = { ...jwtDefaultConfig }

  // For Refreshing Token
  isAlreadyFetchingAccessToken = false

  constructor(axiosIns, jwtOverrideConfig) {
    this.axiosIns = axiosIns
    this.jwtConfig = { ...this.jwtConfig, ...jwtOverrideConfig }

    // Request Interceptor
    this.axiosIns.interceptors.request.use(
      config => {
        // Get token from localStorage
        const accessToken = this.getToken()

        // If token is present add it to request's Authorization Header
        if (accessToken) {
          // eslint-disable-next-line no-param-reassign
          config.headers = {
            Authorization: `${this.jwtConfig.tokenType} ${accessToken}`,
            'Accept-Language': locale,
            Accept: 'application/json',
          }
        }
        return config
      },
      error => {
        Promise.reject(error)
      },
    )

    // Add request/response interceptor
    this.axiosIns.interceptors.response.use(
      response => response,
      error => {
        const { config, response } = error

        // if (status === 401) {
        if (response && response.status === 401) {
          store.commit('auth/setLoggedOut')
          window.location.reload()
        }
        return Promise.reject(error)
      },
    )
  }

  setToken(value) {
    store.commit('auth/setBearerToken', value)
  }

  setUserData(value) {
    return store.commit('auth/updateUserData', value)
  }

  getUserData() {
    return store.getters['auth/getUserData']
  }

  getToken() {
    return store.getters['auth/getBearerToken']
  }

  getLives() {
    return store.getters['system/getUserLives']
  }


  userData(...args) {
    return this.axiosIns.get(this.jwtConfig.userDataEndpoint, ...args)
  }
  userLives(...args) {
    return this.axiosIns.get(this.jwtConfig.livesEndpoint, ...args)
  }

  login(...args) {
    return this.axiosIns.post(this.jwtConfig.loginEndpoint, ...args)
  }

  logout(...args) {
    return this.axiosIns.get(this.jwtConfig.logoutEndpoint, ...args)
  }

  register(...args) {
    return this.axiosIns.post(this.jwtConfig.registerEndpoint, ...args)
  }

}
