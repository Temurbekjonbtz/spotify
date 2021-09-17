<template>
<div class="createForm">
<form @submit.prevent="submit()"> 
<span style="color:red;" v-if="errors  &&  errors.name"> {{errors.name[0]}}  </span>
<br>
<input   type="text"  placeholder="Name  of  the singer"  ref="title" v-bind:value="updateSinger.name"/>
<br>
<span style="color:red;" v-if="errors  &&  errors.image"> {{errors.image[0]}}  </span>
<br>
<input type="file"  ref="image" />

<button > UPDATE </button>
<button style="background:red;"  @click="cancel()"> CANCEL </button>
</form>
</div>

</template>

<script>
import {mapState}  from 'vuex'
export default{

computed:{
  ...mapState({
    errors:state=>state.admin.singererror,
    updateSinger:state=>state.admin.updateSinger
  })
},
 methods:{
        cancel(){
            this.$store.commit('removeUpdateVisibility')
        },
        submit(){
        if(this.updateSinger.name!=""  &&  this.updateSinger.image!=null){

     var form=new  FormData()
     form.append('name',this.$refs.title.value)
     form.append('image',this.$refs.image.files[0])
         this.$store.dispatch('updateSinger',{id:this.updateSinger.id, data:form})
        }
        else{
          alert("Wrong  data")
        }
        

        },
        
    }
}
</script>