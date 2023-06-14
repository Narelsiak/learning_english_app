<template>
  <div class="auth-wrapper auth-v2">
    <b-row class="auth-inner m-0">
      <b-col
        lg="8"
        class="d-none d-lg-flex align-items-center p-5"
      >
        <div
          class="w-100 d-lg-flex align-items-center justify-content-center px-5"
        >
          <b-img
            fluid
            :src="imgUrl"
            alt="Registration"
          />
        </div>
      </b-col>
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
              <b-card-title>Tworzenie konta</b-card-title>
              <b-form-group label="Imię">
                <ValidationProvider
                  #default="{ errors }"
                  name="First Name"
                  rules="required"
                >
                  <b-form-input
                    id="registration-firstname"
                    v-model="firstName"
                    :state="errors.length > 0 ? false : null"
                    name="registration-firstname"
                    placeholder="John"
                  />
                  <small class="text-danger">{{
                      errors[0]
                    }}</small>
                </ValidationProvider>
              </b-form-group>
              <b-form-group label="Nazwisko">
                <ValidationProvider
                  #default="{ errors }"
                  name="Last Name"
                  rules="required"
                >
                  <b-form-input
                    id="registration-lastname"
                    v-model="lastName"
                    :state="
                      errors.length > 0 ? false : null
                    "
                    name="registration-lastname"
                    placeholder="Doe"
                  />
                  <small class="text-danger">{{ errors[0] }}</small>
                </ValidationProvider>
              </b-form-group>

              <b-form-group label="Data urodzenia">
                <validation-provider
                  name="BirthDate"
                  rules="required"
                >
                  <b-form-datepicker
                    v-model="birthDate"
                    placeholder="Wybierz datę"
                  />
                </validation-provider>
              </b-form-group>

              <b-form-group label="Email">
                <ValidationProvider
                  #default="{ errors }"
                  name="Email"
                  rules="required|email"
                >
                  <b-form-input
                    id="registration-email"
                    v-model="userEmail"
                    :state="
                      errors.length > 0
                        ? false
                        : userEmail.includes(' ')
                          ? false
                          : null
                    "
                    name="registration-email"
                    placeholder="john@example.com"
                  />
                  <small class="text-danger">{{
                      errors[0]
                    }}</small>
                </ValidationProvider>
              </b-form-group>

              <b-form-group label="Hasło">
                <validation-provider
                  #default="{ errors }"
                  name="Password"
                  rules="required|min:8|regex:^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$"
                >
                  <div class="d-flex justify-content-between"></div>
                  <b-form-input
                    id="login-password"
                    v-model="userPassword"
                    :state="
                      errors.length > 0 ? false : null
                    "
                    name="password"
                    type="password"
                    placeholder="1 duża litera, 1 cyfra, 1 znak specjalny"
                  />
                  <small class="text-danger">{{errors[0]}}</small>
                </validation-provider>
              </b-form-group>

              <b-form-group label="Potwierdź hasło">
                <b-form-input
                  v-model="confirmPassword"
                  type="password"
                  placeholder="····"
                  name = "password_confirmation"
                />
              </b-form-group>

              <b-button
                variant="success"
                @click="register"
              >
                Utwórz konto
              </b-button>
            </b-form>
          </validation-observer>

        </b-col>
      </b-col>
    </b-row>

  </div>
</template>

<script>
import store from '@/store/index'
import {
  BButton,
  BFormInput,
  BRow,
  BCol,
  BCardText,
  BCardTitle,
  BFormGroup,
  BForm,
  BImg,
  BLink,
  BFormDatepicker,
  BIcon ,
} from 'bootstrap-vue'
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import { required, email, min, confirmed, regex } from '@validations'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default {
  components: {
    BButton,
    BFormInput,
    BRow,
    BCol,
    BCardText,
    BCardTitle,
    BFormGroup,
    ValidationProvider,
    ValidationObserver,
    BForm,
    BImg,
    BLink,
    BFormDatepicker,
    BIcon ,
  },
  data() {
    return {
      firstName: '',
      lastName: '',
      birthDate: null,
      userEmail: '',
      userPassword: '',
      confirmPassword: '',

    }
  },
  computed: {

    imgUrl() {
      if (store.state.appConfig.layout.skin === 'dark') {
        // eslint-disable-next-line vue/no-side-effects-in-computed-properties
        this.sideImg = require('@/assets/images/pages/register-v2-dark.svg')
        return this.sideImg
      }else{
        this.sideImg = require('@/assets/images/pages/register-v2.svg')
        return this.sideImg
      }
    },
  },

  methods: {
    register() {
      this.$refs.loginValidation.validate()
        .then(async success => {
          if (success) {
            if (this.userPassword === this.confirmPassword) {
              this.$swal({
                title: 'Trwa tworzenie konta',
              })
              this.$store
                .dispatch('auth/register', {
                  email: this.userEmail,
                  password: this.userPassword,
                  birth_date: this.birthDate,
                  name: this.firstName,
                  surname: this.lastName,
                })
                .then(() => {
                  this.$swal
                  if (this.$store.getters['auth/getLoggedIn'] === true) {
                    this.$toast({
                      component: ToastificationContent,
                      props: {
                        title: 'Poprawna rejestracja',
                        icon: 'UserIcon',
                        variant: 'success',
                      },
                    })
                    this.$store.dispatch('auth/loadUserData')
                      .then(() => {
                        this.$swal({
                          title: 'Stworzyłeś konto',
                          icon: 'success',
                          customClass: {
                            confirmButton: 'btn btn-primary',
                          },
                          buttonsStyling: false,
                        })
                        this.$router.push({ name: 'home' })
                      })
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
            } else {
              this.$toast({
                component: ToastificationContent,
                props: {
                  title: 'Hasła nie są takie same',
                  icon: 'UserIcon',
                  variant: 'danger',
                },
              })
            }
          } else {


          }
        })
    },
  },
}
</script>

<style lang="scss">
@import "@resources/scss/vue/pages/page-auth.scss";
</style>
