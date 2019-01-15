
<template>
  <!-- Sidebar -->
  <ul class="sidebar navbar-nav" style="position:fixed;">
    <router-link to="Dashboard" ><img style="height:150px; width:150px; margin-left:25px;" src="css/logo.jpg"/></router-link>
    <li class="nav-item">
      <router-link to="Users" class="nav-link">
        <i class="fa fa-user"></i>
        <span>Users</span></router-link>
    </li>
    <li class="nav-item">
      <router-link to="Groups" class="nav-link">
        <i class="fa fa-users"></i>
        <span>Groups</span></router-link>
    </li>
    <li class="nav-item">
      <router-link to="Rooms" class="nav-link">
        <i class="fa fa-bars"></i>
        <span>Rooms</span></router-link>
    </li>
  </ul>
</template>

<script>

$(document).ready(function() {
  if (sessionStorage.getItem('email') == null)
    window.location.href = "/"
});
</script>

<style>

</style>
