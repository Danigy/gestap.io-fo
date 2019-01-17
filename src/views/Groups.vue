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
            <th @click="getGroupId(group._id)" v-bind:id="group._id" class="title">{{ group.name }}</th>
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
      <b-button v-b-modal.addUser variant="success">add Users</b-button>
    </div>


    <div class="col-lg-6 displayNone">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>Lessons</th>
            <th>Rooms</th>
            <th>Date of start</th>
            <th>Date of end</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="course in courses">
            <th @click="getCourses">{{ course.label }}</th>
            <th>sonic </th>
            <th>date start</th>
            <th>date end</th>
            <th>
              <b-button @click="deleteCoursesGroup(course._id)"><i class="far fa-trash-alt"></i></b-button>
            </th>
          </tr>
          <b-modal @ok="addCourses(groupId),retrieveCoursesIdOfSelect(coursesId),retrieveLabelRoomNameOfSelect(roomId), getDatestart(), addLesson(coursesId, roomId, groupId)" id="addLesson" title="Add Lessons">
            <div class="row">
              <div class="col-lg-6">
                <p>Date start</p>
                <input type="date" id="datestart" />
                <p>Hour start</p>
                <input type="number" id="hourStart" />
                <p>select to lesson</p>
                <select>
                  <option v-for="course in courses" @click="retrieveCoursesIdOfSelect(course._id)">{{ course.label }}</option>
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
      <b-button v-b-modal.addLesson @click="getCourses()" variant="success">add Lessons</b-button>
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
          alert('Erreur de récupération des groupes.')
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
      console.log('Tableau de départ ', tempCoursesId);
      coursesToDelete = coursesId //on passe l'argument comme user à supprimer

      // Trouver index de l'utilisateur
      let whereIsIt = tempCoursesId.indexOf(coursesToDelete) //on trouve le user à supprimer dans la chaîne temporaire

      // Supprimer à l'index
      let finalArray = tempCoursesId.splice(whereIsIt, 1) //on crée la chaîne sans l'user ciblé
      console.log('Tableau final ', tempCoursesId)
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
    retrieveCoursesIdOfSelect: function(coursesId) {
      if (coursesId == null) {
        this.coursesId = this.courses[0]._id
      } else {
        this.coursesId = coursesId
      }
    },
    retrieveLabelRoomNameOfSelect: function(roomId) {
      this.roomId = roomId
      console.log('retrieveLabelRoomNameOfSelect', this.roomId);
      if (roomId == null) {
        this.roomId = this.rooms[0]._id
      } else {
        this.roomId = roomId
      }
    },
    addUserGroup: function(groupId) {
      let ArrayUsersId = []
      ArrayUsersId.push(this.userId)
      //var AddUserInArray = $("#AddUserInArray").val()
      axios.put(`http://vps.quentinmodena.fr:2999/groups/add-user-to/${this.groupId}`, ArrayUsersId)
        .then((response) => {
          this.userId = null
          this.getGroupId(groupId)
        })
        .catch((response) => {
          console.log(response);
          //alert('Erreur ajout User')
        })
    },
    addLesson: function(coursesId, roomId, groupId) {
      console.log('one')
      this.coursesId = coursesId
      this.roomId = roomId
      //console.log('addLesson', this.coursesId)
      var jsonCreate = {
        'course_id': coursesId,
        'room_id': roomId,
        'date_start': $('#datestart').val(),
        'date_end': $('#dateEnd').val(),
        'hour_start': $('#hourStart').val(),
        'hour_end': $('#hourEnd').val()
      }
      const url = `http://vps.quentinmodena.fr:2999/groups/add-course-to/${this.groupId}`
      axios.put(url, jsonCreate).then(function(response) {
        console.log('Addlesson put', response);
        //this.getCourses();
      }).catch(function(response) {
        console.log('Error add lesson.', response)
      })
      console.log(jsonCreate);
    },
    addCourses: function(groupId) {
      this.groupId = groupId
      console.log(groupId);
      axios.put(`http://vps.quentinmodena.fr:2999/groups/add-course-to/${this.groupId}`)
        .then((response) => {
          console.log(response);
          this.getCourses()
        })
        .catch((response) => {
          console.log('err', response);
          //alert('Erreur ajout User')
        })
    },
    getGroupId: function(groupId) {
      console.log('getGroupId', groupId)
      this.groupId = groupId
      axios.get(`http://vps.quentinmodena.fr:2999/groups/users-of/${groupId}`)
        .then((response) => {
          this.users = response.data.data
          $(".displayNone").css("display", "block")
          // let titleGroup = $(".title")[0].innerHTML
          // $("#titleGroup")[0].innerHTML = titleGroup
          // $("#titleCourses")[0].innerHTML = titleGroup
        })
        .catch((response) => {
          alert('Erreur de récupération des Users.')
        })
      axios.get(`http://vps.quentinmodena.fr:2999/groups/one/${groupId}`)
        .then((response) => {
          var jsonCourses = {}
          var tabCoursesId = []
          //console.log('etienne', response.data.data[0])
          $.each(response.data.data[0].courses, function(key, value) {
            tabCoursesId.push(response.data.data[0].courses[key])
            $.each(tabCoursesId, function(k, v) {
              //console.log('k', k, 'v', v)
              axios.get(`http://vps.quentinmodena.fr:2999/courses/one/` + v.course_id)
                .then((response) => {
                  //console.log('response lesson name', response)
                  jsonCourses[v] = response.data.data[0].label
                })
                .catch((respone) => {
                  //console.log('error when getting lesson name with lesson id', response)
                })
            })
          })
          //console.log('jsonCourses', jsonCourses)
          this.courses = jsonCourses
        })
        .catch((response) => {
          console.log('error get courses by group id', response)
        })
    },
    getCourses: function() {
      axios.get('http://vps.quentinmodena.fr:2999/courses/all')
        .then((response) => {
          console.log(response)
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
          console.log(this.rooms)
        })
        .catch((response) => {
          alert('Erreur de récupération des Rooms.')
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
