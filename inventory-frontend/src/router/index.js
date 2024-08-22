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

        //Inventory
        //Category
        {path:'/category/index',name:'category.index',component: ()=>import('@/views/Category/Index.vue')},
        {path:'/category/create',name:'category.create',component: ()=>import('@/views/Category/Create.vue')},
        {path:'/caregory/edit/:id',name:'category.edit',component: ()=>import('@/views/Category/Edit.vue')},
        //Brand
        {path:'/brand/index',name:'brand.index',component: ()=>import('@/views/Brand/Index.vue')},
        {path:'/brand/create',name:'brand.create',component: ()=>import('@/views/Brand/Create.vue')},
        {path:'/brand/edit/:id',name:'brand.edit',component: ()=>import('@/views/Brand/Edit.vue')},
        //Supplier
        {path:'/supplier/index',name:'supplier.index',component: ()=>import('@/views/Supplier/Index.vue')},
        {path:'/supplier/create',name:'supplier.create',component: ()=>import('@/views/Supplier/Create.vue')},
        {path:'/supplier/edit/:id',name:'supplier.edit',component: ()=>import('@/views/Supplier/Edit.vue')},

        //CRM
        {path:'/customar/index',name:'customar.index',component: ()=>import('@/views/Customar/Index.vue')},
        {path:'/customar/create',name:'customar.create',component: ()=>import('@/views/Customar/Create.vue')},
        {path:'/customar/edit/:id',name:'customar.edit',component: ()=>import('@/views/Customar/Edit.vue')},
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
