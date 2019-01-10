<template>
</template>
<script>
export default {
  name: 'getallUsers',
  components: {
    getallUsers
  },
  data: function() {
    return {
      allUsers: ''
    }
  },
  methods: {
    getAllUsers: function() {
      axios.get('http://ebcitakademy.alwaysdata.net/users/all')
        .then((response) => {
          this.allUsers = response.data.list_of_users
          console.log(response)
        })
        .catch((response) => {
          Alert("Erreur de chargement de l'API")
        })
    }
  },
  mounted() {
    this.getAllUsers()
  }
}
</script>
