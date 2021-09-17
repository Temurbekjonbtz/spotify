<template>
<div id="mainViewContainer">
	<div id="mainContent">
         <div class="entityInfo borderBottom">

	<div class="centerSection">

		<div class="artistInfo">

			<h1 class="artistName" >{{singer.name}}</h1>

			

		</div>


	</div>

</div>

<div class="gridViewContainer">
	<h2>ALBUMS</h2>
	
  
<albumcard v-for="album  in singer.albums" :key="album.index"  :album="album" >    </albumcard>




</div>
     </div>
</div>
</template>

<script>
import albumcard  from '../components/albumcard'
import  {mapState}  from 'vuex'
export  default{
	components:{
		albumcard
	},
   created(){
	   this.$store.dispatch('fetchSinger',this.$route.params.singerId)
   },
   computed:{
	 ...mapState({
		 singer:state=>state.singer.singer
	 })
   },
 
}

</script>