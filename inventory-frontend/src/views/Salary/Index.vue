<script setup>
//All libery import
import config from "@/utils/config";
import { useSalaryStore } from '@/stores/salary';
import { ref, reactive, onMounted,inject,watch } from 'vue';
import { useRouter } from 'vue-router';
import _ from 'lodash';

//All instance
const salaryStore = useSalaryStore();
const router = useRouter();
const swal = inject('$swal');

salaryStore.swal = swal;
//All veriable
const searchKeyword = ref('');


//All methods



//Hooks & Computed
onMounted(()=>{
    salaryStore.getSalarys(salaryStore.pagination.currentPage,salaryStore.limit);
});

watch(
    searchKeyword,
    _.debounce((current,previous)=>{
    salaryStore.getSalarys(salaryStore.pagination.currentPage,salaryStore.limit,current);
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
                                <h4>Salary List</h4>
                                <router-link class="btn btn-success" :to="{ name: 'salary.create' }">
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
                                    Total Count: <span class="">{{ salaryStore.pagination.totalCount }}</span>
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
                                    <th>Staff Name</th>
                                    <th>Date</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(salary,index) in salaryStore.salaries" :key="salary.id">
                                    <td>{{ (salaryStore.pagination.currentPage*salaryStore.limit)-salaryStore.limit + index +1 }}</td>
                                    <td>{{salary.staff.name}}</td>
                                    <td>{{new Date(salary.date).toDateString()}}</td>
                                    <td>{{salary.month}}</td>
                                    <td>{{salary.year}}</td>
                                    <td>{{salary.amount}}</td>
                                    <td>{{salary.type}}</td>
                                    <td>
                                        <router-link :to="{name:'salary.edit',params:{id:salary.id}}" class="btn btn-warning">
                                            <i class='bx bxs-edit'></i>
                                        </router-link>

                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <v-pagination
                            v-model="salaryStore.pagination.currentPage"
                            :pages="salaryStore.pagination.lastPage"
                            :range-size="1"
                            active-color="#DCEDFF"
                            @update:modelValue="salaryStore.getSalarys(salaryStore.pagination.currentPage,salaryStore.limit);"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>