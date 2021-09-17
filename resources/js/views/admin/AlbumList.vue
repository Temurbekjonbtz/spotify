
<template>
<div id="mainViewContainer">

				<div id="mainContent">
    <div style="width:100%;border-bottom:5px  solid  #3d3d3d; ">
            <EntityInformation :data="'ALBUM'"> </EntityInformation>
            <AlbumForm  v-if="visibility" >  </AlbumForm>
             <AlbumUpdateForm  v-if="updateVisibility">  </AlbumUpdateForm>
        </div>

            <div class="tracklistContainer borderBottom">


	<ul class="tracklist">
		
	<AlbumListItem  v-for="album  in  albums"  :key="album.index"  :data="album">  </AlbumListItem>
               
              
              
               
               
               
		

	</ul>
</div>
                </div>

</div>

</template>



<script>
import { mapState, mapGetters } from 'vuex';
import AlbumForm from '../../components/admin/AlbumForm.vue'

import  EntityInformation from '../../components/admin/EntityInformation.vue'
import  AlbumListItem from '../../components/admin/AlbumListItem.vue'
import  AlbumUpdateForm from '../../components/admin/AlbumUpdateForm.vue'
export  default{
    components:{
EntityInformation,
AlbumForm,
AlbumUpdateForm,
AlbumListItem
    },
    computed:{
...mapState({
	visibility:state=>state.admin.visibility,
    albums:state=>state.albums.albums,
      updateVisibility:state=>state.admin.updateVisibility
})
      
      
    },
   created(){
       this.$store.dispatch('fetchAlbums')
   },
    watch:{
    $route (to, from){
        this.$store.commit('cancel')
    }
} ,

   
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