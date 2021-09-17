import  ApiService  from '../../common/api.service'
const state={
visibility:null,
updateVisibility:null,
create:true,
cancel:false,
singererror:null,
albumerror:null,
songerror:null,
singerlist:[],
songlist:[],
updateSong:null,
updateAlbum:null,
updateSinger:null
}
const  actions={
  async postSinger(context,data){
    try{
      const response=await ApiService.post('/api/artist',data)
      context.commit('addSinger',response.data)
      context.commit('setSingerErrors',null)
      context.commit('cancel')
  
    }
    catch(e){
      context.commit('setSingerErrors',e.response.data.errors)
    }
 
  },
  async  postAlbum(context,data){
    try{
       const  response=await ApiService.post('/api/album',data)
    context.commit('addAlbum',response.data)
       context.commit('setAlbumErrors',null)
       context.commit('cancel')
       
    }
    catch(e){
      context.commit('setAlbumErrors',e.response.data.errors)
     
    }
  },
  async postSong(context,data){
    try{
      const  response= await ApiService.post('/api/song',data)
  context.commit('addSong',response.data)
      context.commit('setSongError',null)
      context.commit('cancel')
      
    }
    catch(e){
      context.commit('setSongError',e.response.data.errors)
      
    }
  },
  async  fetchSingers(context){
try{
const  response= await ApiService.get('/api/artist')
context.commit('setSingerList',response.data.data)
}
catch(e){
console.log(e)
}
  },
  async fetchAllSongs(context){
try{
const  response =await ApiService.get('/api/songall')
context.commit('setSongList',response.data.data)
}
catch(e){
  console.log(e)
}
  },

 async  deleteSinger(context,id){
    try{
      const response = await ApiService.delete(`/api/artist/${id}`);
     context.commit('deleteSinger',id)
    }
    catch(e){
      console.log(e.response.data)
    }
  },
  async deleteAlbum(context,id){
    try{
      const response=await ApiService.delete(`/api/album/${id}`)
      context.commit('deleteAlbum',id)
    }
    catch(e){
      console.log(e)
    }
  },
  async deleteSong(context,id){
    try{
      const response=await ApiService.delete(`/api/song/${id}`)
      context.commit('deleteSong',id)
    }
    catch(e){
      console.log(e)
    }
  },
 async  updateSinger(context,payload){
    try{
      const  response= await ApiService.post(`/api/updateartist/${payload.id}`,payload.data)
      context.commit('setSingerErrors',null)
      context.commit('removeUpdateVisibility')
      context.commit('deleteSinger',payload.id)
      context.commit('addSinger',response.data)
    }
    catch(e){
    
      context.commit('setSingerErrors',e.response.data.errors)
    }
  },
  async updateAlbum(context,payload){
    try{
    const response=await ApiService.post(`/api/updatealbum/${payload.id}`,payload.data)
   
    context.commit('setAlbumErrors',null)
    context.commit('removeUpdateVisibility')
    context.commit('deleteAlbum',payload.id)
    context.commit('addAlbum',response.data)
    }
    catch(e){
     context.commit('setAlbumErrors',e.response.data.errors)
    }
  },
  async updateSong(context,payload){
    try{
      
      const response=await ApiService.post(`/api/updatesong/${payload.id}`,payload.data)
      console.log(response.data)
      context.commit('setSongError',null)
      context.commit('deleteSong',payload.id)
      context.commit('addSong',response.data)
      context.commit('removeUpdateVisibility')
  
    }
    catch(e){
  context.commit('setSongError',e.response.data.errors)
    }
  }

}
const mutations={
   
    setVisibility(state){
      if(state.updateVisibility){
        state.updateVisibility=false
      }
   state.visibility=true
  state.create=false
  state.cancel=true
 
    },
    cancel(state){
      this.commit('removeUpdateVisibility')
state.visibility=null
state.cancel=false
state.create=true
this.commit('clearErrors')

    },
    clearErrors(state){
      state.singererror=null
      state.albumerror=null
    state.songerror=null

    },
    setSingerErrors(state,data){
   state.singererror=data
  
    },
    setAlbumErrors(state,data){
      state.albumerror=data
    },
    setSongError(state,data){
      state.songerror=data
    },
    setSingerList(state,data){
state.singerlist=data

    },
    setSongList(state,data){
      state.songlist=data
    },
    addSinger(state,data){
      state.singerlist.unshift(data)
      
    },
    addSong(state,data){
  state.songlist.unshift(data)
  
    },
    deleteSinger(state,id){
      var  i=0;
      var  index=0;
      while(i!=state.singerlist.length){
        if(state.singerlist[i].id===id){
          index=i
        }
        ++i
      }
      state.singerlist.splice(index,1)
    },
    deleteSong(state,id){
      var  i=0
      var index=0
      while(i!=state.songlist.length){
        if(state.songlist[i].id===id){
          index=i
        }
        ++i
      }
      state.songlist.splice(index,1)
    },
    setUpdateVisibility(state){
     this.commit('cancel')
      state.updateVisibility=true
    },
    removeUpdateVisibility(state){
      state.updateVisibility=false
      this.commit('clearErrors')
      state.updateSong=null
      state.updateAlbum=null
    state.updateSinger=null
    },
    setUpdateSong(state,data){
      state.updateSong=data
      console.log(state.updateSong)
     
    },
    setUpdateAlbum(state,data){
      state.updateAlbum=data
      console.log(state.updateAlbum)
    },
    setUpdateSinger(state,data){
      state.updateSinger=data
    },
    

}
export  default{
    state,
    actions,
    mutations
}