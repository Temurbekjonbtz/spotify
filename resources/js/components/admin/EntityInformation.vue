<template>
<div class="entityInfo borderBottom">

	<div class="centerSection">

		<div class="artistInfo">

			<h1 class="artistName">{{data+'S'}}</h1>

			<div class="headerButtons" style="display:flex;justify-content: space-between;">
		  
			
			 
	    	<div style="width:33%; "  v-if="create">
		     	<button class="redgreen" @click="setVisibility()" style="background:green;">{{ "CREATE NEW  "+data }} </button>
			</div>
		
		    <div style="width:33%; "  v-if="cancel">
		     	<button class="redgreen" @click="cancell()" style="background:red;">CANCEL </button>
			</div>
			</div>

		</div>

	</div>

</div>
</template>

<script>
import  {mapState}  from 'vuex'
export  default{
   props:['data'],
	
	methods:{
    setVisibility(){
		
			this.$store.commit('setVisibility')
	      
	},
	cancell(){
	this.$store.commit('cancel')
	
	}
	},
	computed:{
		...mapState({
			
			create:state=>state.admin.create,
			cancel:state=>state.admin.cancel
		})
	}
}
</script>
<style scoped>

.oldPassword,.redgreen{
	height: 50px;
    width: 100%;
    background:#3d3d3d;
    border: none;
    font-size: 18px;
    font-weight: 300;
    padding: 0 15px;
	margin:20px  0px;

}

</style>