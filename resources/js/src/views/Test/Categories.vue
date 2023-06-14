<template>
  <b-overlay :show="showOverlay">
    <b-row>
      <b-col md="6">
        <h2 class="my-2">
          Lista kategorii testów
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
        v-for="(category, categoryKey) in categories"
        :key="categoryKey"
        xs="6"
        sm="6"
        md="4"
        lg="3"
        xl="2"
        xxl="2"
      >
        <b-card>
          <b-img-lazy
            v-if="category.photo_url ? category.photo_url.length > 0 : false"
            :src="category.photo_url"
            class="mb-2"
            style="width: 100%"
          />
          <b-avatar
            v-else
            :text="category.name"
            class="mb-2"
            rounded="sm"
            style="width: 100%;aspect-ratio: 1;height: auto"
          />
          <b-card-title>{{ category.name }}</b-card-title>
          <b-dropdown
            split
            text="Poziom trudności"
            variant="secondary"
            right
            class="full-width"
          >
            <span
              v-for="(test, testKey) in category.tests"
              :key="testKey"
            >
              <b-dropdown-item
                :to="{ name: 'test.show', params: { test_number: test.number }}"
                :disabled="parseInt(test.status) === 1"
              >
                {{ difficulty[test.difficulty] }}
              </b-dropdown-item>
            </span>
          </b-dropdown>
        </b-card>
      </b-col>
    </b-row>
  </b-overlay>
</template>

<script>
import useJwt from '@/auth/jwt/useJwt'
import {
  BCard, BCardTitle, BCol, BRow, BOverlay, BImgLazy, BAvatar, BButton, BDropdown, BDropdownItem,
} from 'bootstrap-vue'

export default {
  name: 'Achievements',
  components: {
    BCol, BRow, BCard, BCardTitle, BOverlay, BImgLazy, BAvatar, BButton, BDropdown, BDropdownItem,
  },
  data() {
    this.showOverlay = true
    useJwt.axiosIns.get('/api/word/category')
      .then(res => {
        this.categories = res.data.data
        this.showOverlay = false
      })
      .catch(err => {
        console.log(err)
        this.showOverlay = false
      })
    return {
      showOverlay: true,
      categories: [],
      difficulty: {
        easy: 'Łatwy',
        medium: 'Średni',
        hard: 'Trudny',
      },
    }
  },
}
</script>

<style scoped>

</style>
