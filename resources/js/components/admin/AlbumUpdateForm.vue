<template>
<div class="createForm">
<form  @submit.prevent="submit()" > 
<span style="color:red;" v-if="errors  &&  errors.title"> {{errors.title[0]}}  </span><br>
<input type="text" placeholder="Title"  v-bind:value="updateAlbum.title" ref="title"/>  <br>
<select  ref="artist">
 
 <option  v-for="singer  in  singers" :key="singer.index"  v-bind:value="singer.id" :selected="singer.id==updateAlbum.artist.id">{{singer.name}}</option>
</select><br>
<span style="color:red;" v-if="errors  &&  errors.artworkPath"> {{errors.artworkPath[0]}}  </span>  <br>
 <input type="file" name="image" ref="image" />
<button > UPDATE </button>

<button style="background:red;"  @click="cancel()"> CANCEL </button>
</form>
</div>

</template>

<script>
import  {mapState }  from 'vuex'
export  default{

    created(){
        this.$store.dispatch('fetchSingers')
    },
    computed:{
     ...mapState({
         singers:state=>state.admin.singerlist,
         errors:state=>state.admin.albumerror,
         updateAlbum:state=>state.admin.updateAlbum
     })
    },
     methods:{
        cancel(){
            this.$store.commit('removeUpdateVisibility')
        },
        submit(){
          
          
            let  formData=new  FormData()
            formData.append('title',this.$refs.title.value)
            formData.append('artworkPath',this.$refs.image.files[0])
            formData.append('artist', this.$refs.artist.value)
            this.$store.dispatch('updateAlbum',{id:this.updateAlbum.id,data:formData})
           
        },
      
       
    }
   
}

</script>
