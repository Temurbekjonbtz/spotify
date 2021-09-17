<template  >
  <div id="mainViewContainer">

				<div id="mainContent">
<div class="entityInfo">

	<div class="leftSection">
		<img :src="album.artworkPath| storage">
	</div>

	<div class="rightSection">
		<h2>{{album.title}}</h2>
	<router-link  :to="{name:'singer',  params:{singerId:artist.id}}" v-if="artist" style="text-decoration:none;">	<p  v-if="artist">By {{artist.name}}</p>   </router-link>
		<p>{{album.songcount}} songs</p>

	</div>

</div>


<div class="tracklistContainer">
	<ul class="tracklist">
		
	<songcard  v-for="(song, index) in songs" :key="song.index" :song="song"  :index="++index"></songcard>
				
				
             
		

	</ul>
</div>


                </div>
  </div>
</template>
 

<script >
import { mapState, mapGetters } from 'vuex';
import songcard  from  '../components/songcard'
import  {FETCH_SONGS}  from '../store/actions.type'
import {GET_SONGS}  from '../store/getters.type'
import {SET_ALBUM}  from '../store/mutations.type'
import storage  from '../filters/storage'
import {SET_NAV} from "../store/mutations.type"
export default {
   components:{
songcard
   },
  
	computed:{
	...mapState({
		  album:state=>state.albums.album,
		  songs : state=>state.albums.album.songs,
		   artist:state=>state.albums.album.artist,
	    
		
	  })	
		
	},
	filters:{
		storage
	},

	created(){
		 this.$store.dispatch(FETCH_SONGS,this.$route.params.albumId)
this.$store.commit(SET_NAV,false)
	}


}
</script>
