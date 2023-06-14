<template>
  <div class="text-center">
    <!-- SLOWO DNIA + STATYSTYKI + RANKING -->
    <b-row>
      <b-col md="3" class="p-75">
        <b-card
          v-if="dashData && dashData.word_of_the_day"
          class="h-100"
          title="Słowo Dnia 🌞"
        >
        <b-card-text>
            Dzisiejsze słowo dnia to:
        </b-card-text>
          <b-img-lazy
            v-if="dashData && dashData.word_of_the_day && dashData.word_of_the_day.photo_url"
            :src="dashData.word_of_the_day.photo_url.length > 0 ? dashData.word_of_the_day.photo_url : false"
            class="mb-2 img-fluid"
            style="height: 12rem;"
          />
          <b-card-text style="font-weight: bold; font-size: 16px; ">
            {{ dashData.word_of_the_day.word_en }} - {{ dashData.word_of_the_day.word_pl }}
          </b-card-text>

        </b-card>
      </b-col>
      <b-col
        md="3"
        class="p-75"
      >
        <b-card
          class="h-100"
          title="Statystyki 📅"
        >
        <b-card-text>
            Poniżej znajduje się część twoich statystyk, na profilu znajdziesz ich więcej!
        </b-card-text>
          <b-card-text> Twój streak trwa
            <b>{{ dashData.latest_streak }}</b> 🔥 {{ dashData.latest_streak != 1 ? 'Dni!' : 'Dzień!' }}<br><span
              v-if="dashData.longest_streak === dashData.latest_streak"
            >Jest to Twój najdłuższy streak.</span>
          </b-card-text>

          <b-card-text v-if="dashData.longest_streak !== dashData.latest_streak">
            Najdłuższy streak trwał <b>{{ dashData.longest_streak }}</b> dni
          </b-card-text>
          <b-card-text>
              Zebrałeś łącznie:<br> <b>{{ dashData.favourite_counter }}</b>⭐<b class="ml-1">{{ dashData.user_achievements_amount }}</b> 🏆<b class="ml-1">{{ dashData.total_collect_heart }}</b>💗
          </b-card-text>
          <b-card-text>
            Następne 💗 uzyskasz za ..
          </b-card-text>
                <b-progress :value="timeLeft" max="7200" class="progress-bar-danger" variant="danger" />
                <b>{{ timeObj.h == 0 ? "" : timeObj.h < 10 ? "0" + timeObj.h + ":" : timeObj.h + ":" }}{{ timeObj.m < 10 ? "0" + timeObj.m + ":" : timeObj.m + ":" }}{{ timeObj.s < 10 ? "0" + timeObj.s : timeObj.s }}</b>

        </b-card>
      </b-col>
      <b-col
        md="6"
        class="p-75"
      >
        <b-card
          v-if="dashData && dashData.ranking_by_money"

          class="h-100"
          title="Ranking 📈"
        >
        <b-card-text>Sprawdź swoje postępy na tle innych użytkowników!</b-card-text>
          <b-table
            striped
            hover
            :items="items"
            :fields="fields"
          />
          <b-card-text>Twoje miejsce w rankingu pod względem monet: {{ dashData.ranking_by_money }}</b-card-text>
          <b-button
            variant="primary"
            :to="{name:'ranking'}"
          >
            Zobacz Cały Ranking
          </b-button>
        </b-card>
      </b-col>
    </b-row>

      <b-row class="p-0">
        <b-col md="4" class="p-75">
            <b-card title="Testy 📘" class="h-100">
            <b-card-text class="mb-0">Pogłębiaj swoją wiedzę, rozwiązując testy</b-card-text>
            <b-card-img class="text-center">
                <vue-apex-charts  class="w-100 h-70" type="radialBar" :options="chartOptions" :series="series"></vue-apex-charts>
            </b-card-img>
            
            <div class="position-sticky position-bottom">
                <b-card-text v-if="dashData && dashData.last_test && dashData.last_test.category">
                    Ostatnio rozwiązany test:
                    <br> <img style="width:24px" :src="dashData.last_test.photo_url"> <b>{{ dashData.last_test.category }} - {{ dashData.last_test.difficulty }} </b> <img style="width:24px" :src="dashData.last_test.photo_url"><br>
                </b-card-text>
                <b-card-text v-else>
                    Brak rozwiązanych testów
                </b-card-text>

                <b-button
                    variant="primary"
                    :to="{name: 'test.categories'}"
                >
                    Rozpocznij Test
                </b-button>
            </div>
            </b-card>
        </b-col>


        <!-- OSIAG + POWTÓRKI -->
        <b-col md="4" class="p-75" >
            <b-row class="mb-75 pb-75">
                <b-col> 
                    <b-card title="Osiągnięcia 🏆" class="h-100">
                    <b-card-text>
                        Rozwiązuj testy oraz korzystaj z aplikacji, aby otrzymywać rozmaite osiągnięcia
                    </b-card-text>
                    <b-card-text>
                        🏆 Zdobyto <b>{{ dashData.user_achievements_amount }}/{{ dashData.achievements_amount }}</b> osiągnięć 🏆
                    </b-card-text>
                    <b-card-text class="text-center" v-if=" dashData.last_achievement ? dashData.last_achievement.name : null ">
                        Ostatnio zdobyte osiągnięcie : <br> <img style="width:150px" :src="dashData.last_achievement.photo_url"/><br><b>{{ dashData.last_achievement.name }}</b>
                        
                    </b-card-text>
                    <b-button variant="primary" :to="{ name: 'achievements' }">Wszystkie Osiągnięcia</b-button>
                    </b-card>
                </b-col>
            </b-row>

            <b-row>
                <b-col>
                    <b-card title="Powtórki 🔁" class="h-100">
                        <b-card-text>Utrwal poznane już słowa!</b-card-text>
                        <b-button variant="primary" :to="{name: 'repeat.categories'}">Przejdź Do Powtórek</b-button>
                    </b-card>
                </b-col>
            </b-row>
        </b-col>

        <!-- ULUB + SLOW + GRY CZAS -->
        <b-col md="4" class="p-75">
        <!-- ULUB SLOWA -->
        <b-row class="mb-75 pb-75">
            <b-col>
                <b-card
            title="Ulubione Słowa 🌟"
            class="h-100"
            >
            <b-card-text>
                Selekcjonuj słowa, które najbardziej Ci się podobają!
            </b-card-text>
            <b-card-text v-if="dashData && dashData.last_favourite_word && dashData.last_favourite_word.word_en">
                Ostatnie polubione słowo:
                <br>⭐<b> {{ dashData.last_favourite_word.word_en }} - {{ dashData.last_favourite_word.word_pl }}</b> ⭐
            </b-card-text>
            <b-card-text v-else>
                Brak ulubionych słów
            </b-card-text>
            </b-card>
            </b-col>
        </b-row>
            
        <!-- SLOWNIK -->
        <b-row class="mb-75 pb-75">
            <b-col>
                <b-card title="Słownik 📖" class="h-100">
                    <b-card-text>Przeglądaj poznane słowa!</b-card-text>
                    <b-button
                        variant="primary"
                        :to="{name: 'dictionary'}"
                    >
                        Przejdź Do Słownika
                    </b-button>
                </b-card>
            </b-col>
        </b-row>
        <!-- GRY CZASOWE -->
        <b-row >
            <b-col>
                <b-card title="Gry Czasowe ⏲️" class="h-100">
                    <b-card-text>Sprawdź się pod presją czasu!</b-card-text>
                    <b-button variant="primary" :to="{name: 'time_play.time_play_categories'}">Rozpocznij Grę Czasową</b-button>
                </b-card>
            </b-col>
        </b-row>
    </b-col>
    </b-row>
  </div>
</template>

<script>
import {
  BCard, BCardText, BRow, BCol, BButton, BTable, BImgLazy, BProgress
} from 'bootstrap-vue'
import VueApexCharts from 'vue-apexcharts'
import useJwt from '@/auth/jwt/useJwt'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'
import {eventBus} from "@/store/eventBus";

export default {
  components: {
    BImgLazy,
    BCard,
    BCardText,
    BRow,
    BCol,
    BButton,
    BTable,
    BProgress,
    VueApexCharts
  },
  data() {
    useJwt.axiosIns.get('/api/auth/user/data/dashboard')
      .then(res => {
        this.dashData = res.data.data
        this.series.push(Math.round(this.dashData.done_tests_amount/this.dashData.all_tests_amount*10000)/100)
        this.calculateTime(this.dashData.next_life_time)
        this.timeCountdown()
      }).catch(err => {
        this.$toast({
          component: ToastificationContent,
          props: {
            title: err.response ? err.response.data.message : err.message,
            icon: 'UserIcon',
            variant: 'danger',
          },
        })
      })
    useJwt.axiosIns.get('/api/auth/user/data/me')
      .then(res => {
        this.me = res.data.data
      }).catch(err => {
        this.$toast({
          component: ToastificationContent,
          props: {
            title: err.response ? err.response.data.message : err.message,
            icon: 'UserIcon',
            variant: 'danger',
          },
        })
      })
    useJwt.axiosIns.get('/api/auth/ranking/money')
      .then(res => {
        console.log(res.data.data)
        this.ranking_by_money = res.data.data
        for (let i = 0; i < this.ranking_by_money.length && i < 3; i++) {
          if (this.ranking_by_money[i]) {
            this.items.push({
              name: this.ranking_by_money[i].name,
              money: this.ranking_by_money[i].value,
            })
          }
        }
      }).catch(err => {
        this.$toast({
          component: ToastificationContent,
          props: {
            title: err.response ? err.response.data.message : err.message,
            icon: 'UserIcon',
            variant: 'danger',
          },
        })
      })

    return {
    series: [],
    chartOptions: {
        colors: ['#6610F2'],
        chart: {
            height: 350,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
            hollow: {
                size: '70%',
            }
        },
    },
    labels: ['Progress'],
    },
      dashData: {},
      items: [],
      fields: [
        {
          key: 'name',
          label: 'Imię',
          sortable: false,
        },
        {
          key: 'money',
          label: 'Monety',
          sortable: true,
        },
      ],
      ranking_by_money: [],
      me: [],
      file: null,
      timeObj: {
        h: 0,
        m: 0,
        s: 0,
        update: 0,
      },
      timeLeft: 0,
    }
  },
  methods: {
    timeCountdown() {
      const countdownTimer = setInterval(() => {
        if (this.timeObj.s  || this.timeObj.m || this.timeObj.h) {
          if (this.timeObj.s === 0 && (this.timeObj.m || this.timeObj.h)) {
            this.timeObj.s = 60
            if (this.timeObj.m > 0) this.timeObj.m--
            if (this.timeObj.m === 0 && this.timeObj.h) {
              this.timeObj.m = 59
              if (this.timeObj.h > 0) this.timeObj.h--
            }
          }
          this.timeObj.s--
          if(this.timeLeft>0) this.timeLeft--
        } else {
          if (this.timeObj.update === 1) return
            this.timeObj.update = 1
          useJwt.axiosIns.get('/api/auth/user/data/dashboard')
            .then(res => {
              if (res.data.data.next_life_time !== this.dashData.next_life_time) {
                this.calculateTime(res.data.data.next_life_time)
                eventBus.$emit('refreshHearts')
                setTimeout(() => {
                  this.timeObj.update = 0
                }, 10000)
              }else{
                setTimeout(() => {
                  this.timeObj.update = 0
                }, 10000)
              }
            })
        }
      }, 1000)
    },
    calculateTime(time) {
      const timeAct = new Date(time)
      const currentTime = new Date()
      let timeDif = timeAct - currentTime
      if (timeDif < 0) timeDif = 0
      this.timeObj.h = Math.floor(timeDif / (1000 * 60 * 60))
      this.timeObj.m = Math.floor((timeDif % (1000 * 60 * 60)) / (1000 * 60))
      this.timeObj.s = Math.floor((timeDif % (1000 * 60)) / 1000)
      this.timeLeft = Math.floor(timeDif/1000)
    },
  },
}

</script>

<style>

</style>
