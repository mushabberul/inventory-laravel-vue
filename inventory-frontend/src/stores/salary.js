import config from "@/utils/config";
import { inventoryAxiosClient } from "@/utils/systemaxios";
import { defineStore } from "pinia";


export const useSalaryStore = defineStore('salary', {
    state: () => ({
        rowData: [],
        salaries: [],
        salary: null,
        swal: null,
        errors: null,
        router: null,
        editForm:{
            staff_id: null,
            date: null,
            month: null,
            year: null,
            amount: null,
            type: null,
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
        async getAllSalarys() {
            try {
                const { data } = await inventoryAxiosClient.get('all-salaries');
                console.log(data);
                this.rowData = data;
                this.salaries = data.data;
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
        async getSalarys(page = 1, limit = this.limit, search = '') {
            try {
                const { data } = await inventoryAxiosClient.get('salaries', {
                    params: {
                        'page': page,
                        'per_page': limit,
                        'search': search
                    }
                });
                console.log(data);
                this.rowData = data.data;
                this.salaries = data.data.data;
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
        async getSalary(salary_id) {
            try{
                const {data} = await inventoryAxiosClient.get(`/salaries/${salary_id}`);

             
                this.editForm.staff_id = data.data.staff_id;
                this.editForm.date = data.data.date;
                this.editForm.month = data.data.month;
                this.editForm.year = data.data.year;
                this.editForm.amount = data.data.amount;
                this.editForm.type = data.data.type;
                console.log(data.data);
                this.salary = data.data;
            }catch(error){
                console.log(error);
            }
         },
        
        async storeSalary(formData) {
            
            try {
                const config = {
                    headers:{
                        'content-type':'multipart/form-data',
                    }
                }
                const { data } = await inventoryAxiosClient.post('salaries', formData,config);
                console.log(data);
                
                this.swal({
                    icon: 'success',
                    title: 'Salary Created Successfully',
                    timer: 1000
                });
                this.router.push({name:'salary.index'});
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
        async updateSalary(editForm,salary_id) {
            try{
                const config = {
                    headers:{
                        'content-type':'multipart/form-data',
                    }
                }
                const {data} = await inventoryAxiosClient.post(`/salaries/${salary_id}`,editForm,config);
                console.log(data);
                this.swal({
                    icon:'success',
                    title:'Updated Successfully',
                    timer:1000
                });
                this.router.push({name:'salary.index'});
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
        async deleteSalary(id) {
            try {
                const { data } = inventoryAxiosClient.delete(`/salaries/${id}`);
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
        async changeStatus(salary_id) {
         
            try {
                const { data } = await inventoryAxiosClient.post(`/salary-status/${salary_id}`);
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