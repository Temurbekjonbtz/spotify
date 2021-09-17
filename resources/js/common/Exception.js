import User from './User';

class Exception{
    handle(error){
        if(error.response.data.action){
            alert(error.response.data.error)
            this.action(error.response.data.action)
        }
      
    }

   action(action){
        if(action === 'logout'){
           User.logout()
          
        }
    }
}

export default Exception = new Exception()