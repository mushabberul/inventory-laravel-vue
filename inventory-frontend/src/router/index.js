import { createRouter, createWebHistory } from 'vue-router';
import AuthLayout from '@/Layouts/AuthLayout.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';;

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      redirect:'/dashboard',
      component: DefaultLayout,
      meta:{requiresAuth:true},
      children:[
        {path:'/dashboard',name:'dashboard',component: ()=>import('@/views/Dashboard.vue')},
        {path:'/category/index',name:'category.index',component: ()=>import('@/views/Category/Index.vue')},
        {path:'/category/create',name:'category.create',component: ()=>import('@/views/Category/Create.vue')},
        {path:'/caregory/edit',name:'category.edit',component: ()=>import('@/views/Category/Edit.vue')},
      ]
    },
    {
      path:'/auth',
      redirect:'/login',
      component: AuthLayout,
      meta:{isGuast:true},
      children:[
        {path:'/login',name:'login',component:()=>import('@/views/Auth/Login.vue')}
      ],
    }
  ]
})

router.beforeEach((to,from,next)=>{
   if(to.meta.requiresAuth && !localStorage.getItem('token')){
    next({name:"login"});
   }else if(to.meta.isGuast  && localStorage.getItem('token')){
    next({name:'dashboard'});
   }else{
    next();
   }
})

export default router
