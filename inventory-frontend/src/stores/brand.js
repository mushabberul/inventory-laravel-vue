import config from "@/utils/config";
import { inventoryAxiosClient } from "@/utils/systemaxios";
import { defineStore } from "pinia";


export const useBrandStore = defineStore('brand', {
    state: () => ({
        rowData: [],
        brands: [],
        brand: null,
        swal: null,
        errors: null,
        router: null,
        editForm:{
            name:null,
            file:null,
            code:null,
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
        async getAllBrands() {
            try {
                const { data } = await inventoryAxiosClient.get('all-brands');
                console.log(data);
                this.rowData = data;
                this.brands = data.data;
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
        async getBrands(page = 1, limit = this.limit, search = '') {
            try {
                const { data } = await inventoryAxiosClient.get('brands', {
                    params: {
                        'page': page,
                        'per_page': limit,
                        'search': search
                    }
                });
                console.log(data);
                this.rowData = data.data;
                this.brands = data.data.data;
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
        async getBrand(brand_id) {
            try{
                const {data} = await inventoryAxiosClient.get(`/brands/${brand_id}`);
                this.editForm.name = data.data.name;
                this.editForm.code = data.data.code;
                console.log(data.data);
                this.brand = data.data;
            }catch(error){
                console.log(error);
            }
         },
        
        async storeBrand(formData) {
            
            try {
                const config = {
                    headers:{
                        'content-type':'multipart/form-data',
                    }
                }
                const { data } = await inventoryAxiosClient.post('brands', formData,config);
                console.log(data);
                
                this.swal({
                    icon: 'success',
                    title: 'Brand Created Successfully',
                    timer: 1000
                });
                this.router.push({name:'brand.index'});
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
        async updateBrand(editFormData,brand_id) {
            try{
                const config = {
                    headers:{
                        'content-type':'multipart/form-data',
                    }
                }
                const {data} = await inventoryAxiosClient.post(`/brands/${brand_id}`,editFormData,config);
                console.log(data);
                this.swal({
                    icon:'success',
                    title:'Updated Successfully',
                    timer:1000
                });
                this.router.push({name:'brand.index'});
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
        async deleteBrand(id) {
            try {
                const { data } = inventoryAxiosClient.delete(`/brands/${id}`);
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
        async changeStatus(brand_id) {
            try {
                const { data } = await inventoryAxiosClient.post(`/brand-status/${brand_id}`);
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