<template>
  <div>
    <b-card v-if="data[0]">
      <b-card-title>Ułóż zdanie</b-card-title>
      <h3 class="mb-2">
        {{ data[0].sentence[0].charAt(0).toUpperCase() + data[0].sentence.join(' ').slice(1) }}
      </h3>
      <draggable
        :list="list"
        :group="{name:'tags', pull:'clone', put:false }"
        :class="`p-2 mb-1 cursor-move${error ? ' bg-danger' : ''}`"
      >
        <b-badge
          v-for="(listItem, index) in list"
          :key="index"
          class="mr-25"
          style="font-size: 20px;text-transform: uppercase"
        >
          {{ listItem.replace('.', '') }}
        </b-badge>
      </draggable>
      <div style="text-align: end">
        <b-button
          class="mt-2"
          variant="primary"
          @click="checkPuzzle"
        >
          Sprawdź odpowiedź
        </b-button>
      </div>
    </b-card>
  </div>
</template>

<script>
import {
  BBadge,
  BCard,
  BButton,
  BCardTitle,
} from 'bootstrap-vue'
import draggable from 'vuedraggable'
import useJwt from '@/auth/jwt/useJwt'
import { eventBus } from '@/store/eventBus'

export default {
  name: 'Puzzle',
  components: {
    BBadge,
    BCard,
    BButton,
    BCardTitle,
    draggable,
  },
  props: {
    data: Object,
    number: Number,
  },
  data() {
    return {
      list: [],
      error: false,
    }
  },
  watch: {
    data(val, oldVal) {
      this.list = []
      this.error = false
      if (this.data[0]) {
        this.shuffleArray(this.data[0].correct_answer).forEach(element => {
          this.list.push(element)
        })
      }
    },
  },
  methods: {
    shuffleArray(array) {
      for (let i = array.length - 1; i > 0; i -= 1) {
        const j = Math.floor(Math.random() * (i + 1))
        const temp = array[i]
        // eslint-disable-next-line no-param-reassign
        array[i] = array[j]
        // eslint-disable-next-line no-param-reassign
        array[j] = temp
      }
      return array
    },
    checkPuzzle() {
      useJwt.axiosIns.post(`/api/word/test/${this.$route.params.test_number}/${this.number}`, {
        answer: JSON.stringify(this.list),
      })
        .then(res => {
          if (res.data.success) {
            if (res.data.data.update.achievement.length) {
              const achievementName = res.data.data.update.achievement.length > 1 ? res.data.data.update.achievement.join(', ') : res.data.data.update.achievement[0]
              eventBus.$emit('displayAchievement', achievementName)
              eventBus.$emit('refreshMoneyAndStreak')
            }
            this.$emit('taskSuccess')
          } else {
            this.$emit('wrongAnswer')
            this.error = true
            setTimeout(() => {
              this.error = false
            }, 1000)
          }
        })
    },
  },
}
</script>

<style scoped>

</style>
