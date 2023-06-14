<template>
    <b-overlay :show="showOverlay">
      <b-row>
        <b-col md="6">
          <h2 class="my-2">
            Wybierz odpowiednią kategorie, którą chcesz praktykować
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
        <router-link :to="{ name: 'dictionary.category', params: { category: category.name }}">
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
              style="width: 100%; aspect-ratio: 1;height: auto"
            />
            <b-card-title>
                {{ category.name }} -
                {{ category.word_amount }}
            </b-card-title>
          </b-card>
        </router-link>
        </b-col>
      </b-row>
    </b-overlay>
  </template>

<script>
import useJwt from '@/auth/jwt/useJwt'
import {
  BCard, BCardTitle, BCardBody, BCol, BRow, BOverlay, BCardText, BImgLazy, BAvatar, BButton,
} from 'bootstrap-vue'

export default {
  name: 'Dictionary',
  components: {
    BCol, BRow, BCard, BCardTitle, BCardBody, BCardText, BOverlay, BImgLazy, BAvatar, BButton,
  },
  data() {
    this.showOverlay = true
    useJwt.axiosIns.get('/api/word/dict/')
      .then(res => {
        this.categories.push({
            name : 'Wszystkie kategorie',
            photo_url: "\/storage\/categories\/all.svg",
            word_amount : res.data.data[0]['all_words_amount']
        })
        res.data.data[0]['categories'].forEach(cat => {
            this.categories.push(cat)
        })
        //this.categories = res.data.data[0]['categories']
        //$words = res.data.data[0]['words']
        this.showOverlay = false
      })
      .catch(err => {
        console.log(err)
        this.showOverlay = false
      })
    return {
      showOverlay: true,
      categories: [],
      words: [],
    }
  },
}
</script>

<style scoped>

</style>
