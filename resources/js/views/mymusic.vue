<template>
 <div id="mainViewContainer">
<div id="mainContent">
<div class="entityInfo">

	<div class="leftSection">
		<div class="playlistImage">
			<img :src="'icons/playlist.png'|storage">
		</div>
	</div>

	<div class="rightSection">
		<h2  v-if="playlist">{{playlist.name}}</h2>
		<p>By reece-kenney</p>
		<p>1 songs</p>
		<button class="button" @click="deletePlaylist" >DELETE PLAYLIST</button>

	</div>
    </div>
   <div class="tracklistContainer">
	<ul class="tracklist">
		
		
	
	<songcard  v-for="(song, index) in songs" :key="song.index" :song="song"  :index="++index"></songcard>
				
		
				
		

	</ul>
</div>


</div>
</div>
</div>
</template>


<script>
import {FETCH_PLAYLIST_SONGS,FETCH_PLAYLIST,DELETE_PLAYLIST} from "../store/actions.type"
import {SET_NAV} from "../store/mutations.type"
import { mapState, mapGetters } from 'vuex';
import songcard  from  '../components/songcard'
import storage  from '../filters/storage'
export  default{
 components:{
songcard
   },
    created(){
        this.$store.dispatch(FETCH_PLAYLIST, this.$route.params.playlistId)
        this.$store.dispatch(FETCH_PLAYLIST_SONGS, this.$route.params.playlistId)
			this.$store.commit(SET_NAV,false)
    },

	computed:{
	...mapState({
		 
		  songs : state=>state.playlists.songs,
		   playlist:state=>state.playlists.playlist
	    
		
	  })	
		
	},
	filters:{
		storage
	},
	methods:{
		deletePlaylist(){
			this.$store.dispatch(DELETE_PLAYLIST,this.playlist.id)
			.then(()=>{
				this.$router.push('/playlist')
			})
		}
	}
	
}
</script>