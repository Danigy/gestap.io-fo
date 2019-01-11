<template>
<div>
  <h1>Users</h1>
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Birthday</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="user in users">
        <th>{{ user.firstname }}</th>
        <td>{{ user.lastname }}</td>
        <td>{{ user.email }}</td>
        <td>{{ user.birthday }}</td>
        <td>
          <button class="btn btn-primary" @click="updateUser(user)">Modify</button>
          <button class="btn btn-danger" @click="deleteUser(user)"> X</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'ListUsers',
  components: {},
  data() {
    return {
      users: []
    };
  },
  methods: {
    getUsers: function() {
      axios.get('http://ebcitakademy.alwaysdata.net/users/all')
        .then((response) => {
          this.users = response.data.list_of_users
        })
        .catch((response) => {
          alert('An error occured. Please try again or contact administrator.')
        })
    },
    deleteUser: function(user) {
      const url = `http://ebcitakademy.alwaysdata.net/users/delete?id=${user._id}`
      axios.delete(url)
      return location.reload()
    },
    updateUser: function(user) {
      $('#modifyUser').remove('hidden')
    }
  },
  mounted() {
    this.getUsers()
  },
}
</script>
