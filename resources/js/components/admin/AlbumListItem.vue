<template>

	<li class="tracklistRow" style="height:60px;">
					<div class="trackCount"  >
						<img  style="visibility:visible;width:60px;margin:0px;height:50px;"  :src="`/storage/${data.artworkPath}`" >
						<span  style="visiblity:hidden;" class="trackNumber">1</span>
					</div>


					<div class="trackInfo">
					<router-link  :to="{ name: 'adminalbum', params: { albumId: data.id }}">
						<span class="trackName"> {{data.title}} </span>
						 </router-link>     
						<span class="artistName"  v-if="data.artist">{{data.artist.name}}</span>
					</div>

					<div class="trackOptions" >
						<button @click="update()">UPDATE</button>
                        <button  @click="del()" >DELETE</button>
					</div>

				


		</li>
         
</template>

<script>
import storage  from  '../../filters/storage'
export  default{
props:['data'],
	filters:{
		storage
	},
	methods:{
		del(){
			
			this.$store.dispatch('deleteAlbum',this.data.id)
		},
		update(){
			this.$store.commit('setUpdateVisibility')
		 this.$store.commit('setUpdateAlbum',this.data)
			var  element=$(".trackCount").first().offset()
			window.scrollTo(0,element.top-600)
		
	}
	}
}

</script >
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