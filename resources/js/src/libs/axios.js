import Vue from 'vue'
import axios from 'axios'
import { locale } from '@/libs/i18n'

const axiosIns = axios.create({
  // You can add your headers here
  // ================================
  // baseURL: 'https://some-domain.com/api/',
  // timeout: 1000,
  headers: { 'Accept-Language': locale },
})

Vue.prototype.$http = axiosIns

export default axiosIns
