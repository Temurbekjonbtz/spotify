import Vue from 'vue'
import Router from 'vue-router'

import login from './views/login'
import registration from './views/registration'
import  home  from './views/home'
import playlist  from './views/playlist'
import browse from './views/browse'
import settings  from './views/settings'
import search from './views/search'
import  album from './views/album'
import  SingerPage from './views/SingerPage'
import  mymusic  from './views/mymusic'
import  usersettings  from './views/usersettings'
import  admin  from './views/admin'
import User from './common/User'
import SingerList from './views/admin/SingerList'
import AlbumList from './views/admin/AlbumList'
import SongList from './views/admin/SongList'

Vue.use(Router)

const router = new Router({
  mode: 'history',
  routes: [
    {
      path: '/login',
      component: login,
      props: true,
      meta:{auth:false},
      beforeEnter(routeTo, routeFrom, next) {
       
        $("html").css({"padding":"0","margin":"0","height":"100%"});
		$("body").css({"padding":"0","margin":"0","height":"100%"});
		$("#app").css({"height":"100%","width":"100%"});
    next();
      }
    },
    {
      path: '/registration',
      component: registration,
         meta:{auth:false},
      beforeEnter(routeTo, routeFrom, next) {
       console.log('hello')
        $("html").css({"padding":"0","margin":"0","height":"100%"});
	      	$("body").css({"padding":"0","margin":"0","height":"100%"});
	      	$("#app").css({"height":"100%","width":"100%"});
    next();
      }
    },
    {
      path: '/',
      component: home,
      meta:{auth:true,role:false},
     children:[
      {
        path:'/',
        component:browse,
        name:'browse',
        meta:{auth:true,role:false},
    
    
      },
       {
         path:'/playlist',
         component:playlist,
         meta:{auth:true,role:false},
       },
       {
        path:'/settings',
        component:settings,
        meta:{auth:true,role:false},
        
      },
      {
        path:'/search',
        component:search,
        meta:{auth:true,role:false},
      },
      {
        path:'/album/:albumId',
        component:album,
        name:'album',
        meta:{auth:true,role:false},
       
      }, 
      {
        path:'/mymusic/:playlistId',
        component:mymusic,
       name:'mymusic',
       meta:{auth:true,role:false},
       
      },
      {
        path:'/usersettings',
        component:usersettings,
        meta:{auth:true,role:false},
      },
      {
        path:'/singer/:singerId',
        component:SingerPage,
        name:'singer',
        meta:{auth:true,role:false},
       
      }, 
    
     ]
    },
    {
      path:'/admin',
      component:admin,
      meta:{auth:true,role:true},
      children:[
        {
          path:'/admin',
          component:SingerList,
          meta:{auth:true,role:true}
        },
        {
          path:'/albumlist',
          component:AlbumList,
          meta:{auth:true,role:true}
        },
        {
          path:'/songlist',
          component:SongList,
          meta:{auth:true,role:true}
        },
        {
          path:'/adminalbum/:albumId',
          component:album,
          name:'adminalbum',
          meta:{auth:true,role:true},
         
        }, 
        {
          path:'/adminsinger/:singerId',
          component:SingerPage,
          name:'adminsinger',
          meta:{auth:true,role:true},
         
        }, 
       
      ]
    }
]
});
router.beforeEach((to,from,next)=>{
if(to.meta.auth  && !User.loggedIn()){
 console.log('to.meta.auth  && !User.loggedIn()')
  next('/login')
}
else if(!to.meta.auth && User.loggedIn()){
 if(User.isAdmin()){
   next('/admin')
 }
 else{
next('/')
 }

}

else if(to.meta.auth  && User.loggedIn()){
 if(to.meta.role){
  if(User.isAdmin()){
    next()
  }
  else{
    router.back()
  }
 }
 else{
   if(!User.isAdmin()){
     next()
   }
   else{
     router.back()
   }
 }
  
}
else{
  next()
}





});

export default router
