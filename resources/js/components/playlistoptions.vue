<template>
<nav class="optionsMenu" v-if="Nav">

   <button  class="item playlist" @click="func" >Remove  from  playlist</button>
    
		
    
</nav>
</template>

<script>


import  {DELETE_SONG_FROM_PLAYLIST} from '../store/actions.type'
import { mapState, mapGetters } from 'vuex';
export  default{
    props:['Nav', 'songid'],

    data(){
        return {
            selected:'',
            visible:true,
            data:{
                playlist:null,
                song:null
            }
        }
    },
    methods:{
        func(){
               this.data.playlist=this.playlist
               this.data.song=this.songid
         
               this.$store.dispatch(DELETE_SONG_FROM_PLAYLIST,this.data)
          
           }
        
       
    },

    computed:{
       	...mapState({
		 
		 
		   playlist:state=>state.playlists.playlist.id
	    
		
	  })
    }
}

</script>