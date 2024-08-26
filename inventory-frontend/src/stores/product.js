import config from "@/utils/config";
import { inventoryAxiosClient } from "@/utils/systemaxios";
import { defineStore } from "pinia";


export const useProductStore = defineStore('product', {
    state: () => ({
        rowData: [],
        products: [],
        product: null,
        swal: null,
        errors: null,
        router: null,
        editForm:{
            category_id: null,
            brand_id: null,
            supplier_id: null,
            name: null,
            slug: null,
            original_price: null,
            sell_price:null,
            stock:null,
            description:null,
            code:null,
            file:null,
             _method: 'PUT'
        },
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
        async getAllProducts() {
            try {
                const { data } = await inventoryAxiosClient.get('all-products');
                console.log(data);
                this.rowData = data;
                this.products = data.data;
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
        async getProducts(page = 1, limit = this.limit, search = '') {
            try {
                const { data } = await inventoryAxiosClient.get('products', {
                    params: {
                        'page': page,
                        'per_page': limit,
                        'search': search
                    }
                });
                console.log(data);
                this.rowData = data.data;
                this.products = data.data.data;
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
        async getProduct(product_id) {
            try{
                const {data} = await inventoryAxiosClient.get(`/products/${product_id}`);

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
                this.product = data.data;
            }catch(error){
                console.log(error);
            }
         },
        
        async storeProduct(formData) {
            
            try {
                const config = {
                    headers:{
                        'content-type':'multipart/form-data',
                    }
                }
                const { data } = await inventoryAxiosClient.post('products', formData,config);
                console.log(data);
                
                this.swal({
                    icon: 'success',
                    title: 'Product Created Successfully',
                    timer: 1000
                });
                this.router.push({name:'product.index'});
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
        async updateProduct(editForm,product_id) {
            try{
                const config = {
                    headers:{
                        'content-type':'multipart/form-data',
                    }
                }
                const {data} = await inventoryAxiosClient.post(`/products/${product_id}`,editForm,config);
                console.log(data);
                this.swal({
                    icon:'success',
                    title:'Updated Successfully',
                    timer:1000
                });
                this.router.push({name:'product.index'});
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
        async deleteProduct(id) {
            try {
                const { data } = inventoryAxiosClient.delete(`/products/${id}`);
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
        async changeStatus(product_id) {
         
            try {
                const { data } = await inventoryAxiosClient.post(`/product-status/${product_id}`);
                console.log(data);
                this.swal({
                    icon: 'success',
                    title: 'Status Updated',
                    timer: 1000
                });
            } catch (error) {
                console.log(error);
                this.errors = error.response.data;
                this.swal({
                    icon: 'error',
                    title: 'Something Went Wrong',
                    timer: 100,
                    text: this.errors.message
                });
            }
        }
    }
});