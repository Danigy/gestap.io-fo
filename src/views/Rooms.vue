<template>
<div>
  <!-- Sidebar -->
  <Navigation></Navigation>
  <!-- Rooms -->
  <h1>Rooms</h1>
  <!-- Button Add room -->
  <button class="addButton bg-blue" @click="showModalCreate()">Add Room</button>
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
          <label for="name">Name</label>
          <input id="nameCreate" placeholder="Name" type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="capacity">Capacity</label>
          <input id="capacityCreate" type="number" name="capacity" class="form-control">
        </div>
        <b-btn class="mt-3" variant="outline-primary" block @click="createRoom()">Submit</b-btn>
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
          <label for="idroom">id</label>
          <input id="idroom" v-model="idroom" type="text" name="idroom" class="form-control">
        </div>
        <div class="form-group">
          <label for="name">Name</label>
          <input id="nameUpdate" v-model="name" type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="capacity">Capacity</label>
          <input id="capacityUpdate" v-model="capacity" type="number" name="capacity" class="form-control">
        </div>
        <b-btn class="mt-3" variant="outline-primary" block @click="updateRoom()">Submit</b-btn>
      </div>
    </div>
  </div>
  <!--  -->
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Capacity</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="room in rooms">
        <th>{{ room.name }}</th>
        <td>{{ room.capacity }}</td>
        <td>
          <button class="roomButton bg-blue" @click="showModalUpdate(room)"><i class="fas fa-pen"></i></button>
          <button class="roomButton bg-red" @click="deleteRoom(room)"><i class="far fa-trash-alt"></i></button>
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
  name: 'Rooms',
  components: {
    'Navigation': Navigation
  },
  data() {
    return {
      rooms: [],
      idroom: "",
      name: "",
      capacity: ""
    }
  },
  methods: {
    getRooms: function() {
      axios.get('http://vps.quentinmodena.fr:2999/rooms/all')
        .then((response) => {
          this.rooms = response.data
        })
        .catch((response) => {
          console.error('An error occured. Please try again or contact administrator.')
        });
    },
    deleteRoom: function(room) {
      const url = `http://vps.quentinmodena.fr:2999/rooms/delete?id=${room._id}`
      axios.delete(url)
      return location.reload()
    },
    createRoom: function() {
      var jsonCreate = {
        'name': $('#nameCreate')[0].value,
        'capacity': $('#capacityCreate')[0].value,
        'busy': 0,
        'end_busy_date': null,
        'start_busy_date': null
      }
      const url = `http://vps.quentinmodena.fr:2999/rooms/add`
      axios.post(url, jsonCreate).then(function(response) {
        return location.reload()
      }).catch(function(response) {
        alert('An error occured. Please try again or contact administrator.')
      })
    },
    updateRoom: function() {
      var idroom = $('#idroom')[0].value
      var jsonUpdate = {
        'name': $('#nameUpdate')[0].value,
        'capacity': $('#capacityUpdate')[0].value,
        'busy': 0,
        'end_busy_date': null,
        'start_busy_date': null
      }
      const url = `http://vps.quentinmodena.fr:2999/rooms/update?id=` + idroom
      axios.put(url, jsonUpdate)
      return location.reload()
    },
    showModalUpdate: function(room) {
      this.idroom = room._id
      this.name = room.name
      this.capacity = room.capacity
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
    this.getRooms()
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

.roomButton {
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
