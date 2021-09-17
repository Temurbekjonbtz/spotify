<template>
  <div id="mainContainer">

		<div id="topContainer">
              <AdminNavbar> </AdminNavbar>
		
			<router-view  > </router-view>
		</div>
<Player></Player>


</div>
</template>


<script>
import Player from "../components/player.vue";
import AdminNavbar from "../components/admin/AdminNavbar.vue";
export default{
    components:{
Player,AdminNavbar
    },

     watch:{
    $route (to, from){
        this.$store.commit('cancel')
       this.$store.commit('removeUpdateVisibility')
    }
     }
}
</script>
