<template>
<router-link  :to="{ name: 'album', params: { albumId: album.id }}">
      <div class="gridViewItem">
					<span role="link"  >
						<img :src="album.artworkPath | storage">

						<div class="gridViewInfo">{{album.title}}</div>
					</span>
</div>

</router-link>
</template>

<script>
import storage from  "../filters/storage"


export default{
 props:['album'],

  filters:{
      storage
  }

}


</script>
