<template>
<div class="createForm">
<form  @submit.prevent="onSubmit"> 
<span style="color:red;" v-if="errors  &&  errors.name"> {{errors.name[0]}}  </span>
<br>
<input type="text" v-model="name" placeholder="Name  of  the singer"/>
<br>
<span style="color:red;" v-if="errors  &&  errors.image"> {{errors.image[0]}}  </span>
<br>
<input type="file" @change="onChange($event)" />

<button > SUBMIT </button>
</form>
</div>

</template>

<script>
import {mapState}  from 'vuex'
export default{
data(){
    return {
       
            name:null,
            image:null
       
    }
},
methods:{
    onSubmit(){
        let  formData=new  FormData()
          formData.append('name',this.name)
        formData.append('image',this.image)
      
      this.$store.dispatch('postSinger',formData)
    },
    onChange(e){
     
        this.image=e.target.files[0]
       
    }
},
computed:{
  ...mapState({
    errors:state=>state.admin.singererror
  })
}
}
</script>