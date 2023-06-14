<template>
  <div>
    <div class="bv-d-xs-down-none">
    <span class="counter-value with-space">
      <BIconHeartFill :style="{ color: 'rgb(' + (95 + 8 * lifeCount) + ', 0, 0)' }" /> {{ lifeCount }}</span>

    <span class="counter-value with-space">💰 {{ coinCount }}</span>

    <span class="counter-value with-space">🔥 {{ streakCount }}</span>
    <img
      v-if="me && me.photo_url && me.photo_url.length > 0"
      :src="me.photo_url"
      style="border-radius: 100%;object-fit: cover;height: 2.5rem;aspect-ratio: 1;"
    >
    <b-avatar
      v-else
      variant="primary"
      :to="{name:'change_avatar'}"
      button
    />
    <b-dropdown variant="link" :text="`${this.me.name} ${this.me.surname}`" right>
      <b-dropdown-item :to="{name:'profil'}">Profil</b-dropdown-item>
      <b-dropdown-item :to="{name:'change_avatar'}">Zmień Awatar</b-dropdown-item>

      <b-dropdown-item @click="handleLogout">Wyloguj</b-dropdown-item>
    </b-dropdown>
    </div>
    <!-- Jesli maly obraz -->
  <div class="d-sm-none">
    <b-dropdown
      variant="link"
      :text="`${this.me.name} ${this.me.surname}`"
      right
    >
    <div class="d-flex justify-content-center">
        <span class="counter-value with-space">
        <BIconHeartFill :style="{ color: 'rgb(' + (95 + 8 * lifeCount) + ', 0, 0)' }" /> {{ lifeCount }}</span>

        <span class="counter-value with-space">💰 {{ coinCount }}</span>

        <span class="counter-value with-space">🔥 {{ streakCount }}</span>
        <img
        v-if="me && me.photo_url && me.photo_url.length > 0"
        :src="me.photo_url"
        style="border-radius: 100%;object-fit: cover;height: 2.5rem;aspect-ratio: 1;"
        >
        <b-avatar
        v-else
        variant="primary"
        :to="{name:'change_avatar'}"
        button
        />
    </div>
      <b-dropdown-item
        :to="{name:'profil'}"
      >
        Profil
      </b-dropdown-item>
      <b-dropdown-item
        :to="{name:'change_avatar'}"
      >
        Zmień Awatar
      </b-dropdown-item>

      <b-dropdown-item
        @click="handleLogout"
      >
        Wyloguj
      </b-dropdown-item>
    </b-dropdown>
    </div>
  </div>
</template>

<script>
import {
  BDropdown,
  BDropdownItem,
  BIconHeartFill,
  BAvatar,
} from 'bootstrap-vue'
import { eventBus } from '@/store/eventBus'

import useJwt from '@/auth/jwt/useJwt'

// axios.defaults.headers.common.Authorization = `Bearer ${  JSON.parse(localStorage.getItem('bearerToken'))}`
export default {
  components: {
    BDropdown,
    BDropdownItem,
    BIconHeartFill,
    BAvatar,
  },
  data() {
    useJwt.axiosIns.get('/api/auth/user/data/me')
      .then(res => {
        this.me = res.data.data
      })
    return {
      lifeCount: 0,
      coinCount: 0,
      streakCount: 0,
      me: [],
    }
  },
  computed: {
    dropdownText() {
      const userData = this.$store.getters['auth/getUserData']
      return `${userData.name} ${userData.surname}`
    },
  },
  mounted() {
    this.fetchLifeCount()
    this.fetchDailyStreak()
    this.fetchMoney()
    eventBus.$on('refreshHearts', this.fetchLifeCount)
    eventBus.$on('refreshMoneyAndStreak', this.fetchDailyStreak)
    eventBus.$on('refreshMoneyAndStreak', this.fetchMoney)
  },
  methods: {
    fetchMoney() {
      useJwt.axiosIns.get('/api/auth/user/data/me')
        .then(response => {
          this.coinCount = response.data.data.money
          localStorage.setItem('money', response.data.data.money)
        })
        .catch(error => {
          console.log(error)
        })
    },
    fetchLifeCount() {
      useJwt.axiosIns.get('/api/system/daily_user_life')
        .then(response => {
          this.lifeCount = response.data.data.life_count
          localStorage.setItem('life_count', response.data.data.life_count)

          this.heartColor()
        })
        .catch(error => {
          console.log(error)
        })
    },
    fetchDailyStreak() {
      useJwt.axiosIns.get('/api/system/streak/latest')
        .then(response => {
          if (response.data.data) {
            this.streakCount = response.data.data.count
          } else {
            this.streakCount = 0
          }
          localStorage.setItem('count', this.streakCount)
        })
        .catch(error => {
          console.log(error)
          if (error.response.status === 400) {
            this.streakCount = 0
            localStorage.setItem('count', this.streakCount)
          }
        })
    },
    handleLogout() {
      this.$swal({
        title: 'Trwa wylogowywanie',
        showCancelButton: false,
        showConfirmButton: false,
      })
      this.$store.dispatch('auth/logout')
        .then(() => {
          this.$router.push({ name: 'login' })
        }).then(() => {
          this.$swal({
            title: 'Poprawne wylogowanie',
            icon: 'success',
            showCancelButton: false,
            showConfirmButton: false,
            timer: 1000,
          })
        })
    },
  },
}
</script>

<style>
.custom-dropdown-item{
    display: flex;
    justify-content: center;
    align-items: center;
}
.with-space {
    padding: 0 10px;
}
</style>
