<script setup>
//All libery import
import config from "@/utils/config";
import { useSupplierStore } from '@/stores/supplier';
import { ref, reactive, onMounted,inject,watch } from 'vue';
import { useRouter } from 'vue-router';
import _ from 'lodash';

//All instance
const supplierStore = useSupplierStore();
const router = useRouter();
const swal = inject('$swal');

supplierStore.swal = swal;
//All veriable
const searchKeyword = ref('');
const base_url=config.base_url;

//All methods

const deleteSupplier = (supplier_id,supplier_name)=>{
    swal({
        title:"Are you sure delete?",
        text: supplier_name,
        icon:"warning",
        showCancelButton:true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result)=>{
        if(result.isConfirmed){
            supplierStore.deleteSupplier(supplier_id);
            supplierStore.getSuppliers(supplierStore.pagination.currentPage,supplierStore.limit);
        }
    });
}

//Hooks & Computed
onMounted(()=>{
    supplierStore.getSuppliers(supplierStore.pagination.currentPage,supplierStore.limit);
});

watch(
    searchKeyword,
    _.debounce((current,previous)=>{
 
    supplierStore.getSuppliers(supplierStore.pagination.currentPage,supplierStore.limit,current);
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
                                <h4>Supplier List</h4>
                                <router-link class="btn btn-success" :to="{ name: 'supplier.create' }">
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
                                    Total Count: <span class="">{{ supplierStore.pagination.totalCount }}</span>
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
                                    <th>Company Name</th>
                                    <th>File</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(supplier,index) in supplierStore.suppliers">
                                    <td>{{ (supplierStore.pagination.currentPage*supplierStore.limit)-supplierStore.limit + index +1 }}</td>
                                    <td>{{supplier.name}}</td>
                                    <td>{{supplier.email}}</td>
                                    <td>{{supplier.phone}}</td>
                                    <td>{{supplier.nid}}</td>
                                    <td>{{supplier.address}}</td>
                                    <td>{{supplier.company_name}}</td>
                                    <td>
                                        <template v-if="supplier.file != null">

                                            <a :href="base_url+supplier.file"><i class='bx bxs-download'></i></a>
                                        </template>
                                    </td>
                                   
                                    <td>
                                        <div class="form-check form-switch">
                                        <input @change="supplierStore.changeStatus(supplier.id)" class="form-check-input" type="checkbox" role="switch" :checked="supplier.status">
                                        </div>
                                    </td>
                                    <td>
                                        <router-link :to="{name:'supplier.edit',params:{id:supplier.id}}" class="btn btn-warning">
                                           
                                            <i class='bx bxs-edit'></i>
                                        </router-link>
                                        <a @click.prevent="deleteSupplier(supplier.id,supplier.name)" class="btn btn-danger ms-2">
                                            <i class="bx bxs-trash"></i>
                                        </a>
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <v-pagination
                            v-model="supplierStore.pagination.currentPage"
                            :pages="supplierStore.pagination.lastPage"
                            :range-size="1"
                            active-color="#DCEDFF"
                            @update:modelValue="supplierStore.getSuppliers(supplierStore.pagination.currentPage,supplierStore.limit);"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>