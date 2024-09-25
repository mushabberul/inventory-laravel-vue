import config from "@/utils/config";
import { inventoryAxiosClient } from "@/utils/systemaxios";
import { defineStore } from "pinia";


export const useCartStore = defineStore('cart', {
    state: () => ({
        rowData: [],
        carts: [],
        swal: null,
        errors: null,
        router: null,
       subtotal:0,
       cartcount:0,
        
        limit: config.defaultDataLimit || 10,
        pagination: {
            currentPage: 1,
            lastPage: 0,
            totalCount: 0
        },
        dataLimit: config.defaultDataLimit,
    }),
    getters: {},
    actions: {
        async getCartItems() {
            try {
                const { data } = await inventoryAxiosClient.get('carts');
                console.log(data);
                this.rowData = data;
                this.totalCount = data.metadata.count;
                this.subtotal = data.metadata.subtotal;
                this.carts = data.data;
            } catch (error) {
                console.log(error);
                this.swal({
                    icon: 'error',
                    title: 'Something Went Wrong!',
                    text: this.errors.message
                });
                this.errors = error.response.data;
            }
        },
        
        async storeCartItem(formData) {
            try {
                const { data } = await inventoryAxiosClient.post('add-to-cart', formData);
                console.log(data);
                
                this.swal({
                    icon: 'success',
                    title: 'Cart Created Successfully',
                    timer: 1000
                });
                this.router.push({name:'pos.index'});
            } catch (error) {
                console.log(error);
                this.errors = error.response.data;
                this.swal({
                    icon:'error',
                    title:'Something Went Wrong!',
                    text: this.errors.message
                });
            }
        },
        async removeCartItem(cart_id) {
            try{
               
                const {data} = await inventoryAxiosClient.get(`/remove-cart-item/${cart_id}`);
                console.log(data);
                this.swal({
                    icon:'success',
                    title:'Cart Item Remove Successfully',
                    timer:1000
                });
                this.getCartItems();
            }catch(error){
                console.log(error);
                this.errors = error.response.data;
                this.swal({
                    icon:'error',
                    title:'Something Went Wrong!',
                    timer:1000,
                    text:this.errors.message
                });
            }
         },
        async increaseCartItem(cart_id) {
            try{
                const {data} = await inventoryAxiosClient.get(`/increase-cart-item/${cart_id}`);
                console.log(data);
                this.swal({
                    icon:'success',
                    title:'Cart Item Updated Successfully',
                    timer:1000
                });
                this.getCartItems();
            }catch(error){
                console.log(error);
                this.errors = error.response.data;
                this.swal({
                    icon:'error',
                    title:'Something Went Wrong!',
                    timer:1000,
                    text:this.errors.message
                });
            }
         },
        async decreaseCartItem(cart_id) {
            try{
                const {data} = await inventoryAxiosClient.get(`/decrease-cart-item/${cart_id}`);
                console.log(data);
               
                this.swal({
                    icon:'success',
                    title:'Cart Item Updated Successfully',
                    timer:1000
                });
                this.getCartItems();
              
            }catch(error){
                console.log(error);
                this.errors = error.response.data;
                this.swal({
                    icon:'error',
                    title:'Something Went Wrong!',
                    timer:1000,
                    text:this.errors.message
                });
            }
         },
        
    }
});