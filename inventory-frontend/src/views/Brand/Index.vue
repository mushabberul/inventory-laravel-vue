<script setup>
//All libery import
import { useBrandStore } from '@/stores/brand';
import { ref, reactive, onMounted,inject,watch } from 'vue';
import { useRouter } from 'vue-router';
import _ from 'lodash';

//All instance
const brandStore = useBrandStore();
const router = useRouter();
const swal = inject('$swal');

brandStore.swal = swal;
//All veriable
const searchKeyword = ref('');
const base_url='http://127.0.0.1:8000';

//All methods

const deleteBrand = (brand_id,brand_name)=>{
    swal({
        title:"Are you sure delete?",
        text: brand_name,
        icon:"warning",
        showCancelButton:true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result)=>{
        if(result.isConfirmed){
            brandStore.deleteBrand(brand_id);
            brandStore.getBrands(brandStore.pagination.currentPage,brandStore.limit);
        }
    });
}

//Hooks & Computed
onMounted(()=>{
    brandStore.getBrands(brandStore.pagination.currentPage,brandStore.limit);
});

watch(
    searchKeyword,
    _.debounce((current,previous)=>{
 
    brandStore.getBrands(brandStore.pagination.currentPage,brandStore.limit,current);
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
                                <h4>Brand List</h4>
                                <router-link class="btn btn-success" :to="{ name: 'brand.create' }">
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
                                    Total Count: <span class="">{{ brandStore.pagination.totalCount }}</span>
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
                                    <th>File</th>
                                    <th>code</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(brand,index) in brandStore.brands">
                                    <td>{{ (brandStore.pagination.currentPage*brandStore.limit)-brandStore.limit + index +1 }}</td>
                                    <td>{{brand.name}}</td>
                                    <td>
                                        <template v-if="brand.file != null">

                                            <img width="100px" :src="base_url+brand.file" alt="Brand File">
                                        </template>
                                    </td>
                                    <td>{{brand.code}}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                        <input @change="brandStore.changeStatus(brand.id)" class="form-check-input" type="checkbox" role="switch" :checked="brand.status">
                                        </div>
                                    </td>
                                    <td>
                                        <router-link :to="{name:'brand.edit',params:{id:brand.id}}" class="btn btn-warning">
                                           
                                            <i class='bx bxs-edit'></i>
                                        </router-link>
                                        <a @click.prevent="deleteBrand(brand.id,brand.name)" class="btn btn-danger ms-2">
                                            <i class="bx bxs-trash"></i>
                                        </a>
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <v-pagination
                            v-model="brandStore.pagination.currentPage"
                            :pages="brandStore.pagination.lastPage"
                            :range-size="1"
                            active-color="#DCEDFF"
                            @update:modelValue="brandStore.getBrands(brandStore.pagination.currentPage,brandStore.limit);"
                        />
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>