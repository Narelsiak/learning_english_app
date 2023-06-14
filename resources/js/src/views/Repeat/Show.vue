<template>
  <b-row v-if="currentKey !== -1">
    <b-col
      md="10"
      style="text-align-last: end"
    />
    <b-col
      md="2"
      class="mb-1"
      style="text-align-last: end"
    >
      <b-button
        variant="primary"
        :to="{ name: 'repeat.categories' }"
      >
        &lt; Powrót do listy kategorii
      </b-button>
    </b-col>
    <b-col
      md="6"
      class="offset-md-3"
    >
      <b-card>
        <b-card-title
          style="text-align: center"
        >
          {{ repeat[currentKey].word_en }}
        </b-card-title>
        <hr>
        <b-form-group>
          <label for="note">Notatki</label>
          <b-form-input
            id="note"
            v-model="repeat[currentKey].pivot.notes"
          />
        </b-form-group>
        <b-form-group>
          <label for="note">Tłumaczenie</label>
          <b-form-input
            id="note"
            v-model="wordPl"
            :state="wordPl === repeat[currentKey].word_pl"
          />
        </b-form-group>
        <div style="text-align: center">
          <b-button
            class="w-100 my-2"
            variant="primary"
            @click="addOneCorrectLetter"
          >
            Podpowiedz literę
          </b-button>
          <b-button
            variant="danger"
            style="width: 49%"
            @click="remove"
          >
          Wole jeszcze poćwiczyć
          </b-button>
          <b-button
            variant="success"
            style="width: 49%"
            @click="leave"
          >
            Dobra odpowiedź
          </b-button>
        </div>
      </b-card>
    </b-col>
  </b-row>
</template>

<script>
import useJwt from '@/auth/jwt/useJwt'
import {
  BCard, BCardTitle, BFormInput, BFormGroup, BButton, BRow, BCol,
} from 'bootstrap-vue'

export default {
  name: 'Show',
  components: {
    BCard, BCardTitle, BFormInput, BFormGroup, BButton, BRow, BCol,
  },
  data() {
    if (this.$route.params.category_name === 'all') {
      useJwt.axiosIns.get('/api/word/repetitions/review')
        .then(res => {
          this.repeat = this.shuffleArray(res.data.data)
          this.getRandomInt()
        })
    } else {
      useJwt.axiosIns.get(`/api/word/repetitions/category?category=${this.$route.params.category_name}`)
        .then(res => {
          this.repeat = this.shuffleArray(res.data.data)
          this.getRandomInt()
        })
    }
    return {
      repeat: {},
      alreadyShown: [],
      currentKey: -1,
      wordPl: '',
    }
  },
  methods: {
    addOneCorrectLetter() {
      if (this.repeat[this.currentKey].word_pl !== this.wordPl) {
        if (this.repeat[this.currentKey].word_pl.replace(this.wordPl, '') !== this.repeat[this.currentKey].word_pl) {
          this.wordPl += this.repeat[this.currentKey].word_pl.replace(this.wordPl, '').charAt(0)
        } else {
          this.wordPl = this.repeat[this.currentKey].word_pl.charAt(0)
        }
      }
    },
    leave() {
      useJwt.axiosIns.post('/api/word/repetitions/review', {
        id: this.repeat[this.currentKey].id,
      })
        .catch(err => {
          alert('Coś poszło nie tak')
          console.log(err)
        })
      if (this.repeat[this.currentKey].pivot && this.repeat[this.currentKey].pivot.notes && this.repeat[this.currentKey].pivot.notes.length > 0) {
        useJwt.axiosIns.post(`/api/word/word/${this.repeat[this.currentKey].id}/addnote`, {
          notes: this.repeat[this.currentKey].pivot.notes ?? '',
        })
          .catch(err => {
            alert('Coś poszło nie tak')
            console.log(err)
          })
      }
      this.next()
    },
    remove() {
      useJwt.axiosIns.post(`/api/word/word/${this.repeat[this.currentKey].id}/revokefromreview`)
        .catch(err => {
          alert('Coś poszło nie tak')
          console.log(err)
        })
      this.next()
    },
    next() {
      this.wordPl = ''
      if (this.alreadyShown.length === this.repeat.length) {
        this.$swal({
          title: 'To już wszystkie powtórki!',
          text: 'Kliknij aby wrócić do listy kategorii',
          icon: 'info',
          customClass: {
            confirmButton: 'btn btn-primary',
          },
          buttonsStyling: false,
        })
          .then(() => {
            this.$router.push({ name: 'repeat.categories' })
          })
      } else {
        this.getRandomInt()
      }
    },
    getRandomInt() {
      let value = -1
      do {
        value = Math.floor(Math.random() * this.repeat.length)
      } while (this.alreadyShown.includes(value))
      this.currentKey = value
      this.alreadyShown.push(value)
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
  },
}
</script>

<style scoped>

</style>
