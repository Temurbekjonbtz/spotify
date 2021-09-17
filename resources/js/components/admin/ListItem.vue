<template>
	<li class="tracklistRow" style="height:60px;">
					<div class="trackCount"  >
						<img  style="visibility:visible;width:60px;margin:0px;height:50px;" v-if="data.image" :src="`/storage/${data.image}`" >
						<span  style="visibility:hidden;" class="trackNumber">1</span>
					</div>


					<div class="trackInfo">
						<span class="trackName">{{data.name}}</span>
						<span class="artistName"></span>
					</div>

					<div class="trackOptions" >
						<button  @click="update()">UPDATE</button>
                        <button   @click="del()">DELETE</button>
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
			this.$store.dispatch('deleteSinger',this.data.id)
		},
		update(){
			this.$store.commit('setUpdateVisibility')
			this.$store.commit('setUpdateSinger',this.data)
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