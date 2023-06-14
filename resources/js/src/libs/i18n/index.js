import Vue from 'vue'
import VueI18n from 'vue-i18n'

Vue.use(VueI18n)
function loadLocaleMessages() {
  const locales = require.context('./locales', true, /[A-Za-z0-9-_,\s]+\.json$/i)
  const messages = {}
  locales.keys().forEach(key => {
    const matched = key.match(/([A-Za-z0-9-_]+)\./i)
    if (matched && matched.length > 1) {
      const locale = matched[1]
      messages[locale] = locales(key)
    }
  })
  return messages
}

export const allowedLocales = [
  'pl', 'en',
]
const urlLocale = window.location.pathname.split('/')[1]
if (!urlLocale) {
  window.location.replace(`/en${window.location.pathname}`)
}
export const locale = urlLocale && allowedLocales.includes(urlLocale) ? urlLocale : 'en'

// eslint-disable-next-line func-names
export const createLocaleUrl = function (localeToSet) {
  const urlPath = window.location.pathname.split('/')
  urlPath[1] = localeToSet
  return urlPath.join('/')
}

export default new VueI18n({
  locale,
  fallbackLocale: 'pl',
  messages: loadLocaleMessages(),
})
