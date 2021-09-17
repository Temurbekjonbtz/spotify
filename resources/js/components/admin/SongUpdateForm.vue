<template>
<div class="createForm">
<form @submit.prevent="submit()"> 
<span style="color:red;" v-if="errors  &&  errors.title"> {{errors.title[0]}}  </span><br>
<input type="text" placeholder="Title"  v-bind:value="updateSong.title"  ref="title" />
<select   ref="album"   >
<option  v-for="album  in albums" :key="album.index" v-bind:value="album.id" :selected="album.id==updateSong.albums_id">{{album.title}}  </option>
</select><br>
<span style="color:red;" v-if="errors  &&  errors.audio"> {{errors.audio[0]}}  </span>  <br>
<input  ref="audio" type="file" name="image" />

<button > UPDATE </button>
<button style="background:red;"  @click="cancel()"> CANCEL </button>

</form>
</div>

</template>

<script>
import {mapState} from 'vuex'
export  default{
 
     computed:{
     ...mapState({
         albums:state=>state.albums.albums,
        errors:state=>state.admin.songerror,
        updateSong:state=>state.admin.updateSong
     })
    },
      created(){
        this.$store.dispatch('fetchAlbums')
    },
    methods:{
        cancel(){
            this.$store.commit('removeUpdateVisibility')
        },
        submit(){
    
          let  formData=new  FormData()
          formData.append('title', this.$refs.title.value)
          formData.append('albums_id',this.$refs.album.value)
          formData.append('path',this.$refs.audio.files[0])
          this.$store.dispatch('updateSong',{id:this.updateSong.id,data:formData})
        },
    
    },
 
  
}

</script>
