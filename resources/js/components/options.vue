<template v-if="Nav">
	 <nav class="optionsMenu"  v-if="Nav" >

	<select class="item playlist"  @change="add" v-model="selected" >
							<option value  disabled >Add to playlist</option>
                             <option  v-for="pl  in  playlists" :key="pl.index"  v-bind:value="pl.id">  {{pl.name}}   </option>
							
		</select>
</nav>
</template>

<script>

import { mapState } from 'vuex';
import  { FETCH_PLAYLISTS, INSERT_SONG_TO_PLAYLIST} from '../store/actions.type'
export default{
	
   props:['Nav','songid'],
  
   computed:{
	     ...mapState({
		  playlists : state=>state.playlists.playlists,
		 
	  }),
	 
   },
 data(){
	 return {
		selected:'',
		data:{
         song:null,
		 playlist:null
		}
	 }
 },
 created(){
this.$store.dispatch(FETCH_PLAYLISTS)
 },
 methods:{
	 add(){
		 this.data.playlist=this.selected
		 this.data.song=this.songid
     this.$store.dispatch(INSERT_SONG_TO_PLAYLIST,this.data)
	 }
 }
 
 
}
</script>

