<template>
   <div id="background">

		<div id="loginContainer">

			<div id="inputContainer">
				<form id="loginForm" @submit.prevent="onSubmit">
					<h2>Login to your account</h2>
					<ul >
                         <li >  </li>
						   <li>   </li>
					</ul>
					<p>
					
						<label for="loginUsername">Username</label>
						<input v-model="form.email" id="loginUsername" name="loginUsername" type="text" placeholder="e.g. bartSimpson"  required autocomplete="off" >
					</p>
					<p>
						<label for="loginPassword">Password</label>
						<input  v-model="form.password" id="loginPassword" name="loginPassword" type="password" placeholder="Your password" required>
					</p>

					<button type="submit" name="loginButton">LOG IN</button>

					<div class="hasAccountText">
						<router-link  to='/registration' id="hideLogin">Don't have an account yet? Signup here.</router-link>
					</div>
					
				</form>



				


			</div>

			<div id="loginText">
				<h1>Get great music, right now</h1>
				<h2>Listen to loads of songs for free</h2>
				<ul>
					<li>Discover music you'll fall in love with</li>
					<li>Create your own playlists</li>
					<li>Follow artists to keep up to date</li>
				</ul>
			</div>

		</div>
	</div>
</template>
<script>
import { mapState } from 'vuex';

				
				
export default {
 data(){
	 return{
		  form :{
                email:null,
                password:null
            }
	 }
 },
 methods:{
	 onSubmit(){
		
		 
            User.login(this.form)
      
	 }
	
 },
  
	

  
 

}
</script>

<style scoped  src="../../css/auth.css">

</style>
