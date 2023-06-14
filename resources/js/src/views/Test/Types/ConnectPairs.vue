<template>
  <div>
    <h1 class="my-2">
      Połącz pary
    </h1>
    <b-overlay :show="showOverlay">
      <b-card>
        <b-row>
          <b-col xs="6">
            <b-button
              v-for="(word, wordKey) in wordsEn"
              :key="wordKey"
              class="my-1 w-100 d-md-none"
              :variant="goodEn.includes(wordKey) ? 'success' : (errorEn === wordKey ? 'danger' : (markedEn === wordKey ? 'primary' : 'secondary'))"
              :disabled="goodEn.includes(wordKey)"
              @click="markEn(wordKey)"
            >
              {{ word }}
            </b-button>
            <b-button
            v-for="(word, wordKey) in wordsEn"
            :key="wordKey"
            class="my-1 w-75 bv-d-sm-down-none"
            :variant="goodEn.includes(wordKey) ? 'success' : (errorEn === wordKey ? 'danger' : (markedEn === wordKey ? 'primary' : 'secondary'))"
            :disabled="goodEn.includes(wordKey)"
            @click="markEn(wordKey)"
          >
            {{ word }}
          </b-button>
          </b-col>

          <b-col xs="6">
            <b-button
              v-for="(word, wordKey) in wordsPl"
              :key="wordKey"
              class="my-1 w-100 d-md-none"
              :variant="goodPl.includes(wordKey) ? 'success' : (errorPl === wordKey ? 'danger' : (markedPl === wordKey ? 'primary' : 'secondary'))"
              :disabled="goodPl.includes(wordKey)"
              @click="markPl(wordKey)"
            >
              {{ word }}
            </b-button>
            <b-button
            v-for="(word, wordKey) in wordsPl"
            :key="wordKey"
            class="my-1 w-75 bv-d-sm-down-none"
            :variant="goodPl.includes(wordKey) ? 'success' : (errorPl === wordKey ? 'danger' : (markedPl === wordKey ? 'primary' : 'secondary'))"
            :disabled="goodPl.includes(wordKey)"
            @click="markPl(wordKey)"
          >
            {{ word }}
          </b-button>

          </b-col>
        </b-row>
      </b-card>
    </b-overlay>
  </div>
</template>

<script>
import {
  BButton,
  BCard,
  BCol,
  BRow,
  BOverlay,
} from 'bootstrap-vue'
import useJwt from '@/auth/jwt/useJwt'

export default {
  name: 'ConnectPairs',
  components: {
    BButton,
    BCard,
    BCol,
    BRow,
    BOverlay,
  },
  props: {
    data: Array,
    number: Number,
  },
  data() {
    return {
      wordsEn: [],
      wordsPl: [],
      markedPl: -1,
      markedEn: -1,
      errorPl: -1,
      errorEn: -1,
      goodPl: [],
      goodEn: [],
      pairs: [],
      showOverlay: true,
    }
  },
  watch: {
    data(val, oldVal) {
      this.showOverlay = true
      this.wordOptions = [{
        value: null,
        text: 'Wybierz tłumaczenie',
      }]
      this.wordsEn = []
      this.wordsPl = []
      this.markedPl = -1
      this.markedEn = -1
      this.errorPl = -1
      this.errorEn = -1
      this.goodPl = []
      this.goodEn = []
      this.pairs = []
      this.data.forEach(word => {
        this.wordsEn.push(word.word_en)
        this.wordsPl.push(word.word_pl)
      })
      this.wordsEn = this.shuffleArray(this.wordsEn)
      this.wordsPl = this.shuffleArray(this.wordsPl)
      this.showOverlay = false
    },
  },
  methods: {
    save() {
      console.log(JSON.parse(JSON.stringify(this.wordConnects)))
    },
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
    markEn(key) {
      this.markedEn = key
      if (this.markedPl !== -1 && this.markedEn !== -1) {
        this.markedTwo()
      }
    },
    markPl(key) {
      this.markedPl = key
      if (this.markedPl !== -1 && this.markedEn !== -1) {
        this.markedTwo()
      }
    },
    markedTwo() {
      this.showOverlay = true
      useJwt.axiosIns.post(`/api/word/test/${this.$route.params.test_number}/${this.number}`, {
        pairs: JSON.stringify([
          {
            word_pl: this.wordsPl[this.markedPl],
            word_en: this.wordsEn[this.markedEn],
          },
        ]),
      })
        .then(res => {
          if (!res.data.success) {
            this.errorPl = this.markedPl
            this.errorEn = this.markedEn
            this.$emit('wrongAnswer')
            setTimeout(() => {
              this.errorPl = -1
              this.errorEn = -1
            }, 2000)
          } else {
            this.goodPl.push(this.markedPl)
            this.goodEn.push(this.markedEn)
            this.pairs.push(
              {
                word_pl: this.wordsPl[this.markedPl],
                word_en: this.wordsEn[this.markedEn],
              },
            )
            if (this.goodPl.length === this.wordsPl.length && this.goodEn.length === this.wordsEn.length) {
              useJwt.axiosIns.post(`/api/word/test/${this.$route.params.test_number}/${this.number}`, {
                pairs: JSON.stringify(this.pairs),
              })
                .then(res1 => {
                  console.log('kox', res1.data)
                  if (res1.data.success) {
                    this.$emit('taskSuccess')
                  } else {
                    alert('Coś poszło nie tak')
                  }
                })
            }
          }
          this.showOverlay = false
          this.markedPl = -1
          this.markedEn = -1
        })
    },
  },
}
</script>

<style scoped>

</style>
