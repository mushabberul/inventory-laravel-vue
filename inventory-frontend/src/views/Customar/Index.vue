<script setup>
//All libery import
import config from "@/utils/config";
import { useCustomarStore } from '@/stores/customar';
import { ref, reactive, onMounted,inject,watch } from 'vue';
import { useRouter } from 'vue-router';
import _ from 'lodash';

//All instance
const customarStore = useCustomarStore();
const router = useRouter();
const swal = inject('$swal');

customarStore.swal = swal;
//All veriable
const searchKeyword = ref('');
const base_url=config.base_url;

//All methods

const deleteCustomar = (customar_id,customar_name)=>{
    swal({
        title:"Are you sure delete?",
        text: customar_name,
        icon:"warning",
        showCancelButton:true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result)=>{
        if(result.isConfirmed){
            customarStore.deleteCustomar(customar_id);
            customarStore.getCustomars(customarStore.pagination.currentPage,customarStore.limit);
        }
    });
}

//Hooks & Computed
onMounted(()=>{
    customarStore.getCustomars(customarStore.pagination.currentPage,customarStore.limit);
});

watch(
    searchKeyword,
    _.debounce((current,previous)=>{
 
    customarStore.getCustomars(customarStore.pagination.currentPage,customarStore.limit,current);
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
                                <h4>Customar List</h4>
                                <router-link class="btn btn-success" :to="{ name: 'customar.create' }">
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
                                    Total Count: <span class="">{{ customarStore.pagination.totalCount }}</span>
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
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(customar,index) in customarStore.customars">
                                    <td>{{ (customarStore.pagination.currentPage*customarStore.limit)-customarStore.limit + index +1 }}</td>
                                    <td>{{customar.name}}</td>
                                    <td>{{customar.email}}</td>
                                    <td>{{customar.phone}}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                        <input @change="customarStore.changeStatus(customar.id)" class="form-check-input" type="checkbox" role="switch" :checked="customar.status">
                                        </div>
                                    </td>
                                    <td>
                                        <router-link :to="{name:'customar.edit',params:{id:customar.id}}" class="btn btn-warning">
                                           
                                            <i class='bx bxs-edit'></i>
                                        </router-link>
                                        <a @click.prevent="deleteCustomar(customar.id,customar.name)" class="btn btn-danger ms-2">
                                            <i class="bx bxs-trash"></i>
                                        </a>
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <v-pagination
                            v-model="customarStore.pagination.currentPage"
                            :pages="customarStore.pagination.lastPage"
                            :range-size="1"
                            active-color="#DCEDFF"
                            @update:modelValue="customarStore.getCustomars(customarStore.pagination.currentPage,customarStore.limit);"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>