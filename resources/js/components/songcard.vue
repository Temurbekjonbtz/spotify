<template>
   <li class="tracklistRow">
					<div class="trackCount">
						<img class="play" :src="'icons/play-white.png'| storage" @click="play()">
						<span class="trackNumber">{{index}}</span>
					</div>


					<div class="trackInfo">
						<span class="trackName">{{song.title}}</span>
					
					</div>

					<div class="trackOptions">
				

<options  :Nav="Nav"  :songid="song.id" >  </options>
<playlistoptions  v-if="this.$route.name==='mymusic'" :Nav="Nav"  :songid="song.id" >  </playlistoptions>
						<img class="optionsButton" :src="'icons/more.png'| storage"   @click="showOptionsMenu()">
					   
					</div>

					<div class="trackDuration">
						<span class="duration">{{song.duration}}</span>
					</div>


				</li>
</template>

<script>

import {SET_NAV,SET_SONG}  from  "../store/mutations.type"
import {GET_NAV}  from "../store/getters.type"
import storage from  "../filters/storage"
import options  from "../components/options"
import playlistoptions  from  "../components/playlistoptions"
export default {
	components:{
		options, playlistoptions
	},
    props:['song','index'],

	 filters:{
      storage
  },



  methods:{
	showOptionsMenu(){
		
		this.$store.commit(SET_NAV,this.song.id)
		
    
	
	},
	play(){
		this.$store.commit(SET_SONG,this.song)
	}
	
  },
computed:{
Nav:function(){
	if(this.$store.getters.getNav===this.song.id ){

	
	return  this.$store.getters.getNav
	}
	
},

}
}
 

</script>
