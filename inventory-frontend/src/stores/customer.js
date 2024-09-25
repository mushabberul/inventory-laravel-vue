import config from "@/utils/config";
import { inventoryAxiosClient } from "@/utils/systemaxios";
import { defineStore } from "pinia";


export const useCustomerStore = defineStore('customer', {
    state: () => ({
        rowData: [],
        customers: [],
        customer: null,
        swal: null,
        errors: null,
        router: null,
        editForm:{
            name: null,
            phone: null,
            file: null,
            email:null,
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
        async getAllCustomers() {
            try {
                const { data } = await inventoryAxiosClient.get('all-customers');
                console.log(data);
                this.rowData = data;
                this.customers = data.data;
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
        async getCustomers(page = 1, limit = this.limit, search = '') {
            try {
                const { data } = await inventoryAxiosClient.get('customers', {
                    params: {
                        'page': page,
                        'per_page': limit,
                        'search': search
                    }
                });
                console.log(data);
                this.rowData = data.data;
                this.customers = data.data.data;
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
        async getCustomer(customer_id) {
            try{
                const {data} = await inventoryAxiosClient.get(`/customers/${customer_id}`);
                this.editForm.name = data.data.name;
                this.editForm.email = data.data.email;
                this.editForm.phone = data.data.phone;
                this.editForm.nid = data.data.nid;
                this.editForm.address = data.data.address;
                this.editForm.company_name = data.data.company_name;
                console.log(data.data);
                this.customer = data.data;
            }catch(error){
                console.log(error);
            }
         },
        
        async storeCustomer(formData) {
            
            try {
                const config = {
                    headers:{
                        'content-type':'multipart/form-data',
                    }
                }
                const { data } = await inventoryAxiosClient.post('customers', formData,config);
                console.log(data);
                
                this.swal({
                    icon: 'success',
                    title: 'Customer Created Successfully',
                    timer: 1000
                });
                this.router.push({name:'customer.index'});
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
        async updateCustomer(editForm,customer_id) {
            try{
                
                const {data} = await inventoryAxiosClient.put(`/customers/${customer_id}`,editForm);
                console.log(data);
                this.swal({
                    icon:'success',
                    title:'Updated Successfully',
                    timer:1000
                });
                this.router.push({name:'customer.index'});
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
        async deleteCustomer(id) {
            try {
                const { data } = inventoryAxiosClient.delete(`/customers/${id}`);
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
        async changeStatus(customer_id) {
            try {
                const { data } = await inventoryAxiosClient.post(`/customer-status/${customer_id}`);
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