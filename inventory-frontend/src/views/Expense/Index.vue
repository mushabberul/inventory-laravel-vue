<script setup>
//All libery import
import config from "@/utils/config";
import { useExpenseStore } from '@/stores/expense';
import { ref, reactive, onMounted,inject,watch } from 'vue';
import { useRouter } from 'vue-router';
import _ from 'lodash';

//All instance
const expenseStore = useExpenseStore();
const router = useRouter();
const swal = inject('$swal');

expenseStore.swal = swal;
//All veriable
const searchKeyword = ref('');


//All methods



//Hooks & Computed
onMounted(()=>{
    expenseStore.getExpenses(expenseStore.pagination.currentPage,expenseStore.limit);
});

watch(
    searchKeyword,
    _.debounce((current,previous)=>{
    expenseStore.getExpenses(expenseStore.pagination.currentPage,expenseStore.limit,current);
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
                                <h4>Expense List</h4>
                                <router-link class="btn btn-success" :to="{ name: 'expense.create' }">
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
                                    Total Count: <span class="">{{ expenseStore.pagination.totalCount }}</span>
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
                                    <th>Expense Cateogry</th>
                                    <th>Staff Name/Phone</th>
                                    <th>Amount</th>
                                    <th>note</th>                                    
                                    <th>File</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(expense,index) in expenseStore.expenses" :key="expense.id">
                                    <td>{{ (expenseStore.pagination.currentPage*expenseStore.limit)-expenseStore.limit + index +1 }}</td>
                                    
                                    <td>{{expense.expense_category_id}}</td>
                                    <td>{{expense.staff_id}}</td>
                                    <td>{{expense.amount}}</td>
                                    <td>{{expense.note}}</td>
                                   
                                    <td>
                                        <template v-if="expense.file">
                                            <img width="80" height="80" :src="config.base_url+expense.file" alt="">
                                        </template>
                                    </td>
                                   
                                  
                                    <td>
                                        <router-link :to="{name:'expense.edit',params:{id:expense.id}}" class="btn btn-warning">
                                           
                                            <i class='bx bxs-edit'></i>
                                        </router-link>
                                        
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <v-pagination
                            v-model="expenseStore.pagination.currentPage"
                            :pages="expenseStore.pagination.lastPage"
                            :range-size="1"
                            active-color="#DCEDFF"
                            @update:modelValue="expenseStore.getExpenses(expenseStore.pagination.currentPage,expenseStore.limit);"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>