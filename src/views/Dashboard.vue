
<template>
<div>
  	<!-- Sidebar -->
  	<Navigation></Navigation>
  	<div>
	  <h1>Dashboard</h1>

	  <div v-for="group in groups" style="margin-left: 15%;text-align: left;">
	  	<h2>{{group.name}} <span>- {{group.users.length}} users</span></h2>
  			<table v-for="course in group.courses">
  				<tr>
  					<td style="width:150px;">Course name</td>
  					<td style="width:250px; font-weight: bold">{{course.name}}</td>
  				</tr>
  				<tr>
  					<td>Date start</td>
  					<td>{{course.date_start | formatDate}}</td>
  				</tr>
  				<tr>
  					<td>Date end</td>
  					<td>{{course.date_end | formatDate}}</td>
  				</tr>
  				<tr>
  					<td>Present users</td>
  					<td>{{course.participants.length}}</td>
  				</tr>
  				<tr>
  					<td>Missing users</td>
  					<td>{{group.users.length - course.participants.length}}</td>
  				</tr>
  			</table>
	  </div>
	</div>
</div>
</template>
<script>
import axios from 'axios'
import Navigation from '@/components/Navigation'

export default {
  name: 'Dashboard',
  components: {
    'Navigation': Navigation
  },
  data() {
    return {
      groups: {}
    }
  },
  methods: {
    getInfos: function() {
      axios.get('http://vps.quentinmodena.fr:2999/records/infos')
        .then((response) => {
          this.groups = response.data
        })
        .catch((response) => {
          console.error('An error occured. Please try again or contact administrator.')
        });
    }
  },
  mounted() {
    this.getInfos();
  },
}
</script>
<style scoped>
	table{
		margin-top: 15px; 
		text-align:center;
		display: inline-block;
	}
	table tr td{
		text-align:left;
	}
	h2{
		text-align:left;
		font-size: 1.5rem;
	}
	h2 span{
		font-size: 1.1rem;
		padding-left: 0px;
	}
</style>
