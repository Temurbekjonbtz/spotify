<template>
<router-link :to="{ name: 'mymusic', params: { playlistId: playlist.id }}">
<div class="gridViewItem"  >

						<div class="playlistImage">
							<img :src="'icons/playlist.png'| storage">
						</div>
						
						<div class="gridViewInfo">
						{{playlist.name}}
						</div>

</div>
		</router-link>		
</template>
<script>
import storage from "../filters/storage"

export  default{
    props:['playlist'],
     filters:{
	   storage
   },
  
}

</script>