<template>
  <b-overlay :show="showOverlay">
    <b-row>
      <b-col md="6">
        <h2 class="my-2">
          Ranking najlepszych użytkowników
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
import {
  BCard, BCardText, BRow, BCol, BButton, BTable, BCardTitle, BOverlay,
} from 'bootstrap-vue'
import useJwt from '@/auth/jwt/useJwt'

export default {
  components: {

    BOverlay,
    BCardTitle,
    BCard,
    BCardText,
    BRow,
    BCol,
    BButton,
    BTable,
  },
  data() {
    this.showOverlay = true
    useJwt.axiosIns.get('/api/auth/ranking/all')
      .then(res => {
        this.ranking = res.data.data
        for (let i = 0; i <= this.ranking.length || i <= 50; i++) {
          if (this.ranking[i]) {
            this.items.push({
              name: this.ranking[i].name ? this.ranking[i].name : '',
              surname: this.ranking[i].surname ? this.ranking[i].surname : '',
              // email: this.ranking[i].email.split('@')[0],
              lvl: this.ranking[i].lvl ? this.ranking[i].lvl : 1,
              money: this.ranking[i].money ? this.ranking[i].money : 0,
              ranking_by_30s: this.ranking[i]['30s'] ? this.ranking[i]['30s'] : 0,
              ranking_by_60s: this.ranking[i]['60s'] ? this.ranking[i]['60s'] : 0,
              ranking_by_15s: this.ranking[i]['15s'] ? this.ranking[i]['15s'] : 0,
            })
          }
        }
        this.showOverlay = false
      })
    return {
      showOverlay: true,
      dashData: {},
      items: [],
      ranking_by_money: [],
      fields: [
        {
          key: 'index',
          label: 'Miejsce',
          sortable: false,
        },
        {
          key: 'name',
          label: 'Imię',
          sortable: false,
        },

        {
          key: 'surname',
          label: 'Nazwisko',
          sortable: false,
        },
        // {
        //   key: 'email',
        //   label: 'Email',
        //   sortable: false
        // },
        {
          key: 'lvl',
          label: 'Poziom',
          sortable: true,
        },

        {
          key: 'money',
          label: 'Liczba monet',
          sortable: true,
        },
        {
          key: 'ranking_by_15s',
          label: 'Wynik w 15 s',
          sortable: true,
        },
        {
          key: 'ranking_by_30s',
          label: 'Wynik w 30 s',
          sortable: true,
        },
        {
          key: 'ranking_by_60s',
          label: 'Wynik w 60 s',
          sortable: true,
        },
      ],
    }
  },
}
</script>

<style>

</style>
