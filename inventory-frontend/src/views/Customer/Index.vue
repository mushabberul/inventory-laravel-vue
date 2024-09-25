<script setup>
//All libery import
import config from "@/utils/config";
import { useCustomerStore } from '@/stores/customer';
import { ref, reactive, onMounted,inject,watch } from 'vue';
import { useRouter } from 'vue-router';
import _ from 'lodash';

//All instance
const customerStore = useCustomerStore();
const router = useRouter();
const swal = inject('$swal');

customerStore.swal = swal;
//All veriable
const searchKeyword = ref('');
const base_url=config.base_url;

//All methods

const deleteCustomer = (customer_id,customer_name)=>{
    swal({
        title:"Are you sure delete?",
        text: customer_name,
        icon:"warning",
        showCancelButton:true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result)=>{
        if(result.isConfirmed){
            customerStore.deleteCustomer(customer_id);
            customerStore.getCustomers(customerStore.pagination.currentPage,customerStore.limit);
        }
    });
}

//Hooks & Computed
onMounted(()=>{
    customerStore.getCustomers(customerStore.pagination.currentPage,customerStore.limit);
});

watch(
    searchKeyword,
    _.debounce((current,previous)=>{
 
    customerStore.getCustomers(customerStore.pagination.currentPage,customerStore.limit,current);
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
                                <h4>Customer List</h4>
                                <router-link class="btn btn-success" :to="{ name: 'customer.create' }">
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
                                    Total Count: <span class="">{{ customerStore.pagination.totalCount }}</span>
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
                                <tr v-for="(customer,index) in customerStore.customers">
                                    <td>{{ (customerStore.pagination.currentPage*customerStore.limit)-customerStore.limit + index +1 }}</td>
                                    <td>{{customer.name}}</td>
                                    <td>{{customer.email}}</td>
                                    <td>{{customer.phone}}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                        <input @change="customerStore.changeStatus(customer.id)" class="form-check-input" type="checkbox" role="switch" :checked="customer.status">
                                        </div>
                                    </td>
                                    <td>
                                        <router-link :to="{name:'customer.edit',params:{id:customer.id}}" class="btn btn-warning">
                                           
                                            <i class='bx bxs-edit'></i>
                                        </router-link>
                                        <a @click.prevent="deleteCustomer(customer.id,customer.name)" class="btn btn-danger ms-2">
                                            <i class="bx bxs-trash"></i>
                                        </a>
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <v-pagination
                            v-model="customerStore.pagination.currentPage"
                            :pages="customerStore.pagination.lastPage"
                            :range-size="1"
                            active-color="#DCEDFF"
                            @update:modelValue="customerStore.getCustomers(customerStore.pagination.currentPage,customerStore.limit);"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>