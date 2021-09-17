<template>
<div class="createForm">
<form  @submit.prevent="add"> 
<span style="color:red;" v-if="errors  &&  errors.title"> {{errors.title[0]}}  </span><br>
<input type="text" placeholder="Title"  v-model="title"/>  <br>
<select   v-model="selected">
 
 <option  v-for="singer  in  singers" :key="singer.index"  v-bind:value="singer.id">{{singer.name}}</option>
</select><br>
<span style="color:red;" v-if="errors  &&  errors.artworkPath"> {{errors.artworkPath[0]}}  </span>  <br>
 <input type="file" name="image"  @change="handle($event)"/>
<button > SUBMIT </button>
</form>
</div>

</template>

<script>
import  {mapState }  from 'vuex'
export  default{
data(){
    return {
        title:null,
        selected:null,
        image:null
    }
},
    created(){
        this.$store.dispatch('fetchSingers')
    },
    computed:{
     ...mapState({
         singers:state=>state.admin.singerlist,
         errors:state=>state.admin.albumerror
     })
    },
    methods:{
        add(){
           let   formData=new  FormData
           formData.append('title', this.title)
           formData.append('artist',this.selected)
           formData.append('artworkPath',this.image)
           this.$store.dispatch('postAlbum',formData)
        },
        handle(e){
            this.image=e.target.files[0]
        }
    }
}

</script>

