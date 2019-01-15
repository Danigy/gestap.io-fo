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
            <th @click="getIdUsers">{{ group.name }}</th>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="col-lg-4" v-show="click">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>List Users</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="group in groups">
            <th @click="getCourses">{{ group._id }}</th>
          </tr>
        </tbody>
      </table>
      <b-button v-b-modal.addUser variant="success">add Users</b-button>

      <b-modal id="addUser" title="Bootstrap-Vue">

      </b-modal>
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
      usersid: [],
      courses: [],
      click: false,
      clickCourses: false
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
    getIdUsers: function() {
      axios.get('http://vps.quentinmodena.fr:2999/groups/all')
        .then((response) => {
          this.usersid = response.data.data[0].users
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
          console.log(this.courses);
          this.clickCourses = !this.clickCourses
        })
        .catch((response) => {
          alert('Erreur de récupération des Cours.')
        })
    }
  },
  mounted() {
    this.getAllGroups()
  },
}
</script>

<style scoped>

</style>
