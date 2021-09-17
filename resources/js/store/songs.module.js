import { FETCH_SONGS } from "./actions.type"
import { DELETE_SONG, SET_ALBUM, SET_NAV, SET_SONG, SET_SONGS } from "./mutations.type"
import ApiService from "../common/api.service";
import axios  from  'axios'
import { GET_NAV, GET_SONGS } from "./getters.type";
const state={
 song:null,
 nav:false
}
const  getters={
  [GET_NAV]: (state) => {
  
    return state.nav
  },
 
}
const actions={
  
async [FETCH_SONGS](context,id){
  try{
    const data= await ApiService.get(`api/album/${id}`)
    context.commit(SET_ALBUM,data.data.data)
  }catch(e){
    Exception.handle(e)
  }
  
}
}
const  mutations={
  

     [SET_NAV](state, id){
    state.nav=id
     },
    [SET_SONG](state,song){
state.song=song

    }
        
    
}
export  default{
    state,
    getters,
    actions,
    mutations
}