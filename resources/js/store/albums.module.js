import { FETCH_ALBUMS } from "./actions.type";
import { SET_ALBUM, SET_ALBUMS } from "./mutations.type";
import ApiService from "../common/api.service";
import Exception from "../common/Exception";
const state={
albums:[],
album:[]
}

const  actions={
async [FETCH_ALBUMS](context){
  try{
    const  data= await  ApiService.get("api/album")
   
   context.commit(SET_ALBUMS,data.data.data)
  }
   catch(e){
     Exception.handle(e)
   }
}

}
const  getters={

}
const mutations={

    [SET_ALBUMS](state, albums){
       
      state.albums=albums
      
    },
    [SET_ALBUM](state,data){
        state.album=data
     
    },
    addAlbum(state,data){
      state.albums.unshift(data)
    },
    deleteAlbum(state,id){
      var  i=0;
      var  index=0;
      while(i!=state.albums.length){
        if(state.albums[i].id===id){
          index=i;
        }
        ++i
      }
      state.albums.splice(index,1)
    },
    sort(state){
     
     
     var albums= state.albums.filter(function(element){
     
        return  element.songs.length!=0
      });
     state.albums=albums
    }

}
export  default{
    state,
    getters,
    actions,
    mutations
}
