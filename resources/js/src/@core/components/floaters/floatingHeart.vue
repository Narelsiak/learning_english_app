<template>
  <div>
    <div
      v-if="showHeart"
      class="floating-heart"
      :style="{ color: heartColor, fontSize: heartSize, '--random-value': randomValue }"
      @click="handleClick"
    >
      <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      >
      <i class="fas fa-heart" />
    </div>
  </div>
</template>

<script>

import useJwt from '@/auth/jwt/useJwt'
import { eventBus } from '@/store/eventBus'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'
import swal from 'sweetalert2'
export default {
  name: 'FloatingHeart',
  data() {
    return {
      showHeart: true,
      heartColor: 'red',
      heartSize: '30px',
      randomValue: 0,
      showToast: false,
      toastAutoHideDelay: 5000,
      task: {},
      heartAvailable: false,
    }
  },
  mounted() {
    this.showHeart = false
    this.checkIfHeartCanBeSpawned()
    this.checkHeartInterval = setInterval(() => {
      this.checkIfHeartCanBeSpawned()
    }, 90000)
  },
  beforeDestroy() {
    clearInterval(this.checkHeartInterval)
  },
  methods: {
    checkIfHeartCanBeSpawned() {
      useJwt.axiosIns.get('/api/system/daily_user_life')
        .then(res => {
          if (res.data.data.spawn_heart === 1) {
            this.task = res.data.data.translate_word
            this.showHeart = true
          } else {
            this.showHeart = false
          }
          this.animateHeart()
          this.setRandomLeft()
        })
    },
    handleClick() {
      this.showHeart = false
      clearInterval(this.checkHeartInterval)
      this.$swal({
        title: `Przetłumacz słowo "${this.task.word}"`,
        input: 'text',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ml-1',
        },
        buttonsStyling: false,
        inputAttributes: {
          autocapitalize: 'off',
        },
        showCancelButton: false,
        confirmButtonText: 'Zweryfikuj',
        cancelButtonText: 'Anuluj',
        showLoaderOnConfirm: true,
        preConfirm(word) {
          if (!word) return null
          return word
        },
      }).then(word => {
        // eslint-disable-next-line no-param-reassign
        word = word.value
        const body = {
          original_word_lan: this.task.word_language,
        }
        if (this.task.word_language === 'en') {
          body.word_en = this.task.word
          body.word_pl = word
        } else {
          body.word_pl = this.task.word
          body.word_en = word
        }
        console.log(body)
        this.checkHeartInterval = setInterval(() => {
          this.checkIfHeartCanBeSpawned()
        }, 20000)
        return useJwt.axiosIns.patch('/api/system/daily_user_life/plus', body)
          .then(response => {
            if (!response.ok) {
              if (response.data.success === true) {
                if (response.data.data.update.achievement.length) {
                  const achievementName = response.data.data.update.achievement.length > 1 ? response.data.data.update.achievement.join(', ') : response.data.data.update.achievement[0]
                  eventBus.$emit('displayAchievement', achievementName)
                  eventBus.$emit('refreshMoneyAndStreak')
                }
                eventBus.$emit('refreshHearts')
                swal.fire({
                  title: 'Poprawna odpowiedź!',
                  text: 'Gratulacje zdobyłeś dodatkowe życie',
                  icon: 'success',
                  confirmButton: 'btn btn-primary',
                })
              } else {
                swal.fire({
                  title: 'Błędna odpowiedź!',
                  text: `Bardzo się starałeś, lecz z gry wyleciałeś.\n Poprawna odpowiedź to: "${response.data.data.answer}"`,
                  icon: 'error',
                  confirmButton: 'btn btn-primary',
                })
              }
              throw new Error(response.statusText)
            }
            return response.json()
          })
          .catch(error => {
            this.$swal.showValidationMessage(`Request failed:  ${error}`)
          })
      })
    },
    setRandomLeft() {
      this.randomValue = Math.random()
    },
    animateHeart() {
      const floatingHeart = this.$el
      const onAnimationEnd = () => {
        if (!this.showHeart) {
          floatingHeart.removeEventListener('animationend', onAnimationEnd)
          floatingHeart.remove() // Remove the heart from the DOM
        }
      }
      floatingHeart.addEventListener('animationend', onAnimationEnd)
    },
  },

}
</script>

<style scoped>
.middle-toast {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.floating-heart {
    position: fixed;
    bottom: 0;
    left: calc(10% + (90% - 10%) * var(--random-value));
    transform: translateX(-50%) translateY(100%);
    animation: float 15s linear infinite; /* Added second animation */
    cursor: pointer;
    z-index: 9999; /* Set a high z-index value to ensure it's on top */
}

@keyframes float {
    0% {
        transform: translateX(-50%) translateY(100%);
    }
    100% {
        transform: translateX(50%) translateY(-100vh);
    }
}
.Vue-Toastification__toast--top-center {
    position:fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>
