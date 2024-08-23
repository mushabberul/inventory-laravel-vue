import config from "@/utils/config";
import { inventoryAxiosClient } from "@/utils/systemaxios";
import { defineStore } from "pinia";


export const useStaffStore = defineStore('staff', {
    state: () => ({
        rowData: [],
        staffs: [],
        staff: null,
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
        async getAllStaffs() {
            try {
                const { data } = await inventoryAxiosClient.get('all-staffs');
                console.log(data);
                this.rowData = data;
                this.staffs = data.data;
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
        async getStaffs(page = 1, limit = this.limit, search = '') {
            try {
                const { data } = await inventoryAxiosClient.get('staffs', {
                    params: {
                        'page': page,
                        'per_page': limit,
                        'search': search
                    }
                });
                console.log(data);
                this.rowData = data.data;
                this.staffs = data.data.data;
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
        async getStaff(staff_id) {
            try{
                const {data} = await inventoryAxiosClient.get(`/staffs/${staff_id}`);
                this.editForm.name = data.data.name;
                this.editForm.email = data.data.email;
                this.editForm.phone = data.data.phone;
                this.editForm.nid = data.data.nid;
                this.editForm.address = data.data.address;
                console.log(data.data);
                this.staff = data.data;
            }catch(error){
                console.log(error);
            }
         },
        
        async storeStaff(formData) {
            
            try {
                const config = {
                    headers:{
                        'content-type':'multipart/form-data',
                    }
                }
                const { data } = await inventoryAxiosClient.post('staffs', formData,config);
                console.log(data);
                
                this.swal({
                    icon: 'success',
                    title: 'Staff Created Successfully',
                    timer: 1000
                });
                this.router.push({name:'staff.index'});
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
        async updateStaff(editForm,staff_id) {
            try{
                const config = {
                    headers:{
                        'content-type':'multipart/form-data',
                    }
                }
                const {data} = await inventoryAxiosClient.post(`/staffs/${staff_id}`,editForm,config);
                console.log(data);
                this.swal({
                    icon:'success',
                    title:'Updated Successfully',
                    timer:1000
                });
                this.router.push({name:'staff.index'});
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
        async deleteStaff(id) {
            try {
                const { data } = inventoryAxiosClient.delete(`/staffs/${id}`);
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
        async changeStatus(staff_id) {
            try {
                const { data } = await inventoryAxiosClient.post(`/staff-status/${staff_id}`);
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