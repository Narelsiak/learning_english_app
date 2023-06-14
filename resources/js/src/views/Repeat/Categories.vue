<template>
  <div>
    <b-row>
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
          :to="{ path: '/' }"
        >
          &lt; Powrót do strony głównej
        </b-button>
      </b-col>
    </b-row>
    <b-card
      :title="`Powtórka dla wszystkich kategorii - ${ categories.reps_all_amount }`"
    >
      <b-button
        v-if="categories.reps_all_amount > 0"
        :to="{ name: 'repeat', params: { category_name: 'all' }}"
      >
        Przejdź do powtórki
      </b-button>
      <span v-else>Brak słówek do powtórzenia - wszystko już potrafisz! Aby dodać słówka do powtórek, znajdź je w słowniku</span>
    </b-card>
    <b-row v-if="categories.category">
      <b-col
        v-for="(category, categoryKey) in categories.category"
        :key="categoryKey"
        md="3"
      >
        <b-card-actions
          :ref="`category_card_${category.category_name}`"
          :title="`${ category.category_name } - ${ category.rep_amount }/${ category.rep_total_amount }`"
          :no-actions="category.rep_total_amount === 0"
          action-refresh
          @refresh="resetReviews(category.category_name)"
        >
          <b-button
            v-if="category.rep_amount > 0"
            :to="{ name: 'repeat', params: { category_name: category.category_name }}"
          >
            Przejdź do powtórki
          </b-button>
          <span v-else>Brak słówek w tej kategorii</span>
        </b-card-actions>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import useJwt from '@/auth/jwt/useJwt'
import {
  BCol, BRow, BCard, BCardTitle, BButton,
} from 'bootstrap-vue'
import { BCardActions } from '@core/components/b-card-actions'

export default {
  name: 'Categories',
  components: {
    BRow, BCol, BCard, BCardTitle, BButton, BCardActions,
  },
  data() {
    this.getCategories()
    return {
      categories: {},
    }
  },
  methods: {
    getCategories() {
      return useJwt.axiosIns.get('/api/word/repetitions/categories_list', { Accept: 'application/json' })
        .then(res => {
          this.categories = res.data.data
        })
    },
    resetReviews(name) {
      useJwt.axiosIns.post('/api/word/repetitions/refresh', { category: name })
        .then(async () => {
          await this.getCategories()
          if (this.$refs[`category_card_${name}`][0]) {
            this.$refs[`category_card_${name}`][0].showLoading = false
          } else {
            this.$refs[`category_card_${name}`].showLoading = false
          }
        })
        .catch(() => {
          if (this.$refs[`category_card_${name}`][0]) {
            this.$refs[`category_card_${name}`][0].showLoading = false
          } else {
            this.$refs[`category_card_${name}`].showLoading = false
          }
        })
    },
  },
}
</script>

<style scoped>

</style>
