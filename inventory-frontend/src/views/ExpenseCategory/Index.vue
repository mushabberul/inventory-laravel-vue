<script setup>
//All libery import
import config from "@/utils/config";
import { useExpenseCategoryStore } from '@/stores/expenseCategory';
import { ref, reactive, onMounted,inject,watch } from 'vue';
import { useRouter } from 'vue-router';
import _ from 'lodash';

//All instance
const expenseCategoryStore = useExpenseCategoryStore();
const router = useRouter();
const swal = inject('$swal');

expenseCategoryStore.swal = swal;
//All veriable
const searchKeyword = ref('');


//All methods

//Hooks & Computed
onMounted(()=>{
    expenseCategoryStore.getExpenseCategorys(expenseCategoryStore.pagination.currentPage,expenseCategoryStore.limit);
});

watch(
    searchKeyword,
    _.debounce((current,previous)=>{
    expenseCategoryStore.getExpenseCategorys(expenseCategoryStore.pagination.currentPage,expenseCategoryStore.limit,current);
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
                                <h4>ExpenseCategory List</h4>
                                <router-link class="btn btn-success" :to="{ name: 'expense.category.create' }">
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
                                    Total Count: <span class="">{{ expenseCategoryStore.pagination.totalCount }}</span>
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(expenseCategory,index) in expenseCategoryStore.expenseCategorys" :key="expenseCategory.id">
                                    <td>{{ (expenseCategoryStore.pagination.currentPage*expenseCategoryStore.limit)-expenseCategoryStore.limit + index +1 }}</td>
                                    
                                    <td>{{expenseCategory.name}}</td>
                                   
                                    <td>
                                        <router-link :to="{name:'expense.category.edit',params:{id:expenseCategory.id}}" class="btn btn-warning">
                                           
                                            <i class='bx bxs-edit'></i>
                                        </router-link>
                                        
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <v-pagination
                            v-model="expenseCategoryStore.pagination.currentPage"
                            :pages="expenseCategoryStore.pagination.lastPage"
                            :range-size="1"
                            active-color="#DCEDFF"
                            @update:modelValue="expenseCategoryStore.getExpenseCategorys(expenseCategoryStore.pagination.currentPage,expenseCategoryStore.limit);"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>