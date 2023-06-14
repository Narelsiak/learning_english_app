<template>
    <b-overlay :show="showOverlay">
      <b-row>
        <b-col md="6">
          <h2 class="my-2">
            Słówka z kategorii <b>{{ this.category_name }}</b>:
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
      <b-row>
        <b-col class="my-2">
          <b-form-input
            v-model="search"
            placeholder="Wyszukaj"
          />
        </b-col>
      </b-row>
      <b-row>
        <b-col>
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead class="thead-dark">
                <tr>
                  <th>Znaczenie PL</th>
                  <th>Znaczenie EN</th>
                  <th>Trudność</th>
                  <th>Akcje</th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="word in filteredWords"
                  :key="word.id"
                >
                  <td>{{ word.word_pl }}</td>
                  <td>{{ word.word_en }}</td>
                  <td>{{ word.difficulty === "easy" ? "Łatwy" : (word.difficulty === "medium" ? "Średni" : "Trudny") }}</td>
                  <td>
                    <div class="d-flex">
                      <button
                        v-if="word.users.length == 1 && word.users[0].is_favourite"
                        type="button"
                        title="Usuń z ulubionych"
                        class="btn btn-warning mr-1"
                        @click="changeFavouriteStatus(word)"
                      >
                        <img
                          style="max-width: 28px; max-height: 28px;"
                          src="/storage/icons/yellow_star.svg"
                          alt="Yellow star"
                        >
                      </button>
                      <button
                        v-else
                        type="button"
                        class="btn btn-light mr-1"
                        title="Dodaj do ulubionych"
                        @click="changeFavouriteStatus(word)"
                      >
                        <img
                          src="/storage/icons/white_star.svg"
                          style="max-width: 28px; max-height: 28px"
                          alt="White star"
                        >
                      </button>
                      <button
                        v-if="word.users.length == 1 && word.users[0].review"
                        type="button"
                        title="Usuń z powtórek"
                        class="btn btn-danger mr-1"
                        @click="changeReviewStatus(word)"
                      >
                        ➖
                      </button>
                      <button
                        v-else
                        type="button"
                        title="Dodaj do powtórek"
                        class="btn btn-success mr-1"
                        @click="changeReviewStatus(word)"
                      >
                        ➕
                      </button>
                      <button
                        v-b-modal="'note' + word.id"
                        type="button"
                        :title = "`Twoja notatka: ${word.users[0].note.length ? word.users[0].note : 'Brak notatki'}`"
                        class="btn btn-primary"
                      >
                        📝
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </b-col>
      </b-row>
      <!-- Tworzenie modali -->
      <div
        v-for="word in this.words"
        :key="word.id"
      >
        <b-modal
          :id="'note' + word.id"
          :title="'Twoja notatka dla slowa: ' + word.word_pl"
          hide-footer
          class="h-[50vh]"
        >
          <textarea
            v-if="word.users.length == 1 && word.users[0].note"
            v-model="word.users[0].note"
            class="w-100 h-300"
          />
          <textarea
            v-else
            v-model="word.users[0].note"
            class="w-100 h-300"
          /><br>
          <button
            type="button"
            class="btn btn-primary"
            @click="saveContent(word)"
          >
            Save changes
          </button>
        </b-modal>
      </div>
    </b-overlay>
  </template>
  
  <script>
  import useJwt from '@/auth/jwt/useJwt'
  import {
    BCard, BCardTitle, BCol, BRow, BOverlay, BCardText, BImgLazy, BAvatar, BButton, BFormInput, BModal, BDropdown, BDropdownItem
  } from 'bootstrap-vue'
  import { eventBus } from '@/store/eventBus'
  import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'
  
  export default {
    name: 'Dictionary',
    components: {
      BCol, BRow, BCard, BCardTitle, BCardText, BOverlay, BImgLazy, BAvatar, BButton, BFormInput, BModal, BDropdown, BDropdownItem
    },
    data() {
      this.showOverlay = true
      useJwt.axiosIns.post('/api/word/dict', {
        category: this.$route.params.category,
      })
        .then(res => {
          this.category_name = res.data.data[0].category
          this.res_words = res.data.data[0].words
          this.res_words = this.res_words.sort((a, b) => a.word_pl.localeCompare(b.word_pl));
          this.res_words.forEach(element => {
            if (!element.users.length) element.users.push({ note: '', review: 0, is_favourite: 0 })
            this.words.push(element)
          })
          console.log(this.Content)
          this.showOverlay = false
        })
        .catch(err => {
          console.log(err)
          this.showOverlay = false
        })
      return {
        showOverlay: true,
        words: [],
        res_words: [],
        category_name: '',
        search: '',
        stop: 0,
        fields: [
          { key: 'word_pl', label: 'Znaczenie PL', sortable: true },
          { key: 'word_en', label: 'Znaczenie EN', sortable: true },
          { key: 'word_pl', label: 'Dodaj do ulubionych', sortable: true },
          { key: 'word_en', label: 'Dodaj do powtórek', sortable: true },
          { key: 'word_pl', label: 'Edytuj notatkę', sortable: true },
        ],
        Content: ['zero'],
      }
    },
    computed: {
      filteredWords() {
        if (!this.search) {
          return this.words
        }
        const searchTerm = this.search.trim().toLowerCase()
        return this.words.filter(word => {
          const word_pl = word.word_pl.toLowerCase()
          const word_en = word.word_en.toLowerCase()
          return (
            word_pl.startsWith(searchTerm)
            || word_en.startsWith(searchTerm)
            || word_pl.includes(` ${searchTerm}`)
            || word_en.includes(` ${searchTerm}`)
          )
        })
      },
    },
    methods: {
      saveContent(word) {
        // Wykonaj akcję zapisu edytowanej treści, np. zaktualizuj bazę danych
        useJwt.axiosIns.post(`/api/word/word/${word.id}/addnote`, {
          notes: word.users[0].note,
        })
          .catch(err => {
            alert('Nie można wysłać pustej notatki')
          })
          .then(res => {
            this.$bvModal.hide(`note${word.id}`)
          })
      },
      changeReviewStatus(word) {
        if (this.stop) {
          return this.$toast({
            component: ToastificationContent,
            props: {
              title: 'Nie klikaj tak szybko!',
              icon: 'UserIcon',
              variant: 'success',
            },
          })
        }
        this.stop = 1
        if (word.users.length === 1 && word.users[0].review === 1) {
          useJwt.axiosIns.post(`/api/word/word/${word.id}/revokefromreview`, {})
            .then(res => {
              this.stop = 0
              word.users[0].review = 0
            })
        } else {
          useJwt.axiosIns.post(`/api/word/word/${word.id}/addtoreview`, {})
            .then(res => {
              this.stop = 0
              if (word.users.length === 0) {
                word.users.push({ review: 0, is_favourite: 0 })
              }
              word.users[0].review = 1
              if (res.data.data.update.achievement.length) {
                const achievementName = res.data.data.update.achievement.length > 1 ? res.data.data.update.achievement.join(', ') : res.data.data.update.achievement[0]
                eventBus.$emit('displayAchievement', achievementName)
                eventBus.$emit('refreshMoneyAndStreak')
              }
            })
        }
      },
      changeFavouriteStatus(word) {
        if (this.stop) {
          return this.$toast({
            component: ToastificationContent,
            props: {
              title: 'Nie klikaj tak szybko!',
              icon: 'UserIcon',
              variant: 'success',
            },
          })
        }
        this.stop = 1
        if (word.users.length === 1 && word.users[0].is_favourite === 1) {
          useJwt.axiosIns.post(`/api/word/word/${word.id}/revokefromfavourite`, {})
            .then(res => {
              word.users[0].is_favourite = 0
              this.stop = 0
            })
        } else {
          useJwt.axiosIns.post(`/api/word/word/${word.id}/addtofavourite`, {})
            .then(res => {
              this.stop = 0
              if (word.users.length == 0) {
                word.users.push({ is_favourite: 0, review: 0 })
              }
              word.users[0].is_favourite = 1
              if (res.data.data.update.achievement.length) {
                const achievementName = res.data.data.update.achievement.length > 1 ? res.data.data.update.achievement.join(', ') : res.data.data.update.achievement[0]
                eventBus.$emit('displayAchievement', achievementName)
                eventBus.$emit('refreshMoneyAndStreak')
              }
            })
        }
      },
    },
  }
  </script>
  
  <style scoped>
  
  </style>