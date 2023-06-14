<template>
  <b-overlay :show="showOverlay">
    <b-row>
      <b-col md="6">
        <h2 class="my-2">
          Twoje wyniki dla gry czasowej {{ this.type }} sekund
        </h2>
      </b-col>
      <b-col
        md="6"
        style="text-align-last: end;"
      >
        <b-button
          variant="primary"
          to="/time_play/time_play_categories"
        >
          &lt; Powrót do strony gier
        </b-button>
      </b-col>
    </b-row>
    <b-row>
      <b-col md="12">
        <b-card class="p-0">
          <b-card-text class="p-0">
            <b-table
              responsive
              striped
              hover
              :items="items"
              :fields="fields"
            >
              <template #cell(index)="data">
                {{ data.index + 1 }}
              </template>
            </b-table>
          </b-card-text>
        </b-card>
      </b-col>
    </b-row>
  </b-overlay>
</template>

<script>

import useJwt from '@/auth/jwt/useJwt'
import {
  BCard, BCardText, BRow, BCol, BButton, BTable, BCardTitle, BOverlay,
} from 'bootstrap-vue'

export default {
  name: 'History',
  components: {

    BOverlay,
    BCard,
    BCardText,
    BRow,
    BCol,
    BButton,
    BTable,
  },
  data() {
    this.getHistory()
    return {
      showOverlay: false,
      type: this.$route.params.num_sec,
      items: [],
      fields: [
        {
          key: 'index',
          label: 'Indeks',
          sortable: false,
        },
        {
          key: 'result',
          label: 'Wynik',
          sortable: true,
        },
        {
          key: 'date',
          label: 'Data wykonania',
          sortable: true,
        },
      ],
    }
  },
  methods: {
    getHistory() {
      const formData = new FormData()
      formData.append('type', `${this.$route.params.num_sec}s`)
      useJwt.axiosIns.post('/api/system/games/history', formData).then(res => {
        this.data = res.data.data
        this.data.forEach(i => {
          this.items.push({
            date: this.formattedDate(i.end_time),
            result: i.result,
          })
        })
      }).catch(err => {
        console.log(err)
      })
    },
    formattedDate(dateBefore) {
      const dateParts = dateBefore.split(/[-T:.Z]/).map(part => parseInt(part));
      const dateObj = new Date(Date.UTC(dateParts[0], dateParts[1] - 1, dateParts[2], dateParts[3], dateParts[4], dateParts[5]))
      return `${dateObj.getFullYear()}-${dateObj.getMonth() + 1 < 10 ? "0" + (dateObj.getMonth() + 1) : dateObj.getMonth() + 1}-${dateObj.getDate() < 10 ? "0" + dateObj.getDate() : dateObj.getDate()} ${dateObj.getHours()}:${dateObj.getMinutes()}`
    },
  },
}
</script>

<style scoped>

</style>
