<template>
  <b-overlay :show="showOverlay">
    <b-row>
      <b-col md="6">
        <h2 class="my-2">
         Statystyki użytkownika
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
      <b-col
        md="4"
        style="text-align-last: center;"
      >
        <b-card class="p-3 h-100">
          <b-card-text class="p-0">
            <img
              v-if="me && me.photo_url && me.photo_url.length > 0"
              :src="me.photo_url"
              style="border-radius: 100%;object-fit: cover;height: 15rem;aspect-ratio: 1;"
            >
            <b-avatar
              v-else
              variant="primary"
              :to="{name:'change_avatar'}"
              button
            />

          </b-card-text>
          <b-button
            variant="primary"
            :to="{name:'change_avatar'}"
          >
            Zmień Awatar
          </b-button>
        </b-card>
      </b-col>
      <b-col
        md="8"
        style="text-align-last: left;"
      >
        <b-card-group>
          <b-card class="p-3 h-100">
            <b-card-text>
              <b-form-group label="Imię">
                <b-form-input v-model="me.name" />
              </b-form-group>
              <b-form-group label="Nazwisko">
                <b-form-input v-model="me.surname" />
              </b-form-group>
              <b-form-group label="Data urodzenia">
                <b-form-datepicker

                  v-model="me.birth_date"
                  placeholder="Wybierz datę"
                />
              </b-form-group>
            </b-card-text>
            <b-button
              variant="primary"
              @click="send_changes"
            >
              Zmień dane
            </b-button>
          </b-card>
        </b-card-group>
      </b-col>
    </b-row>
    <b-row>
      <b-col md="6">
        <h2 class="my-2">
          Statystyki użytkownika
        </h2>
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
  BCard, BCardText, BRow, BCol, BButton, BTable, BCardTitle, BOverlay, BAvatar, BFormInput, BFormGroup, BFormDatepicker,
} from 'bootstrap-vue'
import useJwt from '@/auth/jwt/useJwt'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default {
  components: {
    BFormDatepicker,
    BAvatar,

    BOverlay,
    BCardTitle,
    BCard,
    BCardText,
    BRow,
    BCol,
    BButton,
    BTable,
    BFormInput,
    BFormGroup,
  },
  data() {
    this.showOverlay = true

    useJwt.axiosIns.get('/api/system/statistics')
      .then(res => {
        if (res.data.success) {
          this.stats = res.data.data
          for (const i in this.stats) {
            this.items.push({
              name: this.stats[i].name ? this.stats[i].name : '',
              value: this.stats[i].value != null ? this.stats[i].value : 'BD',
            })
          }
        }
      })

    useJwt.axiosIns.get('/api/auth/user/data/me')
      .then(res => {
        this.me = res.data.data
        this.me.birth_date = this.me.birth_date.slice(0, 10)
        this.showOverlay = false
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
      me: [],
      showOverlay: true,
      dashData: {},
      items: [],
      stats: [],

      fields: [
        {
          key: 'name',
          label: 'Nazwa statystyki',
          sortable: true,
        },
        {
          key: 'value',
          label: 'wartość',
          sortable: true,
        },

      ],
    }
  },
  methods: {
    send_changes() {
      this.showOverlay = true
      useJwt.axiosIns.patch('/api/auth/user/data/change_data', {
        name: this.me.name,
        surname: this.me.surname,
        birth_date: this.me.birth_date,
      })
        .then(res => {
          location.reload()
            .then(res => {
              this.$toast({
                component: ToastificationContent,
                props: {
                  title: res.data.message,
                  icon: 'UserIcon',
                  variant: 'success',
                },
              })
            })
        })
        .catch(error => {
          console.error(error)
        })
      this.showOverlay = false
    },
  },
}
</script>

<style>

</style>
