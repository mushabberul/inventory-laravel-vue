import { ref, computed } from 'vue';
import { defineStore } from 'pinia';
import axios from 'axios';
import { baseClient, inventoryAxiosClient } from '@/utils/systemaxios';

export const useAuthStore = defineStore('auth', {
    state:()=>({
        token:localStorage.getItem('token') || 0,
        username:localStorage.getItem('username') || 0,
        error:[],
        message:[]
    }),
    getters:{
        getToken:(state)=> state.token,
        getUserName:(state)=> state.username,
    },
    actions:{

        setToken(token){
            this.token = token;
            localStorage.setItem(`token`,token);
        },
        removeToken:()=>localStorage.removeItem('token'),
        setUserName(name){
            this.username = name;
            localStorage.setItem(`username`,name);
        },
       
        removeUserName:()=> localStorage.removeItem('username'),

        async login(formData,callback){
            try{
                const response = await baseClient.get('/sanctum/csrf-cookie');
                const {data} = await inventoryAxiosClient.post(`/login`,formData);
                this.message = data.message;
                this.setToken(data.data.token);
                this.setUserName(data.data.user.name);
                callback(data.status);
              
                
            }catch(error){
                this.error = error.response.data;
                this.removeToken();
                this.message = error.response?.data?.message
                callback(error)
                
            }
        }
    }
     
})
