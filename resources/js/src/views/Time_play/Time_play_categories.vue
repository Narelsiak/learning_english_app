<template>
  <b-overlay :show="showOverlay">
    <b-row>
      <b-col md="6">
        <h2 class="my-2">
          Wybierz gre czasową
        </h2>
      </b-col>
      <b-col
        md="6"
        style="text-align-last: end;"
      >
        <b-button
          variant="primary"
          to="/"
        >
          &lt; Powrót do strony głównej
        </b-button>
      </b-col>
    </b-row>
    <b-row class="justify-content-center">
      <b-col md="4">
        <b-card
          title="Gra 15 sekundowa"
          style="text-align-last: center;">
          <b-button
            size="lg"
            variant="primary d-block m-2"
            :to="{ name: 'play.show', params: { num_sec: 15}}"
          >Zacznij rozgrywkę</b-button>
          <b-button
            size="lg"
            variant="primary d-block m-2"
            :to="{ name: 'time_play.time_play_history', params: { num_sec: 15}}"
          >Pokaż historię</b-button>
        </b-card>
      </b-col>
      <b-col md="4">
        <b-card
          title="Gra 30 sekundowa"
          style="text-align-last: center;"
        >
          <b-button
            size="lg"
            variant="primary d-block m-2"
            :to="{ name: 'play.show', params: { num_sec: 30}}"
          >Zacznij rozgrywkę</b-button>
          <b-button
            size="lg"
            variant="primary d-block m-2"
            :to="{ name: 'time_play.time_play_history', params: { num_sec: 30}}"
          >Pokaż historię</b-button>
        </b-card>
      </b-col>
      <b-col md="4">
        <b-card
          title="Gra 60 sekundowa"
          style="text-align-last: center;"
        >
          <b-button
            size="lg"
            variant="primary d-block m-2"
            :to="{ name: 'play.show', params: { num_sec: 60}}"
          >Zacznij rozgrywkę</b-button>
          <b-button
            size="lg"
            variant="primary d-block m-2"
            :to="{ name: 'time_play.time_play_history', params: { num_sec: 60}}"
          >Pokaż historię</b-button>
        </b-card>
      </b-col>
    </b-row>
  </b-overlay>
</template>

<script>
import useJwt from '@/auth/jwt/useJwt'
import {
  BCard, BCardTitle, BCol, BRow, BOverlay, BImgLazy, BAvatar, BButton, BDropdown, BDropdownItem,
} from 'bootstrap-vue'

export default {
  name: 'Achievements',
  components: {
    BCol, BRow, BCard, BCardTitle, BOverlay, BImgLazy, BAvatar, BButton, BDropdown, BDropdownItem,
  },
  data() {
    return {
      showOverlay: false,
    }
  },
}
</script>

<style scoped>

</style>
