<script setup>
//All libery import
import config from "@/utils/config";
import { useStaffStore } from '@/stores/staff';
import { ref, reactive, onMounted,inject,watch } from 'vue';
import { useRouter } from 'vue-router';
import _ from 'lodash';

//All instance
const staffStore = useStaffStore();
const router = useRouter();
const swal = inject('$swal');

staffStore.swal = swal;
//All veriable
const searchKeyword = ref('');
const base_url=config.base_url;

//All methods

const deleteStaff = (staff_id,staff_name)=>{
    swal({
        title:"Are you sure delete?",
        text: staff_name,
        icon:"warning",
        showCancelButton:true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result)=>{
        if(result.isConfirmed){
            staffStore.deleteStaff(staff_id);
            staffStore.getStaffs(staffStore.pagination.currentPage,staffStore.limit);
        }
    });
}

//Hooks & Computed
onMounted(()=>{
    staffStore.getStaffs(staffStore.pagination.currentPage,staffStore.limit);
});

watch(
    searchKeyword,
    _.debounce((current,previous)=>{
 
    staffStore.getStaffs(staffStore.pagination.currentPage,staffStore.limit,current);
},500));


</script>
<template>
    <div class="page-content">
        <div class="container-fluid">
            <!-- Content here -->
            <div class="row">
                <!-- Header Part -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4>Staff List</h4>
                                <router-link class="btn btn-success" :to="{ name: 'staff.create' }">
                                    <i class='bx bx-plus-circle'></i>
                                    Create New
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Statistic -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    Total Count: <span class="">{{ staffStore.pagination.totalCount }}</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="search" v-model="searchKeyword" placeholder="Search ..." class="form-control" id="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table  -->
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Name</th>
                                    <th>email</th>
                                    <th>phone</th>
                                    <th>NID</th>
                                    <th>Address</th>
                                    <th>File</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(staff,index) in staffStore.staffs">
                                    <td>{{ (staffStore.pagination.currentPage*staffStore.limit)-staffStore.limit + index +1 }}</td>
                                    <td>{{staff.name}}</td>
                                    <td>{{staff.email}}</td>
                                    <td>{{staff.phone}}</td>
                                    <td>{{staff.nid}}</td>
                                    <td>{{staff.address}}</td>
                                    <td>
                                        <template v-if="staff.file != null">

                                            <a :href="base_url+staff.file"><i class='bx bxs-download'></i></a>
                                        </template>
                                    </td>
                                   
                                    <td>
                                        <div class="form-check form-switch">
                                        <input @change="staffStore.changeStatus(staff.id)" class="form-check-input" type="checkbox" role="switch" :checked="staff.status">
                                        </div>
                                    </td>
                                    <td>
                                        <router-link :to="{name:'staff.edit',params:{id:staff.id}}" class="btn btn-warning">
                                           
                                            <i class='bx bxs-edit'></i>
                                        </router-link>
                                        <a @click.prevent="deleteStaff(staff.id,staff.name)" class="btn btn-danger ms-2">
                                            <i class="bx bxs-trash"></i>
                                        </a>
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <v-pagination
                            v-model="staffStore.pagination.currentPage"
                            :pages="staffStore.pagination.lastPage"
                            :range-size="1"
                            active-color="#DCEDFF"
                            @update:modelValue="staffStore.getStaffs(staffStore.pagination.currentPage,staffStore.limit);"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>