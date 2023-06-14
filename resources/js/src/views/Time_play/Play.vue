<template>
  <div>
    <b-overlay :show="showOverlay">
      <b-row>
        <b-col md="12">
          <b-card>
            <b-form-group>
              <b-card-text class="mr-2">
                Liczba poprawnych odpowiedzi: {{ num_correct }}
              </b-card-text>
              <b-input-group :prepend="to_translation">
                <b-form-input
                  v-model="translation"
                  placeholder="Wprowadź tłumaczenie"
                  :disabled="isTimeUp"
                  @keyup.enter="checkTranslation"
                />
                <b-input-group-append>
                  <b-button
                    size="mb"
                    text="Button"
                    variant="success"
                    :disabled="isTimeUp"
                    @click="checkTranslation"
                  >Sprawdź</b-button>
                </b-input-group-append>
              </b-input-group>
            </b-form-group>
            <b-progress
              show-value
              :max="MaxProgress"
              :value="progress"
              variant="success"
              class="mt-3 mb-3"
            />
            <b-card-text />
            <b-list-group>
            <div class="table-responsive">
              <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                  <tr>
                    <th> </th>
                    <th>Słówko</th>
                    <th>Twoja odpowiedź</th>
                    <th>Poprawna odpowiedź</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(word, index) in reversedTranslatedWords"
                    :key="index"
                  >
                    <td> {{word.status == 1 ? '🟢' : word.status == 0 ? '🔴': '🟠' }}</td>
                    <td>{{ word.to_translation }}</td>
                    <td :style="`color: ${(word.translation === word.correctAnswer) ? 'green;' : word.correctAnswer ? 'red;' : 'orange'}`">{{ word.translation }}</td>
                    <td>{{ word.correctAnswer }}</td>
                  </tr>

                </tbody></table>
            </div>
              <!--              <b-list-group-item v-for="(word, index) in reversedTranslatedWords" :key="index">-->
              <!--                {{ word.to_translation }} - {{ word.translation }} - {{ word.correctAnswer }}-->
              <!--              </b-list-group-item>-->
            </b-list-group>
          </b-card>
        </b-col>
      </b-row>
    </b-overlay>
  </div>
</template>

<script>
import useJwt from '@/auth/jwt/useJwt'
import {
  BCard, BCardTitle, BCol, BRow, BOverlay, BImgLazy, BAvatar, BButton, BDropdown, BDropdownItem, BFormInput, BFormGroup, BCardText, BProgress, BInputGroup, BListGroup,
} from 'bootstrap-vue'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default {
  name: 'Achievements',
  components: {
    BCol, BRow, BCard, BCardTitle, BOverlay, BImgLazy, BAvatar, BButton, BDropdown, BDropdownItem, BFormInput, BFormGroup, BCardText, BProgress, BInputGroup, BListGroup,
  },
  data() {
    return {
      showOverlay: false,
      translation: '',
      to_translation: '',
      num_word: 1,
      num_correct: 0,
      progress: this.$route.params.num_sec,
      MaxProgress: this.$route.params.num_sec,
      translate_words: [],
      translated_words: [],
    }
  },
  computed: {
    reversedTranslatedWords() {
      return this.translated_words.slice().reverse()
    },
    isTimeUp: {
      get() {
        return this.progress === 0
      },
      set() {
      },
    },
  },
  mounted() {
    this.fetchTranslateWords()
    this.startCountdown()
  },
  methods: {
    fetchTranslateWords() {
      const formData = new FormData()
      formData.append('type', `${this.$route.params.num_sec}s`)
      useJwt.axiosIns.post('/api/system/games', formData)
        .then(res => {
          this.translate_words = res.data.data.translate_words.map(word => ({
            to_translation: word,
            translation: '',
          }))
          this.to_translation = this.translate_words[0].to_translation
          this.$toast({
            component: ToastificationContent,
            props: {
              title: res.data.message,
              icon: 'UserIcon',
              variant: 'success',
            },
          })
        })
    },
    checkTranslation(force) {
      if (this.isTimeUp && !force) {
        return
      }
      const formData = new FormData()
      formData.append('word', this.translation)
      formData.append('type', `${this.$route.params.num_sec}s`)
      useJwt.axiosIns.post('/api/system/games/send', formData)
        .then(res => {
          this.translated_words[this.translated_words.length - 1].correctAnswer = res.data.correct_word
          this.translated_words[this.translated_words.length - 1].status = (res.data.correct_word == this.translated_words[this.translated_words.length - 1].translation ? 1 : 0)
          console.log(this.translated_words[this.translated_words.length - 1])
          if ('liczba_pkt' in res.data) this.num_correct = res.data.liczba_pkt
          if (res.data.success === false) {
            this.isTimeUp = false
            this.$swal({
              title: res.data.message,
              text: `Twój wynik: ${res.data.data.last_try_points}`,
              icon: 'success',
              customClass: {
                confirmButton: 'btn btn-primary',
              },
              buttonsStyling: false,
            })
          }
        }).catch(err => {
        })
      const currentWord = this.translate_words[this.num_word - 1]
      currentWord.translation = (this.translation != '' ? this.translation : 'Brak odpowiedzi')
      this.translated_words.push(currentWord)
      this.num_word += 1
      this.translation = ''
      if (this.num_word <= this.translate_words.length) {
        this.to_translation = this.translate_words[this.num_word - 1].to_translation
      } else {
        // Wszystkie słówka zostały przetłumaczone
        // Tutaj możesz dodać odpowiednią logikę
      }
    },
    startCountdown() {
      const countdownTimer = setInterval(() => {
        this.progress -= 1
        if (this.progress <= 0) {
          clearInterval(countdownTimer)
          if (!this.isTimeUp) return
          setTimeout(() => {
            this.checkTranslation(1)
          }, 2000)
        }
      }, 1000)
    },
  },
}
</script>

<style scoped>

</style>
