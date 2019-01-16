<template>
<div class="Groups">
  <!-- Sidebar -->
  <Navigation></Navigation>

  <h1>Groups</h1>
  <div class="row marginleft">
    <div class="col-lg-4">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>List group</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="group in groups">
            <th @click="getGroupId(group._id), getCourses()" v-bind:id="group._id">{{ group.name }}</th>
          </tr>
          <b-modal @ok="addUserGroup()" id="addUser" title="Add User">
            <select v-model="selected" @change="Change">
              <option v-for="alluser in allusers" v-bind:id="alluser._id" @click="retrieveIdUserOfSelect(alluser._id)">{{ alluser.firstname }} {{ alluser.lastname }}</option>
            </select>
            <span>{{ selected }}</span>
          </b-modal>
        </tbody>
      </table>

    </div>

    <div class="col-lg-4" v-show="click">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>List Users</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" id="addUserTable">
            <th @click="getCourses" id="trashUser">{{ user.firstname }}</th>
            <th>
              <b-button @click="deleteGroupUser()"><i class="far fa-trash-alt"></i></b-button>
            </th>
          </tr>
        </tbody>
      </table>
      <b-button v-b-modal.addUser variant="success">add Users</b-button>
    </div>


    <div class="col-lg-4" v-show="clickCourses">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>List Courses</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="course in courses">
            <th @click="getCourses">{{ course.label }}</th>
          </tr>
        </tbody>
      </table>
      <b-button variant="success">add Lessons</b-button>
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
      click: false,
      clickCourses: false,
      groupId: null,
      userId: null,
      selected: '',
      eventSelect: ''
    }
  },
  methods: {
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
          //console.log(response)
          this.allusers = response.data.list_of_users

        })
        .catch((response) => {
          alert('An error occured. Please try again or contact administrator.')
        })
    },
    deleteGroupUser: function() {
      const url = `http://vps.quentinmodena.fr:2999/groups/delete?id=${this.groupId}`
      axios.delete(url)
      //console.log(url);
    },
    Change(e) {
      console.log(this.$el.children[2])
    },
    retrieveIdUserOfSelect: function(userId) {
      this.userId = userId
    },
    addUserGroup: function() {
      let ArrayUsersId = []
      ArrayUsersId.push(this.userId)
      //var AddUserInArray = $("#AddUserInArray").val()
      axios.put(`http://vps.quentinmodena.fr:2999/groups/add-user-to/${this.groupId}`, ArrayUsersId)
        .then((response) => {
          this.userId = null
          return location.reload()
        })
        .catch((response) => {
          console.log(response);
          //alert('Erreur ajout User')
        })
    },
    getGroupId: function(groupId) {
      this.groupId = groupId
      axios.get(`http://vps.quentinmodena.fr:2999/groups/users-of/${groupId}`)
        .then((response) => {
          this.users = response.data.data
          this.click = !this.click
        })
        .catch((response) => {
          alert('Erreur de récupération des Users.')
        })
    },
    getCourses: function() {
      axios.get('http://vps.quentinmodena.fr:2999/courses/all')
        .then((response) => {
          this.courses = response.data.data
          //console.log(this.courses);
          this.clickCourses = !this.clickCourses
        })
        .catch((response) => {
          alert('Erreur de récupération des Cours.')
        })
    }
  },
  mounted() {
    this.getAllGroups()
    this.getallUsers()
  }
}
</script>

<style scoped>

</style>
