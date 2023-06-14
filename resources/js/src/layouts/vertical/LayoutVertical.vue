<template>
  <layout-vertical>

    <router-view />

  </layout-vertical>
</template>

<script>
import LayoutVertical from '@core/layouts/layout-vertical/LayoutVertical.vue'

export default {
  components: {
    LayoutVertical,
  },
  data() {
    return {

    }
  },
  mounted() {
    const time = Date.now() / 1000
    const refTime = JSON.parse(window.localStorage.getItem('timeToRef') ?? JSON.stringify(0))
    if (refTime + (15 * 60) <= time) {
      this.$store.dispatch('auth/loadUserData')
      window.localStorage.setItem('timeToRef', JSON.stringify(time))
    }
  },
}
</script>
