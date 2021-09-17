import ApiService from "../common/api.service"


const  state={
singer:{}
}

const actions={
   async  fetchSinger(context,id){
    
       try{
            const response=await ApiService.get(`/api/artist/${id}`)
            
            context.commit('setArtist',response.data.data)
            
       }
       catch(e){
    
       }
   },
   async subscribe(context,id){
       try{
           const  response=  await ApiService.post(`/api/subscribe/${id}`)
            context.commit('setSubscribeTrue')
       }
       catch(e){

       }
   },
   async unSubscribe(context,id){
       try{
   const response =await ApiService.delete(`/api/subscribe/${id}`)
   context.commit('setSubscribeFalse')
       }
       catch(e){

       }
   }
}
const mutations={
setArtist(state,data){
    state.singer=data
  
},
setSubscribeTrue(state){
state.singer.isSubscribed=true
},
setSubscribeFalse(state){
    state.singer.isSubscribed=false
}
}
export default{
state,
actions,
mutations
}