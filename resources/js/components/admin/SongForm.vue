<template>
<div class="createForm">
<form  @submit.prevent="add"> 
<span style="color:red;" v-if="errors  &&  errors.title"> {{errors.title[0]}}  </span><br>
<input type="text" placeholder="Title"  v-model="title"/>
<select v-model="selected">
<option  v-for="album  in albums" :key="album.index" v-bind:value="album.id">{{album.title}}  </option>
</select><br>
<span style="color:red;" v-if="errors  &&  errors.audio"> {{errors.audio[0]}}  </span>  <br>
<input type="file" name="image" @change="assign($event)"/>

<button > SUBMIT </button>
</form>
</div>

</template>

<script>
import {mapState} from 'vuex'
export  default{
    data(){
        return {
            title:null,
            selected:null,
            audio:null,
           
        }
    },
     created(){
        this.$store.dispatch('fetchAlbums')
    },
     computed:{
     ...mapState({
         albums:state=>state.albums.albums,
        errors:state=>state.admin.songerror
     })
    },
    methods:{
        assign(e){
            this.audio=e.target.files[0]
        
        },
        add(){
          
           let  formData=new  FormData()
           formData.append('title',this.title)
           formData.append('album',this.selected)
           formData.append('audio',this.audio)
           this.$store.dispatch('postSong',formData)
        }
    }
}

</script>
