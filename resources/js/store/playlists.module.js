import { CREATE_PLAYLIST, DELETE_PLAYLIST, DELETE_SONG_FROM_PLAYLIST, FETCH_PLAYLIST, FETCH_PLAYLISTS, FETCH_PLAYLIST_SONGS, INSERT_SONG_TO_PLAYLIST } from "./actions.type"
import ApiService from "../common/api.service";
import { ADD_PLAYLIST, DELETE_SONG, SET_PLAYLIST, SET_PLAYLISTS, SET_SONGS } from "./mutations.type";
import { GET_PLAYLIST, GET_PLAYLISTS } from "./getters.type";
import Exception from "../common/Exception";


const  state={
playlists:[],
playlist:null,
songs:[]
}

const actions={
 async  [CREATE_PLAYLIST](context, playlist){
    var  newPlaylist={
      name:playlist
    }
    try{
      const data=await ApiService.post('api/playlist',newPlaylist)
      context.commit(ADD_PLAYLIST,data.data.data)
    }catch(e){
      Exception.handle(e)
    }
    
  },
async  [FETCH_PLAYLISTS](context){
  try{
    const  data=await   ApiService.get(`api/playlist`)
    context.commit(SET_PLAYLISTS,data.data.data)
  }catch(e){
    Exception.handle(e)
  }
    
  },
async [FETCH_PLAYLIST](context,id){
  try{
    const  data=await ApiService.get(`api/playlist/${id}`)
    context.commit(SET_PLAYLIST,data.data.data)
  }
  catch(e){
    Exception.handle(e)
  }
 
  },
 async  [FETCH_PLAYLIST_SONGS](context, id){
   try{
    const data=await ApiService.get(`/api/playlistsongs/${id}`)
    context.commit(SET_SONGS,data.data.data)
   }
   catch(e){
    Exception.handle(e)
  }
  },
  async [INSERT_SONG_TO_PLAYLIST](context,data){
    try{
      const response=await  ApiService.post("/api/playlistsongs",data)
      if(response.data.response){
        alert(response.data.response)
      }
    }
    catch(e){
      Exception.handle(e)
    }
  
  },

async  [DELETE_SONG_FROM_PLAYLIST](context,data){
   var  x=data
  
   try{
    const  response=await  ApiService.delete("/api/playlistsongs",{data})
    context.commit(DELETE_SONG,x.song)
       if(response.response){
         alert(response.response)
       }
   }
   catch(e){
    Exception.handle(e)
  }
  
},
async   [DELETE_PLAYLIST](context,id){
  try{
    await  ApiService.delete(`/api/playlist/${id}`)
    alert("Playlist  has been  deleted")
  }
  catch(e){
    Exception.handle(e)
  }
  
  }

}

const  mutations={
  [SET_PLAYLISTS](state,data){
    state.playlists=data
  
  },

  [ADD_PLAYLIST](state,data){
    state.playlists.push(data)
  },
  [SET_PLAYLIST](state,data){
state.playlist=data
  },
  [SET_SONGS](state, data){
    state.songs=data
 
      },
  [DELETE_SONG](state,id){
  
     var  i=0
     var  index=-1;
     while(i!==state.songs.length){
       if(state.songs[i].id===id){
            index=i
       }
       ++i
     }
     state.songs.splice(index,1)
   
      },

     
}
const getters={
  [GET_PLAYLIST]:state=>{
    return state.playlist
  },
  [GET_PLAYLISTS]:state=>{
    return state.playlists
  }
}
export  default{
    state,
    actions,
    mutations,
    getters
}