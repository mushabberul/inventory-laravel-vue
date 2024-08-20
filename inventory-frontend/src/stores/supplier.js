import config from "@/utils/config";
import { inventoryAxiosClient } from "@/utils/systemaxios";
import { defineStore } from "pinia";


export const useSupplierStore = defineStore('supplier', {
    state: () => ({
        rowData: [],
        suppliers: [],
        supplier: null,
        swal: null,
        errors: null,
        router: null,
        editForm:{
            name: null,
            phone: null,
            file: null,
            email:null,
            nid:null,
            address:null,
            company_name:null,
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
        async getAllSuppliers() {
            try {
                const { data } = await inventoryAxiosClient.get('all-suppliers');
                console.log(data);
                this.rowData = data;
                this.suppliers = data.data;
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
        async getSuppliers(page = 1, limit = this.limit, search = '') {
            try {
                const { data } = await inventoryAxiosClient.get('suppliers', {
                    params: {
                        'page': page,
                        'per_page': limit,
                        'search': search
                    }
                });
                console.log(data);
                this.rowData = data.data;
                this.suppliers = data.data.data;
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
        async getSupplier(supplier_id) {
            try{
                const {data} = await inventoryAxiosClient.get(`/suppliers/${supplier_id}`);
                this.editForm.name = data.data.name;
                this.editForm.email = data.data.email;
                this.editForm.phone = data.data.phone;
                this.editForm.nid = data.data.nid;
                this.editForm.address = data.data.address;
                this.editForm.company_name = data.data.company_name;
                console.log(data.data);
                this.supplier = data.data;
            }catch(error){
                console.log(error);
            }
         },
        
        async storeSupplier(formData) {
            
            try {
                const config = {
                    headers:{
                        'content-type':'multipart/form-data',
                    }
                }
                const { data } = await inventoryAxiosClient.post('suppliers', formData,config);
                console.log(data);
                
                this.swal({
                    icon: 'success',
                    title: 'Supplier Created Successfully',
                    timer: 1000
                });
                this.router.push({name:'supplier.index'});
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
        async updateSupplier(editForm,supplier_id) {
            try{
                const config = {
                    headers:{
                        'content-type':'multipart/form-data',
                    }
                }
                const {data} = await inventoryAxiosClient.post(`/suppliers/${supplier_id}`,editForm,config);
                console.log(data);
                this.swal({
                    icon:'success',
                    title:'Updated Successfully',
                    timer:1000
                });
                this.router.push({name:'supplier.index'});
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
        async deleteSupplier(id) {
            try {
                const { data } = inventoryAxiosClient.delete(`/suppliers/${id}`);
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
        async changeStatus(supplier_id) {
            try {
                const { data } = await inventoryAxiosClient.post(`/supplier-status/${supplier_id}`);
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