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
        {path:'/pos',name:'pos.index',component: ()=>import('@/views/POS/Index.vue')},

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
        //Product
        {path:'/product/index',name:'product.index',component: ()=>import('@/views/Product/Index.vue')},
        {path:'/product/create',name:'product.create',component: ()=>import('@/views/Product/Create.vue')},
        {path:'/product/edit/:id',name:'product.edit',component: ()=>import('@/views/Product/Edit.vue')},
        //Expense Category
        {path:'/expense/category/index',name:'expense.category.index',component: ()=>import('@/views/ExpenseCategory/Index.vue')},
        {path:'/expense/category/create',name:'expense.category.create',component: ()=>import('@/views/ExpenseCategory/Create.vue')},
        {path:'/expense/category/edit/:id',name:'expense.category.edit',component: ()=>import('@/views/ExpenseCategory/Edit.vue')},
        //Expense
        {path:'/expense/index',name:'expense.index',component: ()=>import('@/views/Expense/Index.vue')},
        {path:'/expense/create',name:'expense.create',component: ()=>import('@/views/Expense/Create.vue')},
        {path:'/expense/edit/:id',name:'expense.edit',component: ()=>import('@/views/Expense/Edit.vue')},
        //Salary
        {path:'/salary/index',name:'salary.index',component: ()=>import('@/views/Salary/Index.vue')},
        {path:'/salary/create',name:'salary.create',component: ()=>import('@/views/Salary/Create.vue')},
        {path:'/salary/edit/:id',name:'salary.edit',component: ()=>import('@/views/Salary/Edit.vue')},
        //Order
        {path:'/order/index',name:'order.index',component: ()=>import('@/views/Order/Index.vue')},
       


        //CRM
        //Customer
        {path:'/customer/index',name:'customer.index',component: ()=>import('@/views/Customer/Index.vue')},
        {path:'/customer/create',name:'customer.create',component: ()=>import('@/views/Customer/Create.vue')},
        {path:'/customer/edit/:id',name:'customer.edit',component: ()=>import('@/views/Customer/Edit.vue')},
        
        //HRM
        //Staff
        {path:'/staff/index',name:'staff.index',component: ()=>import('@/views/Staff/Index.vue')},
        {path:'/staff/create',name:'staff.create',component: ()=>import('@/views/Staff/Create.vue')},
        {path:'/staff/edit/:id',name:'staff.edit',component: ()=>import('@/views/Staff/Edit.vue')},
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
