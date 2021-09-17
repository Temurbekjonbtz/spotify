<template>
<div id="mainViewContainer">

				<div id="mainContent">
    <div style="width:100%;border-bottom:5px  solid  #3d3d3d; ">
            <EntityInformation :data="'SINGER'"> </EntityInformation>
            <SingerForm v-if="visibility">  </SingerForm>
           <SingerUpdateForm  v-if="updateVisibility"> </SingerUpdateForm>
       </div>

            <div class="tracklistContainer borderBottom">


	<ul class="tracklist">
		
	<ListItem v-for="singer  in  singers"  :key="singer.index"  :data="singer" >  </ListItem>
    
	</ul>
</div>
                </div>

</div>

</template>



<script>
import { mapState, mapGetters } from 'vuex';
import SingerForm from '../../components/admin/SingerForm.vue'

import  EntityInformation from '../../components/admin/EntityInformation.vue'
import  ListItem from '../../components/admin/ListItem.vue'
import  SingerUpdateForm  from '../../components/admin/SingerUpdateForm.vue'
export  default{
    components:{
EntityInformation,
SingerForm,
SingerUpdateForm,
ListItem
    },
    computed:{
            ...mapState({
		  visibility:state=>state.admin.visibility,
          singers:state=>state.admin.singerlist,
           updateVisibility:state=>state.admin.updateVisibility
	  })
      
    },
   
    watch:{
    $route (to, from){
        this.$store.commit('cancel')
    }
} ,
created(){
    this.$store.dispatch('fetchSingers')
},
  
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