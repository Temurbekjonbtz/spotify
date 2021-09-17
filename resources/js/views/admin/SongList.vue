<template>
<div id="mainViewContainer">

				<div id="mainContent">
    <div style="width:100%;border-bottom:5px  solid  #3d3d3d; ">
            <EntityInformation :data="'SONG'"> </EntityInformation>
            <SongForm v-if="visibility" >  </SongForm>
             <SongUpdateForm  v-if="updateVisibility">  </SongUpdateForm>
       </div>

            <div class="tracklistContainer borderBottom">


	<ul class="tracklist">
		
			
	<SongListItem  v-for="(song, index) in songs" :key="song.index" :song="song"  :index="++index"></SongListItem>
				
		
               
              
              
               
               
               
		

	</ul>
</div>
                </div>

</div>

</template>



<script>
import { mapState, mapGetters } from 'vuex';
import SongForm from '../../components/admin/SongForm.vue'

import  EntityInformation from '../../components/admin/EntityInformation.vue'
import  SongListItem from '../../components/admin/SongListItem.vue'
import  SongUpdateForm from '../../components/admin/SongUpdateForm.vue'
export  default{
    components:{
EntityInformation,
SongForm,
SongUpdateForm,
SongListItem
    },
    computed:{

      ...mapState({
		  visibility:state=>state.admin.visibility,
          songs:state=>state.admin.songlist,
          updateVisibility:state=>state.admin.updateVisibility
	  })
      
    },
   
   

created(){
    this.$store.dispatch('fetchAllSongs')
  
}
   
}
</script>
<style>
.createForm{
    width:80%;
    margin:auto;
    border:5px  solid  #3d3d3d;
   text-align:center;
   padding:20px 0px;
   box-sizing:border-box;
   margin:auto;
   margin-top:40px;
   margin-bottom:40px;
}
.createForm input, .createForm  button, .createForm  select{
    height: 50px;
    width: 90%;
    background:#3d3d3d;
    border: none;
    font-size: 18px;
    font-weight: 300;
    color:white;
    padding: 0 25px;
	margin:20px 0px;
    display:inline-block;
    box-sizing:border-box;
    z-index:1;
}
.createForm  button{
    background:green;
}

</style>