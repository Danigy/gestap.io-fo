<template>
<div>
  <!-- Sidebar -->
  <Navigation></Navigation>
  <!-- Lessons -->
  <h1>Lessons</h1>
  <!-- Button Add Lesson -->
  <button class="addButton bg-blue" @click="showModalCreate()">Add Lesson</button>
  <!-- Modal Create -->
  <div id="modalCreate" hidden="true" class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create</h5>
        <button type="button" class="close" @click="hideModalCreate" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="label">Name</label>
          <input id="labelCreate" placeholder="Name" type="text" name="label" class="form-control">
        </div>
        <b-btn class="mt-3" variant="outline-primary" block @click="createLesson()">Submit</b-btn>
      </div>
    </div>
  </div>
  <!-- Modal Update -->
  <div id="modalUpdate" hidden="true" class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update</h5>
        <button type="button" class="close" @click="hideModalUpdate" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group" hidden>
          <label for="idLesson">id</label>
          <input id="idLesson" v-model="idLesson" type="text" name="idLesson" class="form-control">
        </div>
        <div class="form-group">
          <label for="label">Name</label>
          <input id="labelUpdate" v-model="label" type="text" name="label" class="form-control">
        </div>
        <b-btn class="mt-3" variant="outline-primary" block @click="updateLesson()">Submit</b-btn>
      </div>
    </div>
  </div>
  <!-- Lessons Table -->
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="lesson in lessons">
        <td>{{ lesson.label }}</td>
        <td>
          <button class="lessonButton bg-blue" @click="showModalUpdate(lesson)"><i class="fas fa-pen"></i></button>
          <button class="lessonButton bg-red" @click="deleteLesson(lesson)"><i class="far fa-trash-alt"></i></button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
</template>

<script>
import Navigation from '@/components/Navigation'
import axios from 'axios'

export default {
  name: 'Lessons',
  components: {
    'Navigation': Navigation
  },
  data() {
    return {
      lessons: [],
      idLesson: "",
      label: ""
    }
  },
  methods: {
    getLessons: function() {
      axios.get('http://vps.quentinmodena.fr:2999/courses/all')
        .then((response) => {
          this.lessons = response.data.data
        })
        .catch((response) => {
          alert('An error occured. Please try again or contact administrator.')
        })
    },
    createLesson: function() {
      var jsonCreate = {
        'label': $('#labelCreate')[0].value
      }
      const url = `http://vps.quentinmodena.fr:2999/courses/add`
      axios.post(url, jsonCreate).then(function(response) {
        return location.reload()
      }).catch(function(response) {
        alert('An error occured. Please try again or contact administrator.')
      })
    },
    updateLesson: function() {
      var idLesson = $('#idLesson')[0].value
      var jsonUpdate = {
        'label': $('#labelUpdate')[0].value
      }
      const url = `http://vps.quentinmodena.fr:2999/courses/update?id=` + idLesson
      axios.put(url, jsonUpdate)
      return location.reload()
    },
    deleteLesson: function(lesson) {
      const url = `http://vps.quentinmodena.fr:2999/courses/delete?id=${lesson._id}`
      axios.delete(url)
      return location.reload()
    },
    showModalUpdate: function(lesson) {
      this.idLesson = lesson._id
      this.label = lesson.label
      $('#modalUpdate').attr('hidden', false)
    },
    hideModalUpdate: function() {
      $('#modalUpdate').attr('hidden', true)
    },
    showModalCreate: function() {
      $('#modalCreate').attr('hidden', false)
    },
    hideModalCreate: function() {
      $('#modalCreate').attr('hidden', true)
    }
  },
  mounted() {
    this.getLessons()
  },
}
</script>
<style scoped lang="scss">
#modalCreate,
#modalUpdate {
    position: absolute;
    width: 100%;
    height: 100%;
    margin-left: 35%;
    margin-top: -10vh;
}

td {
    vertical-align: middle;
}

.addButton {
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 20px;
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    cursor: pointer;
}

.lessonButton {
    border: none;
    color: white;
    padding: 12px 14px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 5px;
    cursor: pointer;
}

.bg-blue {
    background-color: #008CBA;
}

.bg-red {
    background-color: #f44336;
}
</style>
