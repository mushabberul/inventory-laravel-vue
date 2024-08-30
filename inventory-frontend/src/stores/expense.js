import config from "@/utils/config";
import { inventoryAxiosClient } from "@/utils/systemaxios";
import { defineStore } from "pinia";


export const useExpenseStore = defineStore('expense', {
    state: () => ({
        rowData: [],
        expenses: [],
        expense: null,
        swal: null,
        errors: null,
        router: null,
       
        editForm:{
            expense_category_id: null,
            staff_id: null,
            amount: null,
            note: null,
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
        async getAllExpenses() {
            try {
                const { data } = await inventoryAxiosClient.get('all-expenses');
                console.log(data);
                this.rowData = data;
                this.expenses = data.data;
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
        async getExpenses(page = 1, limit = this.limit, search = '') {
            try {
                const { data } = await inventoryAxiosClient.get('expenses', {
                    params: {
                        'page': page,
                        'per_page': limit,
                        'search': search
                    }
                });
                console.log(data);
                this.rowData = data.data;
                this.expenses = data.data.data;
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
        async getExpense(expense_id) {
            try{
                const {data} = await inventoryAxiosClient.get(`/expenses/${expense_id}`);

                this.editForm.expense_category_id = data.data.expense_category_id;
                this.editForm.staff_id = data.data.staff_id;
                this.editForm.amount = data.data.amount;
                this.editForm.note = data.data.note;
               
                console.log(data.data);
                this.expense = data.data;
            }catch(error){
                console.log(error);
            }
         },
        
        async storeExpense(formData) {
            
            try {
                const config = {
                    headers:{
                        'content-type':'multipart/form-data',
                    }
                }
                const { data } = await inventoryAxiosClient.post('expenses', formData,config);
                console.log(data);
                
                this.swal({
                    icon: 'success',
                    title: 'Expense Created Successfully',
                    timer: 1000
                });
                this.router.push({name:'expense.index'});
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
        async updateExpense(editForm,expense_id) {
            try{
                const config = {
                    headers:{
                        'content-type':'multipart/form-data',
                    }
                }
                const {data} = await inventoryAxiosClient.post(`/expenses/${expense_id}`,editForm,config);
                console.log(data);
                this.swal({
                    icon:'success',
                    title:'Updated Successfully',
                    timer:1000
                });
                this.router.push({name:'expense.index'});
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