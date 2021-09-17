<template>
    <div id="nowPlayingBarContainer">

	<div id="nowPlayingBar">

		<div id="nowPlayingLeft">
		
		</div>

		<div id="nowPlayingCenter">

			<div class="content playerControls">
              <audio autoplay v-if="song"controls :src="song.path|storage" style="width:100%;" id="player">
				


			

</audio>
			</div>


		</div>

		<div id="nowPlayingRight">
		
		</div>




	</div>

</div>
</template>

<script>
import storage from "../filters/storage"
import { mapState, mapGetters } from 'vuex';
export default {
   data(){
       return{
           
       }
   },
   filters:{
	   storage
   },
   computed:{
	   	...mapState({
		 
		  song : state=>state.songs.song,
		 
	    
		
	  })
   }

}
</script>
<style scoped>

</style>
