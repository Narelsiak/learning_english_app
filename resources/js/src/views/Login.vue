<template>
  <div class="auth-wrapper auth-v2">
    <b-row class="auth-inner m-0">
      <!-- Brand logo-->
      <!-- <b-link class="brand-logo">
        <panel-logo style="width:15em" />
      </b-link> -->
      <!-- /Brand logo-->

      <!-- Left Text-->
      <b-col
        lg="8"
        class="d-none d-lg-flex align-items-center p-5"
      >
        <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
          <b-img
            fluid
            :src="imgUrl"
            alt="Login"
          />
        </div>
      </b-col>
      <!-- /Left Text-->

      <!-- Login-->
      <b-col
        lg="4"
        class="d-flex align-items-center auth-bg px-2 p-lg-5"
      >
        <b-col
          sm="8"
          md="6"
          lg="12"
          class="px-xl-2 mx-auto"
        >
          <validation-observer ref="loginValidation">
            <b-form
              class="auth-login-form mt-2"
              @submit.prevent
            >
              <b-card-title>Logowanie</b-card-title>
              <b-form-group
                label-for="login-email"
              >
                <ValidationProvider

                  #default="{ errors }"
                  name="Email"
                  rules="required|email"
                >
                  <div class="d-flex justify-content-between">
                    <label for="login-email">Email</label>

                  </div>
                  <b-form-input
                    id="login-email"
                    v-model="userEmail"
                    :state="errors.length > 0 ? false : (userEmail.includes(' ') ? false : null)"
                    name="login-email"
                    placeholder="john@example.com"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>

                </ValidationProvider>

              </b-form-group>
              <b-form-group>
                <validation-provider
                  #default="{ errors }"
                  name="Password"
                  rules="required|min:8"
                >
                  <div class="d-flex justify-content-between">
                    <label for="login-password">Password</label>
                    <b-link
                      :to="{ name: 'forgotPassword' }"
                    >
                      <small>Zapomniałeś hasła?</small>
                    </b-link>
                  </div>
                  <b-form-input
                    id="login-password"
                    v-model="userPassword"
                    :state="errors.length > 0 ? false : null"
                    name="login-password"
                    type="password"
                    placeholder="····"
                  />
                </validation-provider>
              </b-form-group>
            </b-form>
            <b-button
              variant="success"
              @click="login"
            >
              Zaloguj
            </b-button>

          </validation-observer>
          <div class="text-center mt-3">
            <p>Nie masz jeszcze konta? <b-link :to="{ name: 'register' }" > Zarejestruj się!</b-link>
            </p>
          </div>
        </b-col>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import store from '@/store/index'
import {
  BButton, BFormInput, BRow, BCol, BCardTitle, BFormGroup, BForm, BImg, BLink,
} from 'bootstrap-vue'
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import { required, email, min } from '@validations'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default {
  components: {
    BButton,
    BFormInput,
    BRow,
    BCol,
    BCardTitle,
    BFormGroup,
    ValidationProvider,
    ValidationObserver,
    BForm,
    BImg,
    BLink,

  },
  data() {
    return {
      userEmail: '',
      required,
      email,
      userPassword: '',
      min,
    }
  },
  computed: {
    imgUrl() {
      if (store.state.appConfig.layout.skin === 'dark') {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.sideImg = require('@/assets/images/pages/login-v2-dark.svg')
        return this.sideImg
      }else{
        this.sideImg = require('@/assets/images/pages/login-v2.svg')
        return this.sideImg
      }
    },
  },
  methods: {
    login() {
      this.$refs.loginValidation.validate().then(async success => {
        if (success) {
          this.$store.dispatch('auth/login', {
            email: this.userEmail,
            password: this.userPassword,
          })
            .then(() => {
              if (this.$store.getters['auth/getLoggedIn'] === true) {
                this.$store.dispatch('auth/loadUserData')
                  .then(() => {
                    this.$router.push({ name: 'home' })
                  })
              } else {
                this.$toast({
                  component: ToastificationContent,
                  props: {
                    title: 'Błędne dane logowania',
                    icon: 'UserIcon',
                    variant: 'danger',
                  },
                })
              }
            })
            .catch(err => {
              this.$toast({
                component: ToastificationContent,
                props: {
                  title: err.response ? err.response.data.message : err.message,
                  icon: 'UserIcon',
                  variant: 'danger',
                },
              })
            })
        } else {
          console.error()
        }
      })
    },

  },
}

</script>

<style lang="scss">
@import '@resources/scss/vue/pages/page-auth.scss';
</style>
