<template>
  <b-overlay>
    <b-row>
      <b-col
        md="10"
      >
        <b-progress
          max="11"
          show-progress
          variant="primary"
          class="progress-bar-success mt-1"
        >
          <b-progress-bar :value="doneTasksAmount">
            {{ doneTasksAmount }} / 11
          </b-progress-bar>
        </b-progress>
      </b-col>
      <b-col
        md="2"
        style="text-align-last: end;"
      >
        <b-button
          variant="primary"
          :to="{ name: 'test.categories' }"
        >
          &lt; Powrót do listy kategorii
        </b-button>
      </b-col>
    </b-row>
    <div
      v-if="testTasks && testTasks[currentTaskId-1]"
      id="tests_container"
    >
      <FillSentence
        v-if="testTasks[currentTaskId-1].type === 'fill_sentence'"
        :data="task"
        :number="tasks_ids[doneTasksAmount]"
        @taskSuccess="taskSuccess"
        @wrongAnswer="checkHearths"
      />
      <ConnectPairs
        v-else-if="testTasks[currentTaskId-1].type === 'connect_pair'"
        :data="task"
        :number="tasks_ids[doneTasksAmount]"
        @taskSuccess="taskSuccess"
        @wrongAnswer="checkHearths"
      />
      <TranslateWord
        v-else-if="testTasks[doneTasksAmount].type === 'translate_word'"
        :data="task"
      />
      <Puzzle
        v-else-if="testTasks[currentTaskId-1].type === 'puzzle'"
        :data="task"
        :number="tasks_ids[doneTasksAmount]"
        @taskSuccess="taskSuccess"
        @wrongAnswer="checkHearths"
      />
    </div>
  </b-overlay>
</template>

<script>
import {
  BOverlay,
  BRow,
  BCol,
  BButton,
  BProgress,
  BProgressBar,
} from 'bootstrap-vue'
import useJwt from '@/auth/jwt/useJwt'
import ConnectPairs from '@/views/Test/Types/ConnectPairs.vue'
import FillSentence from '@/views/Test/Types/FillSentence.vue'
import TranslateWord from '@/views/Test/Types/TranslateWord.vue'
import Puzzle from '@/views/Test/Types/Puzzle.vue'
import { eventBus } from '@/store/eventBus'

export default {
  name: 'Test',
  components: {
    FillSentence,
    ConnectPairs,
    TranslateWord,
    Puzzle,
    BOverlay,
    BButton,
    BRow,
    BCol,
    BProgress,
    BProgressBar,
  },
  data() {
    this.showOverlay = true
    this.checkHearths()
    this.getTest()
    return {
      testTasks: [],
      doneTasksAmount: 0,
      current_task_id: 0,
      tasks_ids: [1, 7, 4, 9, 3, 5, 10, 2, 6, 8, 11],
      task: [],
    }
  },
  methods: {
    getCurrentTask() {
      useJwt.axiosIns.get(`/api/word/test/${this.$route.params.test_number}/${this.currentTaskId}`)
        .then(res => {
          this.task = res.data.data
          this.showOverlay = false
        })
        .catch(err => {
          console.log(err)
          this.showOverlay = false
        })
    },
    getTest() {
      useJwt.axiosIns.get(`/api/word/test/${this.$route.params.test_number}`)
        .then(res => {
          this.testTasks = res.data.data
          this.doneTasksAmount = 0
          this.testTasks.forEach(task => {
            // eslint-disable-next-line radix
            if (parseInt(task.status)) {
              this.doneTasksAmount += 1
            }
            this.currentTaskId = this.tasks_ids[this.doneTasksAmount]
          })
          if (this.doneTasksAmount >= 11) {
            this.$swal({
              title: 'Dobra robota!',
              text: 'Udało Ci się poprawnie rozwiązać test!',
              icon: 'success',
              customClass: {
                confirmButton: 'btn btn-primary',
              },
              buttonsStyling: false,
            })
              .then(() => {
                this.$router.push({ name: 'test.categories' })
              })
          } else {
            this.getCurrentTask()
          }
        })
        .catch(err => {
          console.log(err)
          this.showOverlay = false
        })
    },
    taskSuccess() {
      this.getTest()
      eventBus.$emit('refreshMoneyAndStreak')
    },
    checkHearths() {
      useJwt.axiosIns.get('/api/system/daily_user_life')
        .then(res => {
          eventBus.$emit('refreshHearts')
          if (res.data.data.life_count === 0) {
            this.$swal({
              title: 'Brak żyć!',
              text: 'Złap życie na ekranie lub poczekaj na odnowienie!',
              icon: 'error',
              customClass: {
                confirmButton: 'btn btn-primary',
              },
              buttonsStyling: false,
            })
              .then(() => {
                this.$router.push({ name: 'test.categories' })
              })
          }
        })
    },
  },
}
</script>

<style scoped>

</style>
