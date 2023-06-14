<template>
  <div>
    <b-row>
      <b-col md="6">
        <h2 class="my-2">
          Wyślij zdjęcie z swoim Awatarem
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
    <hr>
    <b-row>
      <b-col>
        <b-card>
          <b-form-file
            ref="file-input"
            v-model="file"
            accept="image/*"
            class="mb-2"
          />
          <p
            v-if="file"
            class="mt-2"
          >
            Wybrany plik: <b>{{ file ? file.name : '' }}</b>
          </p>
          <b-button @click="send_img">
            Prześlij
          </b-button>
        </b-card>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import {
  BCard, BRow, BCol, BButton, BFormFile, BImg,
} from 'bootstrap-vue'
import useJwt from '@/auth/jwt/useJwt'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default {
  components: {
    BButton,
    BCard,
    BRow,
    BCol,
    BFormFile,
    BImg,
  },
  data() {
    return {
      url: {},
      file: null,
    }
  },
  methods: {
    send_img() {
      const formData = new FormData()
      formData.append('avatar', this.file)
      useJwt.axiosIns.post('/api/auth/user/data/change_avatar', formData)
        .then(res => {
          this.$toast({
            component: ToastificationContent,
            props: {
              title: res.data.message,
              icon: 'UserIcon',
              variant: 'success',
            },
          })
          window.location.href = '/'
        })
        .catch(error => {
          console.error(error)
        })
    },
  },

}
</script>

<style>

</style>
