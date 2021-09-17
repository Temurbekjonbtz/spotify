<template>
    <div id="mainViewContainer">

				<div id="mainContent">
<h1 class="pageHeadingBig">You Might Also Like</h1>

<div class="gridViewContainer">

<albumcard v-for="album  in albums" :key="album.index"  :album="album" >    </albumcard>


			</div>

		</div>
			</div>
</template>
<script>
import { FETCH_ALBUMS } from '../store/actions.type';
import storage from "../filters/storage"
import albumcard from '../components/albumcard.vue';
import { mapState } from 'vuex';
import AppStorage from "../common/AppStorage";

export default {
  components: { albumcard },
 

  async created(){
	 await  this.$store.dispatch(FETCH_ALBUMS)
        this.$store.commit('sort')

  },
  filters:{
	  storage
  },

  computed:{
	  ...mapState({
		  albums : state=>state.albums.albums
	  })
  }
}
</script>
