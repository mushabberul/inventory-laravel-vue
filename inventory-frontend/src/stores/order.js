import config from "@/utils/config";
import { inventoryAxiosClient } from "@/utils/systemaxios";
import { defineStore } from "pinia";


export const useOrderStore = defineStore('order', {
    state: () => ({
        rowData: [],
        orders: [],
        order: null,
        swal: null,
        errors: null,
        router: null,
        
        limit: config.defaultDataLimit || 10,
        pagination: {
            currentPage: 1,
            lastPage: 0,
            totalCount: 0
        },
        payment_method: ['cash', 'card', 'bkash'],
        dataLimit: config.defaultDataLimit,
    }),
    getters: {},
    actions: {
        async getAllOrders() {
            try {
                const { data } = await inventoryAxiosClient.get('all-orders');
                console.log(data);
                this.rowData = data;
                this.orders = data.data;
                this.pagination.totalCount = data.metadata.count;

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
        async getOrders(page = 1, limit = this.limit, search = '') {
            try {
              
                const { data } = await inventoryAxiosClient.get('orders');
                console.log(data);
                this.rowData = data.data;
                this.orders = data.data.data;
                this.pagination.totalCount = data.metadata.count;
                this.pagination.currentPage = data.data.current_page;
                this.pagination.lastPage = data.data.last_page;

            } catch (error) {
                console.log(error);
                this.errors = error.response.data;
                this.swal({
                    icon: 'error',
                    title: 'Something Went Wrong!',
                    text: this.errors.message
                });

                
            }
        },
        async getOrder(order_id) {
            try{
                const {data} = await inventoryAxiosClient.get(`/orders/${order_id}`);

                this.editForm.category_id = data.data.category_id;
                this.editForm.brand_id = data.data.brand_id;
                this.editForm.supplier_id = data.data.supplier_id;
                this.editForm.name = data.data.name;
                this.editForm.slug = data.data.slug;
                this.editForm.original_price = data.data.original_price;
                this.editForm.sell_price = data.data.sell_price;
                this.editForm.stock = data.data.stock;
                this.editForm.description = data.data.description;
                this.editForm.code = data.data.code;
                console.log(data.data);
                this.order = data.data;
            }catch(error){
                console.log(error);
            }
         },
        
        async storeOrder(formData) {
            
            try {
                
                const { data } = await inventoryAxiosClient.post('orders', formData);
                console.log(data);
                
                this.swal({
                    icon: 'success',
                    title: 'Order Created Successfully',
                    timer: 1000
                });
                this.router.push({name:'order.index'});
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
        async updateOrder(editForm,order_id) {
            try{
                const config = {
                    headers:{
                        'content-type':'multipart/form-data',
                    }
                }
                const {data} = await inventoryAxiosClient.post(`/orders/${order_id}`,editForm,config);
                console.log(data);
                this.swal({
                    icon:'success',
                    title:'Updated Successfully',
                    timer:1000
                });
                this.router.push({name:'order.index'});
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
        async deleteOrder(id) {
            try {
                const { data } = inventoryAxiosClient.delete(`/orders/${id}`);
                this.swal({
                    icon: 'success',
                    title: 'Deleted Successfully!',
                    timer: 1000
                });
            } catch (error) {
                this.errors = error.response.data;
                this.swal({
                    icon: 'error',
                    title: 'Something Went Wrong!',
                    timer: 1000,
                    text: this.errors.message
                });
            }
        },
       
    }
});