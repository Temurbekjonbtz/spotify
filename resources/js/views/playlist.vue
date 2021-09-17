<template>
    <div id="mainViewContainer">

				<div id="mainContent">
<div class="playlistsContainer">

	<div class="gridViewContainer">
		<h2>PLAYLISTS</h2>

		<div class="buttonItems">
			<button class="button green" @click="create">NEW PLAYLIST</button>
		</div>



		<span class="noResults"  v-if="!playlists">You don't have any playlists yet.</span>



<playlistcard  v-for="pl  in  playlists" :key="pl.index"  :playlist="pl">{{pl.name}}</playlistcard>

	</div>

</div></div>


			</div>
</template>
<script>
import  {CREATE_PLAYLIST, FETCH_PLAYLISTS} from "../store/actions.type"
import { mapState } from 'vuex';
import playlistcard  from "../components/playlistcard"
export default {
	components:{
		playlistcard
	},
  methods:{
	  create(){
		 var popup = prompt("Please enter the name of your playlist");
		 this.$store.dispatch(CREATE_PLAYLIST,popup)
	  }
  },

  created(){
    
	  this.$store.dispatch(FETCH_PLAYLISTS)
	
  },
  computed:{
	  ...mapState({
		  playlists : state=>state.playlists.playlists
	  })
  },
 

}
</script>
