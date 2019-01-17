<template>
<div class="Groups">
  <!-- Sidebar -->
  <Navigation></Navigation>

  <h1>Groups</h1>
  <div class="row marginleft">
    <div class="col-lg-2">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>List group</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="group in groups">
            <th @click="getUsersByGroup(group._id), getLessonsByGroup(group._id)" v-bind:id="group._id" class="title">{{ group.name }}</th>
          </tr>
          <b-modal @ok="addUserGroup(groupId)" id="addUser" title="Add User">
            <select v-model="selected" @change="Change">
              <option v-for="alluser in allusers" v-bind:id="alluser._id" @click="retrieveIdUserOfSelect(alluser._id)">{{ alluser.firstname }} {{ alluser.lastname }}</option>
            </select>
            <span>{{ selected }}</span>
          </b-modal>
        </tbody>
      </table>
    </div>

    <div class="col-lg-4 displayNone">
      <b-button v-b-modal.addUser variant="success">add Users</b-button>
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>List Users</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" id="addUserTable">
            <th>{{ user.firstname }}</th>
            <th>
              <b-button @click="deleteGroupUser(user._id)"><i class="far fa-trash-alt"></i></b-button>
            </th>
          </tr>
        </tbody>
      </table>
    </div>


    <div class="col-lg-6 displayNone">
      <b-button v-b-modal.addLesson variant="success" @click="getAllCourses()">add Lessons</b-button>
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Lesson</th>
            <th>Room</th>
            <th>Date of start</th>
            <th>Date of end</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="course in courses">
            <th>{{ course.label }}</th>
            <th>{{ course.room_name }}</th>
            <th>{{ course.date_start }}</th>
            <th>{{ course.date_end }}</th>
            <th>
              <b-button @click="deleteCoursesGroup(course._id)"><i class="far fa-trash-alt"></i></b-button>
            </th>
          </tr>
          <b-modal @ok="retrieveCoursesIdOfSelect(coursesId),retrieveLabelRoomNameOfSelect(roomId), getDatestart(), addLesson(coursesId, roomId, groupId)" id="addLesson" title="Add Lessons">
            <div class="row">
              <div class="col-lg-6">
                <p>Date start</p>
                <input type="date" id="datestart" />
                <p>Hour start</p>
                <input type="number" id="hourStart" />
                <p>select to lesson</p>
                <select>
                  <option v-for="lesson in allcourses" @click="retrieveCoursesIdOfSelect(lesson._id)">{{ lesson.label }}</option>
                </select>
              </div>
              <div class="col-lg-6">
                <p>Date end</p>
                <input type="date" id="dateEnd" />
                <p>Hour end</p>
                <input type="number" id="hourEnd" />
                <p>select to room</p>
                <select>
                  <option v-for="room in rooms" @click="retrieveLabelRoomNameOfSelect(room._id)">{{ room.name }}</option>
                </select>
              </div>
            </div>
          </b-modal>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
</template>

<script>
import Navigation from '@/components/Navigation'
import axios from 'axios'

export default {
  name: 'Groups',
  components: {
    'Navigation': Navigation
  },
  data() {
    return {
      groups: [],
      users: [],
      allusers: [],
      courses: [],
      allcourses: [],
      rooms: [],
      roomId: null,
      coursesLabel: [],
      groupId: null,
      userId: null,
      coursesId: null,
      selected: '',
      eventSelect: ''
    }
  },
  methods: {
    getDatestart: function(e) {
      let datestart = $("#datestart").val()
      console.log(datestart)
    },
    getAllGroups: function(event) {
      axios.get('http://vps.quentinmodena.fr:2999/groups/all')
        .then((response) => {
          this.groups = response.data.data
        })
        .catch((response) => {
          alert('An error occured. Please try again or contact administrator.')
        })
    },
    getallUsers: function() {
      axios.get('http://vps.quentinmodena.fr:2999/users/all')
        .then((response) => {
          this.allusers = response.data.list_of_users
        })
        .catch((response) => {
          alert('An error occured. Please try again or contact administrator.')
        })
    },
    deleteGroupUser: function(userId) {
      let usersInGroupObject = this.users //génère une chaîne des users
      // All users before delete
      let tempUsersId = []
      let userToDelete = null
      usersInGroupObject.forEach(function(element) { //pour chaque utilisateur
        tempUsersId.push(element) //passe l'utilisateur dans la chaîne temporaire
      }) //ce qui clone la chaîne des users
      console.log('Tableau de départ ', tempUsersId)
      userToDelete = userId //on passe l'argument comme user à supprimer

      // Trouver index de l'utilisateur
      let whereIsIt = tempUsersId.indexOf(userToDelete) //on trouve le user à supprimer dans la chaîne temporaire

      // Supprimer à l'index
      let finalArray = tempUsersId.splice(whereIsIt, 1) //on crée la chaîne sans l'user ciblé
      console.log('Tableau final ', tempUsersId)
      this.users = tempUsersId //on remplace la chaîne par la nouvelle chaîne

      this.userId = userId
      let ArrayUsersId = []
      ArrayUsersId.push(this.userId)

      axios.put(`http://vps.quentinmodena.fr:2999/groups/remove-courses-to/${this.groupId}`, ArrayUsersId)
        .then((response) => {
          this.userId = null
        })
        .catch((response) => {
          console.log('err', response);
        })
    },
    deleteCoursesGroup: function(coursesId) {
      let coursesInGroupObject = this.courses //génère une chaîne des users
      // All users before delete
      let tempCoursesId = []
      let coursesToDelete = null
      coursesInGroupObject.forEach(function(element) { //pour chaque utilisateur
        tempCoursesId.push(element) //passe l'utilisateur dans la chaîne temporaire
      }) //ce qui clone la chaîne des users
      //console.log('Tableau de départ ', tempCoursesId);
      coursesToDelete = coursesId //on passe l'argument comme user à supprimer

      // Trouver index de l'utilisateur
      let whereIsIt = tempCoursesId.indexOf(coursesToDelete) //on trouve le user à supprimer dans la chaîne temporaire

      // Supprimer à l'index
      let finalArray = tempCoursesId.splice(whereIsIt, 1) //on crée la chaîne sans l'user ciblé
      //console.log('Tableau final ', tempCoursesId)
      this.courses = tempCoursesId //on remplace la chaîne par la nouvelle chaîne

      this.coursesId = coursesId
      let ArrayCoursesId = []
      ArrayCoursesId.push(this.coursesId)

      axios.put(`http://vps.quentinmodena.fr:2999/groups/remove-courses-to/${this.groupId}`, ArrayCoursesId)
        .then((response) => {
          this.coursesId = null
        })
        .catch((response) => {
          console.log('err', response);
        })
    },
    Change(e) {
      //
    },
    retrieveIdUserOfSelect: function(userId) {
      this.userId = userId
    },
    retrieveCoursesIdOfSelect: function(lessonId) {
      console.log('retrieveCoursesIdOfSelect', lessonId)
      if (lessonId == null) {
        this.coursesId = this.courses[0]._id
      } else {
        this.coursesId = lessonId
      }
    },
    retrieveLabelRoomNameOfSelect: function(roomId) {
      console.log('retrieveLabelRoomNameOfSelect', roomId);
      this.roomId = roomId
      if (roomId == null) {
        this.roomId = this.rooms[0]._id
      } else {
        this.roomId = roomId
      }
    },
    addUserGroup: function(groupId) {
      let ArrayUsersId = []
      ArrayUsersId.push(this.userId)
      axios.put(`http://vps.quentinmodena.fr:2999/groups/add-user-to/${this.groupId}`, ArrayUsersId)
        .then((response) => {
          this.userId = null
          this.getUsersByGroup(groupId)
        })
        .catch((response) => {
          console.log('Error addUserGroup', response);
        })
    },
    addLesson: function(coursesId, roomId, groupId) {
      let self = this
      this.coursesId = coursesId
      this.roomId = roomId
      //console.log('addLesson', this.coursesId)
      var jsonCreateLesson = {
        'course_id': coursesId,
        'room_id': roomId,
        'date_start': $('#datestart').val(),
        'date_end': $('#dateEnd').val(),
        'hour_start': $('#hourStart').val(),
        'hour_end': $('#hourEnd').val()
      }
      const url = `http://vps.quentinmodena.fr:2999/groups/add-course-to/${this.groupId}`
      axios.put(url, jsonCreateLesson).then(function(response) {
        console.log('Addlesson put', response);
        //self.getLessonsByGroup(groupId)
      }).catch(function(response) {
        console.log('Error add lesson.', response)
      })
    },
    getUsersByGroup: function(groupId) {
      this.groupId = groupId
      axios.get(`http://vps.quentinmodena.fr:2999/groups/users-of/${groupId}`)
        .then((response) => {
          this.users = response.data.data
          $(".displayNone").css("display", "block")
        })
        .catch((response) => {
          alert('Erreur de récupération des Users.')
        })
    },
    getLessonsByGroup: function(groupId) {
      let self = this
      let tabFinalLessons = []
      axios.get(`http://vps.quentinmodena.fr:2999/groups/one/${groupId}`)
        .then((response) => {
          var tabLessons = response.data.data[0].courses
          $.each(tabLessons, function(key, value) {
            var date_start = ""
            var date_end = ""
            if (value.date_start != undefined)
              date_start = value.date_start.slice(0, 10)
            if (value.date_end != undefined)
              date_end = value.date_end.slice(0, 10)
            var tmpLesson = {
              '_id': value.course_id,
              'label': value.course_name,
              'room_name': value.room_name,
              'date_start': date_start,
              'date_end': date_end
            }
            tabFinalLessons.push(tmpLesson)
          })
          self.courses = tabFinalLessons
        })
        .catch((response) => {
          console.log('Error when getting lessons by group', response)
        })
    },
    getCourses: function() {
      axios.get('http://vps.quentinmodena.fr:2999/courses/all')
        .then((response) => {
          this.courses = response.data.data
        })
        .catch((response) => {
          alert('Erreur de récupération des Cours.')
        })
    },
    getallRooms: function() {
      axios.get('http://vps.quentinmodena.fr:2999/rooms/all')
        .then((response) => {
          this.rooms = response.data
        })
        .catch((response) => {
          alert('Erreur de récupération des Rooms.')
        })
    },
    getAllCourses: function() {
      axios.get('http://vps.quentinmodena.fr:2999/courses/all')
        .then((response) => {
          this.allcourses = response.data.data
        })
        .catch((response) => {
          alert('Erreur de récupération des Cours.')
        })
    }
  },
  mounted() {
    this.getAllGroups()
    this.getallUsers()
    this.getallRooms()
  }
}
</script>

<style scoped>

</style>
