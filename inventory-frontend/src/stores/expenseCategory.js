import config from "@/utils/config";
import { inventoryAxiosClient } from "@/utils/systemaxios";
import { defineStore } from "pinia";


export const useExpenseCategoryStore = defineStore('expenseCategory', {
    state: () => ({
        rowData: [],
        expenseCategorys: [],
        expenseCategory: null,
        swal: null,
        errors: null,
        router: null,
        editForm:{
            name: null,
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
        async getAllExpenseCategorys() {
            try {
                const { data } = await inventoryAxiosClient.get('all-expense-categoris');
                console.log(data);
                this.rowData = data;
                this.expenseCategorys = data.data;
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
        async getExpenseCategorys(page = 1, limit = this.limit, search = '') {
            try {
                const { data } = await inventoryAxiosClient.get('expense-categoris', {
                    params: {
                        'page': page,
                        'per_page': limit,
                        'search': search
                    }
                });
                console.log(data);
                this.rowData = data.data;
                this.expenseCategorys = data.data.data;
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
        async getExpenseCategory(expenseCategory_id) {
            try{
                const {data} = await inventoryAxiosClient.get(`/expense-categoris/${expenseCategory_id}`);

                this.editForm.name = data.data.name;
                console.log(data.data);
                this.expenseCategory = data.data;
            }catch(error){
                console.log(error);
            }
         },
        
        async storeExpenseCategory(formData) {
            
            try {
                const config = {
                    headers:{
                        'content-type':'multipart/form-data',
                    }
                }
                const { data } = await inventoryAxiosClient.post('expense-categoris', formData,config);
                console.log(data);
                
                this.swal({
                    icon: 'success',
                    title: 'ExpenseCategory Created Successfully',
                    timer: 1000
                });
                this.router.push({name:'expense.category.index'});
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
        async updateExpenseCategory(editForm,expenseCategory_id) {
            try{
                const config = {
                    headers:{
                        'content-type':'multipart/form-data',
                    }
                }
                const {data} = await inventoryAxiosClient.post(`/expense-categoris/${expenseCategory_id}`,editForm,config);
                console.log(data);
                this.swal({
                    icon:'success',
                    title:'Updated Successfully',
                    timer:1000
                });
                this.router.push({name:'expense.category.index'});
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
         }
    
    }
});