import Vue from "vue";
import axios from "axios";
import VueAxios from "vue-axios";
import AppStorage from "./AppStorage"
import Exception from "./Exception";
const apiClient = axios.create({
  baseURL: `http://localhost:8000`,
  withCredentials: false, // This is the default
  headers: {
    Accept: 'application/json',
   'Content-Type': 'application/json',
    Authorization:`Bearer ${AppStorage.getToken()}`
  },
  timeout: 10000
})
const ApiService={
    init() {
        Vue.use(VueAxios, apiClient);
       
      },
     
     post(resource, params) {
    
        return    apiClient.post(`${resource}`, params);
      },
    
    
   get(resource, slug = "") {
  return      apiClient.get(`${resource}`)
      },
   
     
    
      update(resource, params) {
        return apiClient.put(`${resource}`, params);
      },
    
      put(resource, params) {
        return Vue.axios.put(`${resource}`, params);
      },
    
      delete(resource,params) {
        return apiClient.delete(`${resource}`,params).catch(error => {
          throw new Error(`[RWV] ApiService ${error}`);
        });
      }

}

export default ApiService;