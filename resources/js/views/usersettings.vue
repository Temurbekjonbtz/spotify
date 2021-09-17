<template>
<div id="mainViewContainer">

				<div id="mainContent">
<div class="userDetails">

	<div class="container borderBottom">
		<h2>EMAIL</h2>
		<input v-model="form.email"  type="text" class="email" name="email" placeholder="Email address..." >
		<span class="message"></span>
		<button class="button" @click="updateEmail()"  >SAVE</button>
	</div>

	<div class="container">
		<h2>PASSWORD</h2>
		<input v-model="form.current" type="password" class="oldPassword" name="oldPassword" placeholder="Current password">
		<input v-model="form.newpassword" type="password" class="newPassword1" name="newPassword1" placeholder="New password">
	
		<span class="message"></span>
		<button class="button" @click="updatePassword()">SAVE</button>
	</div>

</div></div>


			</div>
</template>

<script>
export  default{
    data(){
        return {
            form:{
                email:null,
                current:null,
                newpassword:null
                
            }
        }
    },
  mounted(){
this.form.email=User.getEmail()
  },
    methods:{
        updateEmail(){

            this.form.current=null
            this.form.newpassword=null
            if(this.form.email===null || this.form.email===User.getEmail()){
                alert("Your  new  email  is  empty  or  is  similar  to previous  one")
            }
            else{
  User.update(this.form)
            }
         
           
        },

        updatePassword(){
            this.form.email=null
            if(this.form.current==null||  this.form.newpassword===null){
                alert("Something  wrong  with  your data")
            }
            else{
 User.update(this.form)
            }
           
        }
    }
}
</script>