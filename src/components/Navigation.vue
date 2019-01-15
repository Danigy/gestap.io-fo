<template>
<div>
  <nav>
    <img class="logo" src="/css/logo.jpg" />
    <ul class="sidebar navbar-nav">
      <li v-for="routes in links" class="nav-item">
        <router-link v-bind:key="routes.id" :to="`${routes.page}`" class="nav-link"><i v-bind:class="routes.myClass"></i><span>{{routes.text}}</span></router-link>
      </li>
      <li class="nav-item">
        <a href="/" @click="deconnexion" class="nav-link"><i class="fas fa-power-off"></i><span>Déconnexion</span></a></li>
    </ul>
  </nav>
</div>
</template>

<script>
$(document).ready(function() {
  if (sessionStorage.getItem('email') == null)
    window.location.href = "/"
});

export default {
  name: 'Navigation',
  data() {
    return {
      links: [{
          id: 0,
          text: 'Dashboard',
          page: '/Dashboard',
          myClass: 'fas fa-chart-bar'
        },
        {
          id: 1,
          text: 'Users',
          page: '/Users',
          myClass: 'fas fa-user'
        },
        {
          id: 2,
          text: 'Groups',
          page: '/Groups',
          myClass: 'fas fa-users'
        },
        {
          id: 3,
          text: 'Rooms',
          page: '/Rooms',
          myClass: 'fas fa-bars'
        },
        {
          id: 4,
          text: 'Lessons',
          page: '/Lessons',
          myClass: 'fas fa-book-open'
        }
      ]
    }
  },
  methods: {
    deconnexion: function() {
      sessionStorage.removeItem('email')
    }
  }
}
</script>
<style>
nav {
  position: fixed;
  background-color: #255d90;
}

.logo {
  height: 150px;
  width: 150px;
  margin: 0;
}
</style>
