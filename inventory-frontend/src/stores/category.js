import config from "@/utils/config";
import { inventoryAxiosClient } from "@/utils/systemaxios";
import { defineStore } from "pinia";


export const useCategoryStore = defineStore('category', {
    state: () => ({
        rowData: [],
        categories: [],
        category: null,
        swal: null,
        errors: null,
        router: null,
        editForm:{
            name:null,
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
        async getAllCategories() {
            try {
                const { data } = await inventoryAxiosClient.get('all-categories');
                console.log(data);
                this.rowData = data;
                this.categories = data.data;
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
        async getCategories(page = 1, limit = this.limit, search = '') {
            try {
                const { data } = await inventoryAxiosClient.get('categories', {
                    params: {
                        'page': page,
                        'per_page': limit,
                        'search': search
                    }
                });
                console.log(data);
                this.rowData = data.data;
                this.categories = data.data.data;
                this.pagination.totalCount = data.metadata.count;
                this.pagination.currentPage = data.data.current_page;
                this.pagination.lastPage = data.data.last_page;

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
        async getCategory(category_id) {
            try{
                const {data} = await inventoryAxiosClient.get(`/categories/${category_id}`);
                this.editForm.name = data.data.name;
                console.log(data.data);
                this.category = data.data;
            }catch(error){
                console.log(error);
            }
         },
        
        async storeCategory(formData) {
            
            try {
                const { data } = await inventoryAxiosClient.post('categories', formData);
                console.log(data);
                
                this.swal({
                    icon: 'success',
                    title: 'Category Created Successfully',
                    timer: 1000
                });
                this.router.push({name:'category.index'});
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
        async updateCategory(editFormData,category_id) {
            try{
                const {data} = await inventoryAxiosClient.put(`/categories/${category_id}`,editFormData);
                console.log(data);
                this.swal({
                    icon:'success',
                    title:'Updated Successfully',
                    timer:1000
                });
                this.router.push({name:'category.index'});
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
        async deleteCategory(id) {
            try {
                const { data } = inventoryAxiosClient.delete(`/categories/${id}`);
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
        async changeStatus(category_id) {
            try {
                const { data } = await inventoryAxiosClient.post(`/category-status/${category_id}`);
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