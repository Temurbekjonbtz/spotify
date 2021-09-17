import Token from './Token'
import AppStorage from './AppStorage'
import  ApiService from './api.service'
class User {
    login(data) {
        axios.post('/api/auth/login', data)
            .then(res => this.responseAfterLogin(res))
            .catch(error => console.log(error.response.data))
    }

    responseAfterLogin(res) {
        const access_token = res.data.access_token
        const username =res.data.user
    
        if (Token.isValid(access_token)) {
            AppStorage.store(username, access_token)
            window.location = '/'
        }
    }

    hasToken() {
        const storedToken = AppStorage.getToken();
        if (storedToken) {
            return Token.isValid(storedToken) ? true : this.logout()
        }
        return false
    }

    loggedIn() {
        if(this.hasToken()){
            return  true
        }
        else{
return false
        }
      
    }

    logout() {
        AppStorage.clear()
        window.location = '/login'
    }
    getName(){
        if(this.loggedIn()){
          return AppStorage.getUser().name
        }
    }
   async update(data){
     const response=await ApiService.post('/api/auth/update',data)  
      AppStorage.storeUser(response.data.user)
      alert(response.data.message)
    }
    getEmail(){
        if(this.loggedIn()){
            return AppStorage.getUser().email
        }
    }
    isAdmin(){
        if(this.loggedIn()){
             var  user=AppStorage.getUser()
           if(user.role==='1'){
            return false
        }
        else  {
          
           return true
        }
    }
  
}

   

   

   
    signup(data){
        axios.post('/api/auth/signup',data)
        .then(res => {
            this.responseAfterLogin(res)
           
            })
        .catch(error => this.errors = error.response.data.errors)
    }


}

export default User = new User();