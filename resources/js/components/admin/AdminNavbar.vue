<template>
	<div id="navBarContainer">
	<nav class="navBar">

		<div  class="logo">
			<img :src="'icons/logo.png'| storage">
		</div>


		

		<div class="group">
			<div class="navItem">
				<router-link  to="/admin" class="navItemLink">Singers</router-link>
			</div>

			<div class="navItem">
				<router-link  to="/albumlist" class="navItemLink">Albums</router-link>
			</div>

            <div class="navItem">
				<router-link to="/songlist" class="navItemLink">Songs</router-link>
			</div>

			 <div class="navItem">
             <a class="navItemLink" @click="logout()"> Logout  </a>
			</div>

			
		</div>

	</nav>
</div>
</template>


<script>
import storage from "../../filters/storage"
export default{

 filters:{
	   storage
   },
   methods:{
	   logout(){
		   User.logout()
	   }
   }

}
</script>