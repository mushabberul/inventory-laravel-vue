<script setup>
//All libery import
import { useOrderStore } from '@/stores/order';
import { ref, reactive, onMounted,inject,watch } from 'vue';
import { useRouter } from 'vue-router';
import _ from 'lodash';

//All instance
const orderStore = useOrderStore();
const router = useRouter();
const swal = inject('$swal');

orderStore.swal = swal;
//All veriable
const searchKeyword = ref('');

//All methods


//Hooks & Computed
onMounted(()=>{
    orderStore.getOrders(orderStore.pagination.currentPage,orderStore.limit);
});

watch(
    searchKeyword,
    _.debounce((current,previous)=>{
 
    orderStore.getOrders(orderStore.pagination.currentPage,orderStore.limit,current);
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
                                <h4>Order List</h4>
                                
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
                                    Total Count: <span class="">{{ orderStore.pagination.totalCount }}</span>
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
                                    <th>TRX ID</th>
                                    <th>Customer Name</th>
                                    <th>Pay Amount</th>
                                    <th>Due Amount</th>
                                    <th>Sub Total</th>
                                    <th>Discount</th>
                                    <th>Total</th>
                                    <th>Payment Method</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(order,index) in orderStore.orders">
                                    <td>{{ (orderStore.pagination.currentPage*orderStore.limit)-orderStore.limit + index +1 }}</td>
                                    <td>{{order.transaction_number}}</td>
                                    
                                    <td>{{order.customer?.name}}</td>
                                    <td>{{order.pay_amount}}</td>
                                    <td>{{order.due_amount}}</td>
                                    <td>{{order.subtotal}}</td>
                                    <td>{{order.discount}}</td>
                                    <td>{{order.total}}</td>
                                    <td>{{order.payment_method}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <v-pagination
                            v-model="orderStore.pagination.currentPage"
                            :pages="orderStore.pagination.lastPage"
                            :range-size="1"
                            active-color="#DCEDFF"
                            @update:modelValue="orderStore.getOrders(orderStore.pagination.currentPage,orderStore.limit);"
                        />
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>