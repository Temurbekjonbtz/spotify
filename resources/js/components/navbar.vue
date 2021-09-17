<template>
    	<div id="navBarContainer">
	<nav class="navBar">

		<div class="logo">
			<img :src="'icons/logo.png'| storage">
				
			
		</div>


		

		<div class="group">
			<div class="navItem">
				<router-link  to="/" class="navItemLink">Browse</router-link>
			</div>

			<div class="navItem">
				<router-link  to="/playlist" class="navItemLink">Your Music</router-link>
			</div>

			<div class="navItem">
				<router-link to="/settings" class="navItemLink" >{{user}}</router-link>
			</div>

			
		</div>

	</nav>
</div>
</template>
<script>
import storage from "../filters/storage"

export default {
  
   filters:{
	   storage
   },
   computed:{
	   user(){
		   return User.getName()
	   },
	  
   },
  
}
</script>

<style scoped>

</style>
