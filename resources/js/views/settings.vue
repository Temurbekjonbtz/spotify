<template>
    <div id="mainViewContainer">

				<div id="mainContent">
<div class="entityInfo">

	<div class="centerSection">
		<div class="userInfo">
			<h1>{{user}}</h1>
		</div>
	</div>

	<div class="buttonItems">
		<router-link style="text-decoration:none;"  to='/usersettings' > <button  class="button"> USER DETAILS </button> </router-link>
		<button class="button" @click="logout">LOGOUT</button>
	</div>


</div></div>


			</div>
</template>
<script>
export default {
	
    computed:{
		user(){
		return	User.getName()
		}
	},
	methods:{
		logout(){
			User.logout()
		}
	}
}
</script>