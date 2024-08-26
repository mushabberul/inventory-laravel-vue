<script setup>
//All libery import
import config from "@/utils/config";
import { useProductStore } from '@/stores/product';
import { ref, reactive, onMounted,inject,watch } from 'vue';
import { useRouter } from 'vue-router';
import _ from 'lodash';

//All instance
const productStore = useProductStore();
const router = useRouter();
const swal = inject('$swal');

productStore.swal = swal;
//All veriable
const searchKeyword = ref('');


//All methods

const deleteProduct = (product_id,product_name)=>{
    swal({
        title:"Are you sure delete?",
        text: product_name,
        icon:"warning",
        showCancelButton:true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result)=>{
        if(result.isConfirmed){
            productStore.deleteProduct(product_id);
            productStore.getProducts(productStore.pagination.currentPage,productStore.limit);
        }
    });
}

//Hooks & Computed
onMounted(()=>{
    productStore.getProducts(productStore.pagination.currentPage,productStore.limit);
});

watch(
    searchKeyword,
    _.debounce((current,previous)=>{
    productStore.getProducts(productStore.pagination.currentPage,productStore.limit,current);
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
                                <h4>Product List</h4>
                                <router-link class="btn btn-success" :to="{ name: 'product.create' }">
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
                                    Total Count: <span class="">{{ productStore.pagination.totalCount }}</span>
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
                                    <th>BarCode</th>
                                    <th>QrCode</th>
                                    <th>Serial</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Supplier</th>
                                    <th>Original Price</th>
                                    <th>Sell Price</th>
                                    <th>Stock</th>
                                    <th>Description</th>
                                    <th>Code</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(product,index) in productStore.products" :key="product.id">
                                    <td>{{ (productStore.pagination.currentPage*productStore.limit)-productStore.limit + index +1 }}</td>
                                    <td>
                                        <div v-if="product.barcode">
                                            <img width="80" height="80" :src="config.base_url+product.barcode" alt="BarCode">
                                        </div>
                                    </td>
                                    <td>
                                        <div v-if="product.qrcode">
                                            <img width="80" height="80" :src="config.base_url+product.qrcode" alt="QrCode">
                                        </div>
                                    </td>
                                    <td>{{product.name}}</td>
                                    <td>{{product.category.name}}</td>
                                    <td>{{product.brand.name}}</td>
                                    <td>{{product.supplier.name}}</td>
                                    <td>{{product.original_price}}</td>
                                    <td>{{product.sell_price}}</td>
                                    <td>{{product.stock}}</td>
                                    <td>{{product.description}}</td>
                                    <td>{{product.code}}</td>
                                    <td>
                                        <template v-if="product.file">
                                            <img width="80" height="80" :src="config.base_url+product.file" alt="">
                                        </template>
                                    </td>
                                   
                                    <td>
                                        <div class="form-check form-switch">
                                            <input @change="productStore.changeStatus(product.id)" class="form-check-input" type="checkbox" role="switch" :checked="product.status">
                                        </div>
                                    </td>
                                    <td>
                                        <router-link :to="{name:'product.edit',params:{id:product.id}}" class="btn btn-warning">
                                           
                                            <i class='bx bxs-edit'></i>
                                        </router-link>
                                        <a @click.prevent="deleteProduct(product.id,product.name)" class="btn btn-danger ms-2">
                                            <i class="bx bxs-trash"></i>
                                        </a>
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <v-pagination
                            v-model="productStore.pagination.currentPage"
                            :pages="productStore.pagination.lastPage"
                            :range-size="1"
                            active-color="#DCEDFF"
                            @update:modelValue="productStore.getProducts(productStore.pagination.currentPage,productStore.limit);"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>