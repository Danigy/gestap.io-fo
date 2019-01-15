<template>
<div>
  <h1>Rooms</h1>
  <router-link :to="{ name: 'FicheRooms', params: { id: 0 }}">
    <button class="addButton"><img src="../assets/open-iconic/svg/plus.svg"></button>
  </router-link>

  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Capacity</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="data in listData">
        <th>{{ data.name }}</th>
        <td>{{ data.capacity }}</td>
        <td>
          <router-link :to="{ name: 'FicheRooms', params: { id: data._id }}">
            <button class="btn btn-primary">Modify</button>
          </router-link>
          <button class="btn btn-danger" @click="deleteUser(data)"> X</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>

</template>

<script>
import axios from 'axios'

export default {
  name: 'ListRooms',
  components: {},
  data() {
    return {
      listData: [],
    }
  },
  methods: {
    get: function() {
      axios.get('http://vps.quentinmodena.fr:2999/rooms/all')
        .then((response) => {
          this.listData = response.data
        })
        .catch((response) => {
          console.error('An error occured. Please try again or contact administrator.')
        });
    },
    deleteUser: function(data) {
      let self = this;

      const url = 'http://vps.quentinmodena.fr:2999/rooms/delete?id=' + data._id;
      axios.delete(url).then((response) => {
        self.get();
      });
    },
  },
  mounted() {
    this.get();
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
