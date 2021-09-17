<template>
   <div id="background">

		<div id="loginContainer">

			<div id="inputContainer">
				



				<form id="registerForm" @submit.prevent="onSubmit">
					<h2>Create your free account</h2>
					
					<p>
						
						<label for="username">Username</label>
						<input  v-model="form.name" id="username" name="username" type="text" placeholder="e.g. bartSimpson"  required>
				       <ul  class="error-messages">
            <li> </li>
                 </ul>
					</p>

				

					<p>
					
						<label for="email">Email</label>
						<input v-model="form.email" id="email" name="email" type="email" placeholder="e.g. bart@gmail.com"  required>
					 <ul  class="error-messages">
                          <li > </li>
                     </ul>
					</p>

				

					<p>
					
						<label for="password">Password</label>
						<input v-model="form.password" id="password" name="password" type="password" placeholder="Your password" required>
					</p>

				

					<button type="submit" name="registerButton">SIGN UP</button>

					<div class="hasAccountText">
						<router-link  to='login' id="hideRegister">Already have an account? Log in here.</router-link>
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

import { mapState } from "vuex";
import AppStorage from "../common/AppStorage"
export default {
   data() {
    return {
   form:{ 
	   name: "",
      email: "",
      password: ""
    }
	};
  },

   methods:{
	   onSubmit(){
	   User.signup(this.form)
	
	   }
   }
}
</script>
<style scoped  src="../../css/auth.css">

</style>
