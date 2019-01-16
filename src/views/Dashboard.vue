
<template>
<div>
  <!-- Sidebar -->
  <Navigation></Navigation>
  <h1>Dashboard</h1>
</div>
</template>
<script>
import Navigation from '@/components/Navigation'
export default {
  name: 'Dashboard',
  components: {
    'Navigation': Navigation
  }
}
</script>
