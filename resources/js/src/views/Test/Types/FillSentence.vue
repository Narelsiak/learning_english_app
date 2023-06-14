<template>
  <div>
    <h1 class="my-2">
      Uzupełnij zdanie
    </h1>
    <b-card>
      <h5>
        <span
          v-for="(val, valKey) in data.sentence"
          :key="valKey"
        >
          <span
            v-if="val.length > 0"
            class="d-inline-block"
          >
            {{ val }}
          </span>
          <b-form-input
            v-else
            v-model="fill"
            class="d-inline-block mx-1"
            :state="error ? false : null"
            style="width: 300px"
            @change="error = false"
          />
        </span>
      </h5>
      <div style="text-align: end">
        <b-button
          class="mt-2"
          variant="primary"
          @click="checkSentence"
        >
          Sprawdź odpowiedź
        </b-button>
      </div>
    </b-card>
  </div>
</template>

<script>
import {
  BCard, BFormInput, BButton,
} from 'bootstrap-vue'
import useJwt from '@/auth/jwt/useJwt'

export default {
  name: 'FillSentence',
  components: {
    BCard, BFormInput, BButton,
  },
  props: {
    data: Object,
    number: Number,
  },
  data() {
    return {
      fill: '',
      error: false,
    }
  },
  watch: {
    data(val, oldVal) {
      this.error = false
      this.fill = ''
    },
  },
  methods: {
    checkSentence() {
      useJwt.axiosIns.post(`/api/word/test/${this.$route.params.test_number}/${this.number}`, {
        answer_fill_sentence: this.fill,
      })
        .then(res => {
          console.log('kox', res.data)
          if (res.data.success) {
            this.$emit('taskSuccess')
          } else {
            this.$emit('wrongAnswer')
            this.error = true
          }
        })
    },
  },
}
</script>

<style scoped>

</style>
