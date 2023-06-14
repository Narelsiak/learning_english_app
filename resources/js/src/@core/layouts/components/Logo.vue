<template>
  <a>
    <h1>Projekt IO-BD</h1>
  </a>
</template>

<script>

import { $themeConfig } from '@themeConfig'
import { computed } from '@vue/composition-api'
import useAppConfig from '@core/app-config/useAppConfig'

export default {
  setup() {
    const { skin } = useAppConfig()

    const isDark = computed(() => skin.value === 'dark')

    return {
      skin,
      isDark,
      darkLogo: $themeConfig.app.appDarkLogoImage,
      lightLogo: $themeConfig.app.appLogoImage,
    }
  },
}
</script>
