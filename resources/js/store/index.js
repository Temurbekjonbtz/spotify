import Vue from "vue";
import Vuex from "vuex";



import albums  from   "./albums.module";
import  songs from "./songs.module"
import playlists  from "./playlists.module"
import admin from "./admin/admin"
import singer  from  './singer'

Vue.use(Vuex);

export default new Vuex.Store({
  modules: {
   
  
    albums,
    songs, 
     playlists,
     admin,
     singer,
  
   
  }
});
