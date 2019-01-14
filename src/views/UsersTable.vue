<template>
<div>
  <h1>Users</h1>
  <button class="addButton" @click="showModalCreate()"><img src="../assets/open-iconic/svg/plus.svg"></button>
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
          <label for="firstname">First Name</label>
          <input id="firstnameCreate" placeholder="First Name" type="text" name="firstname" class="form-control">
        </div>
        <div class="form-group">
          <label for="lastname">Last Name</label>
          <input id="lastnameCreate" placeholder="Last Name" type="text" name="lastname" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input id="emailCreate" placeholder="Email" type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
          <label for="birthday">Birthday</label>
          <input id="birthdayCreate" placeholder="Birthday" type="date" name="birthday" class="form-control">
        </div>
        <div class="form-group">
          <label for="rfid">RFID</label>
          <input id="rfidCreate" placeholder="RFID" type="text" name="rfid" class="form-control">
        </div>
        <b-btn class="mt-3" variant="outline-primary" block @click="createUser()">Submit</b-btn>
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
          <label for="iduser">id</label>
          <input id="idUser" v-model="iduser" type="text" name="iduser" class="form-control">
        </div>
        <div class="form-group">
          <label for="firstname">First Name</label>
          <input id="firstnameUpdate" v-model="firstname" type="text" name="firstname" class="form-control">
        </div>
        <div class="form-group">
          <label for="lastname">Last Name</label>
          <input id="lastnameUpdate" v-model="lastname" type="text" name="lastname" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input id="emailUpdate" v-model="email" type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
          <label for="birthday">Birthday</label>
          <input id="birthdayUpdate" v-model="birthday" type="date" name="birthday" class="form-control">
        </div>
        <div class="form-group">
          <label for="rfid">RFID</label>
          <input id="rfidUpdate" v-model="rfid" type="text" name="rfid" class="form-control">
        </div>
        <b-btn class="mt-3" variant="outline-primary" block @click="updateUser()">Submit</b-btn>
      </div>
    </div>
  </div>

  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>RFID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Birthday</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="user in users">
        <th><span v-for="rfid in user.rfid"> {{ rfid }} </span></th>
        <td>{{ user.firstname }}</td>
        <td>{{ user.lastname }}</td>
        <td>{{ user.email }}</td>
        <td>{{ user.birthday }}</td>
        <td>
          <button class="btn btn-primary" @click="showModalUpdate(user)">Modify</button>
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
      users: [],
      iduser: "",
      firstname: "",
      lastname: "",
      email: "",
      birthday: "",
      rfid: ""
    }
  },
  methods: {
    getUsers: function() {
      axios.get('http://vps.quentinmodena.fr:2999/users/all')
        .then((response) => {
          this.users = response.data.list_of_users
        })
        .catch((response) => {
          alert('An error occured. Please try again or contact administrator.')
        })
    },
    createUser: function() {
      var jsonCreate = {
        'firstname': $('#firstnameCreate')[0].value,
        'lastname': $('#lastnameCreate')[0].value,
        'email': $('#emailCreate')[0].value,
        'password': "",
        'birthday': $('#birthdayCreate')[0].value,
        'rfid': $('#rfidCreate')[0].value.split(','),
        'admin': 0
      }
      const url = `http://vps.quentinmodena.fr:2999/users/add`
      axios.post(url, jsonCreate).then(function(response) {
        return location.reload()
      }).catch(function(response) {
        alert('An error occured. Please try again or contact administrator.')
      })
    },
    updateUser: function() {
      var idUser = $('#idUser')[0].value
      var jsonUpdate = {
        'firstname': $('#firstnameUpdate')[0].value,
        'lastname': $('#lastnameUpdate')[0].value,
        'email': $('#emailUpdate')[0].value,
        'birthday': $('#birthdayUpdate')[0].value,
        'rfid': $('#rfidUpdate')[0].value.split(',')
      }
      const url = `http://vps.quentinmodena.fr:2999/users/update?id=` + idUser
      axios.put(url, jsonUpdate)
      return location.reload()
    },
    deleteUser: function(user) {
      const url = `http://vps.quentinmodena.fr:2999/users/delete?id=${user._id}`
      axios.delete(url)
      return location.reload()
    },
    showModalUpdate: function(user) {
      this.iduser = user._id
      this.firstname = user.firstname
      this.lastname = user.lastname
      this.email = user.email
      this.birthday = user.birthday
      this.rfid = user.rfid
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
    this.getUsers()
  },
}
</script>
<style scoped lang="scss">
#modalCreate,
#modalUpdate {
    position: absolute;
    width: 50vw;
    margin: 15vh auto auto 33vw;
}

.addButton {
    width: 50px;
    height: 50px;
    background-color: royalblue;
    border-radius: 50%;
}
</style>
