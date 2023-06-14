<template>
  <b-overlay :show="showOverlay">
    <b-row>
      <b-col md="6">
        <h2 class="my-2">
          Twoje osiągniecia
        </h2>
      </b-col>
      <b-col
        md="6"
        style="text-align-last: end;"
      >
        <b-button variant="primary" to="/">
          &lt; Powrót do strony głównej
        </b-button>
      </b-col>
    </b-row>
    <b-row>
      <b-col
        v-for="(achievement, achievementKey) in achievementsHas"
        :key="achievementKey"
        xs="6"
        sm="6"
        md="3"
        lg="2"
        xl="2"
        xxl="1"
      >
        <b-card :style="`background-color: ${achievement.has ? '#fff' : '#ebebeb'}`">
          <b-img-lazy
            v-if="achievement.photo_url ? achievement.photo_url.length > 0 : false"
            :src="achievement.photo_url"
            class="mb-2"
            style="width: 100%"
          />
          <b-avatar
            v-else
            :text="achievement.name"
            class="mb-2"
            rounded="sm"
            style="width: 100%;aspect-ratio: 1;height: auto"
          />
          <b-card-title>{{ achievement.name }}</b-card-title>
          <b-card-text>{{ achievement.description }}</b-card-text>
        </b-card>
      </b-col>
    </b-row>
    <hr>
    <h2 class="my-2">
      Dostępne osiągniecia
    </h2>
    <b-row>
      <b-col
        v-for="(achievement, achievementKey) in achievementsNotHas"
        :key="achievementKey"
        xs="6"
        sm="6"
        md="3"
        lg="2"
        xl="2"
        xxl="1"
      >
        <b-card :style="`background-color: ${achievement.has ? '#fff' : '#ebebeb'}`">
          <b-img-lazy
            v-if="achievement.photo_url ? achievement.photo_url.length > 0 : false"
            :src="achievement.photo_url"
            class="mb-2"
            style="width: 100%"
          />
          <b-avatar
            v-else
            :text="achievement.name"
            class="mb-2"
            rounded="sm"
            style="width: 100%;aspect-ratio: 1;height: auto"
          />
          <b-card-title>{{ achievement.name }}</b-card-title>
          <b-card-text>{{ achievement.description }}</b-card-text>
        </b-card>
      </b-col>
    </b-row>
  </b-overlay>
</template>

<script>
import useJwt from '@/auth/jwt/useJwt'
import {
  BCard, BCardTitle, BCol, BRow, BOverlay, BCardText, BImgLazy, BAvatar, BButton,
} from 'bootstrap-vue'

export default {
  name: 'Achievements',
  components: {
    BCol, BRow, BCard, BCardTitle, BCardText, BOverlay, BImgLazy, BAvatar, BButton,
  },
  data() {
    this.showOverlay = true
    useJwt.axiosIns.get('/api/system/achievement/me')
      .then(res => {
        res.data.data.forEach(ach => {
          if (ach.has) {
            this.achievementsHas.push(ach)
          } else {
            this.achievementsNotHas.push(ach)
          }
        })
        this.showOverlay = false
      })
      .catch(err => {
        console.log(err)
        this.showOverlay = false
      })
    return {
      showOverlay: true,
      achievementsHas: [],
      achievementsNotHas: [],
    }
  },
}
</script>

<style scoped>

</style>
