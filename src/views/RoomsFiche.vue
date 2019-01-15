<template>

<div class="container">
  <div class="row">
    <div class="col-12">
      <h1>{{title}}</h1>
    </div>
    
    <div class="col-12" style="text-align:left">
      <router-link :to="{ name: 'ListRooms'}">
        <button type="button" class="btn btn-secondary">Return to list</button>
      </router-link>

      <form style="margin-top:20px">
        <div class="form-group">        
          <label for="name">Name :</label>
          <input type="text" class="form-text form-control" id="name" v-model="name">
        </div>

        <div class="form-group">
          <label for="capacity">Capacity :</label>
          <input type="text" class="form-text form-control" id="capacity" v-model="capacity">
        </div>

         <button type="button" class="btn btn-primary" v-on:click="save">Save</button>
      </form>
    </div>

  </div>
</div>

</template>

<script>
import axios from 'axios'

export default {
  name: 'ListRooms',
  components: {},
  data() {
    return {
      id: 0,
      name: "",
      capacity: null,
      title: null,
      busy: 0,
      end_busy_date: null,
      begin_busy_date: null
    }
  },
  methods: {
    get: function() {
      let idParams = this.$route.params.id

      if(idParams != "0")
      {
        axios.get('http://vps.quentinmodena.fr:2999/rooms/'+idParams)
          .then((response) => {
            this.id = response.data.data[0]._id;
            this.name = response.data.data[0].name;
            this.capacity = response.data.data[0].capacity;
            this.title = 'Edit room : ' + this.name;
          })
          .catch((response) => {
            console.error('An error occured. Please try again or contact administrator.')
          });
      }
      else
      {
        this.title = 'New room';
        this.name = ''
        this.capacity = '';
      }
    },
    save: function() {
      let self = this;

      if(this.id != 0)
      {
        axios.put('http://vps.quentinmodena.fr:2999/rooms/update?id='+this.$route.params.id, this.getData())
        .then((response) => {
          console.log("Save successfull");
        })
        .catch((response) => {
          console.error('An error occured. Please try again or contact administrator.')
        });
      }
      else
      {

        axios.post('http://vps.quentinmodena.fr:2999/rooms/add', this.getData())
        .then((response) => {
          console.log("Save successfull");
          let idnew = response.data.data._id;

          self.id = response.data.data._id;
          self.name = response.data.data.name;
          self.capacity = response.data.data.capacity;
          self.title = 'Edit room : ' + self.name;

          self.$router.push({ name: 'FicheRooms', params: { id:self.id } })
        })
        .catch((response) => {
          console.error('An error occured. Please try again or contact administrator. '+response)
        });
      }
    },
    getData: function() {
      return {
        name: this.name,
        capacity: this.capacity,
        busy: this.busy,
        end_busy_date: this.end_busy_date,
        begin_busy_date: this.begin_busy_date
      }
    }
  },
  mounted() {
    this.get();
  },
}
</script>
<style scoped lang="scss">

</style>
