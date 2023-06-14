<template>
  <div
    id="app"
    class="h-100"
    :class="[skinClasses]"
  >
    <component :is="layout">
      <router-view />
    </component>
    <floating-heart v-if="loggedIn" />
  </div>
</template>

<script>

// This will be populated in `beforeCreate` hook
import { $themeColors, $themeBreakpoints, $themeConfig } from '@themeConfig'
import { provideToast } from 'vue-toastification/composition'
import { watch } from '@vue/composition-api'
import useAppConfig from '@core/app-config/useAppConfig'
import floatingHeart from '@core/components/floaters/floatingHeart.vue'

import { useWindowSize, useCssVar, timestamp } from '@vueuse/core'

import store from '@/store'
import LayoutFull from '@/layouts/full/LayoutFull.vue'
import axios from 'axios'
import { eventBus } from '@/store/eventBus'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'
const LayoutVertical = () => import('@/layouts/vertical/LayoutVertical.vue')

export default {
  components: {

    // Layouts
    LayoutVertical,
    LayoutFull,
    floatingHeart,

  },
  data() {
    const loggedIn = this.$store.getters['auth/getLoggedIn']
    return {
      loggedIn,
      nextHeartTime: 0,
    }
  },
  // ! We can move this computed: layout & contentLayoutType once we get to use Vue 3
  // Currently, router.currentRoute is not reactive and doesn't trigger any change
  computed: {

    layout() {
      if (this.$route.meta.layout === 'full') return 'layout-full'
      return `layout-${this.contentLayoutType}`
    },
    contentLayoutType() {
      return this.$store.state.appConfig.layout.type
    },
  },
  mounted() {
    this.checkIfHeartCanBeSpawned()
  },

  beforeCreate() {
    // Set colors in theme
    const colors = ['primary', 'secondary', 'success', 'info', 'warning', 'danger', 'light', 'dark']

    // eslint-disable-next-line no-plusplus
    for (let i = 0, len = colors.length; i < len; i++) {
      $themeColors[colors[i]] = useCssVar(`--${colors[i]}`, document.documentElement).value.trim()
    }

    // Set Theme Breakpoints
    const breakpoints = ['xs', 'sm', 'md', 'lg', 'xl']

    // eslint-disable-next-line no-plusplus
    for (let i = 0, len = breakpoints.length; i < len; i++) {
      $themeBreakpoints[breakpoints[i]] = Number(useCssVar(`--breakpoint-${breakpoints[i]}`, document.documentElement).value.slice(0, -2))
    }

    // Set RTL
    const { isRTL } = $themeConfig.layout
    document.documentElement.setAttribute('dir', isRTL ? 'rtl' : 'ltr')
  },
  created() {
    eventBus.$on('displayAchievement', achievementName => {
      this.achievementToast(achievementName)
    })
  },
  beforeDestroy() {
    eventBus.$off('displayAchievement')
  },
  methods: {
    achievementToast(achievementName) {
      this.$toast({
        component: ToastificationContent,
        props: {
          title: 'Zdobyto Osiągnięcie!',
          text: achievementName,
          icon: 'UserIcon',
          variant: 'success',
        },
      })
    },
    checkIfHeartCanBeSpawned() {
      if (this.$store.getters['auth/getLoggedIn'] === true) {
        axios.get('/api/system/daily_user_life', {
          headers: {
            Authorization: `Bearer ${JSON.parse(localStorage.getItem('bearerToken'))}`,
          },
        })
          .then(response => {
            this.nextHeartTime = response.data.data.next_heart_unix_time
            if (this.nextHeartTime < timestamp()) {
              console.log('można pokazac serce')
              eventBus.$emit('spawnHeart')
            } else {
              console.log('nie można pokazac serce')
              eventBus.$emit('spawnHeart')
            }
          })
          .catch(error => {
            console.log(error)
          })
      } else {
        console.log('nie zalogowany')
      }
    },
  },
  setup() {
    const { skin, skinClasses } = useAppConfig()

    // If skin is dark when initialized => Add class to body
    if (skin.value === 'dark') document.body.classList.add('dark-layout')

    // Provide toast for Composition API usage
    // This for those apps/components which uses composition API
    // Demos will still use Options API for ease
    provideToast({
      hideProgressBar: true,
      closeOnClick: false,
      closeButton: false,
      icon: false,
      timeout: 3000,
      transition: 'Vue-Toastification__fade',
    })

    // Set Window Width in store
    store.commit('app/UPDATE_WINDOW_WIDTH', window.innerWidth)
    const { width: windowWidth } = useWindowSize()
    watch(windowWidth, val => {
      store.commit('app/UPDATE_WINDOW_WIDTH', val)
    })

    return {
      skinClasses,
    }
  },
}
</script>
