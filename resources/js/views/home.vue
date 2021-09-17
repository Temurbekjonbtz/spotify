<template>
    <div id="mainContainer">

		<div id="topContainer">
              <Navbar> </Navbar>
		
			<router-view  default="{name:'browse'}"> </router-view>
		</div>
<Player></Player>


</div>
</template>
<script>
import Player from "../components/player.vue";
import Navbar from "../components/navbar.vue"
export default {
components:{Player,Navbar}
}
</script>

<style src="../../css/app.css">

</style>
