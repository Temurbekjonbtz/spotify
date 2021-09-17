<template>
   <li class="tracklistRow">
					<div class="trackCount">
						<img class="play" :src="'icons/play-white.png'| storage" @click="play()">
						<span class="trackNumber">{{index}}</span>
					</div>


					<div class="trackInfo">
						<span class="trackName">{{song.title}}</span>
					
					</div>

						<div class="trackOptions" >
						<button @click="update()" >   UPDATE</button>
                        <button  @click="del()" >DELETE</button>
					</div>

					<div class="trackDuration">
						<span class="duration">{{song.duration}}</span>
					</div>


				</li>
</template>

<script>

import {SET_NAV,SET_SONG}  from  "../../store/mutations.type"
import {GET_NAV}  from "../../store/getters.type"
import storage from  "../../filters/storage"

export default {
	
    props:['song','index'],

	 filters:{
      storage
  },



  methods:{
	
	play(){
		this.$store.commit(SET_SONG,this.song)
	},
	del(){
		this.$store.dispatch('deleteSong',this.song.id)
	},
	update(){
			this.$store.commit('setUpdateVisibility')
			this.$store.commit('setUpdateSong',this.song)
			var  element=$(".trackCount").first().offset()
			window.scrollTo(0,element.top-600)
		
	}
	
  },

}
 

</script>
<style scoped>
  button{
     width:100%;
     margin:5px;
     padding:7px;
     outline:none;
     border:none;
     background:green;
  }

</style>