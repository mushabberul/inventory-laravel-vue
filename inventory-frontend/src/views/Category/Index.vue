<script setup>
//All libery import
import { useCategoryStore } from '@/stores/category';
import { ref, reactive, onMounted,inject,watch } from 'vue';
import { useRouter } from 'vue-router';
import _ from 'lodash';

//All instance
const categoryStore = useCategoryStore();
const router = useRouter();
const swal = inject('$swal');

categoryStore.swal = swal;
//All veriable
const searchKeyword = ref('');

//All methods

const deleteCategory = (category_id,category_name)=>{
    swal({
        title:"Are you sure delete?",
        text: category_name,
        icon:"warning",
        showCancelButton:true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result)=>{
        if(result.isConfirmed){
            categoryStore.deleteCategory(category_id);
            categoryStore.getCategories(categoryStore.pagination.currentPage,categoryStore.limit);
        }
    });
}

//Hooks & Computed
onMounted(()=>{
    categoryStore.getCategories(categoryStore.pagination.currentPage,categoryStore.limit);
});

watch(
    searchKeyword,
    _.debounce((current,previous)=>{
 
    categoryStore.getCategories(categoryStore.pagination.currentPage,categoryStore.limit,current);
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
                                <h4>Category List</h4>
                                <router-link class="btn btn-success" :to="{ name: 'category.create' }">
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
                                    Total Count: <span class="">{{ categoryStore.pagination.totalCount }}</span>
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(category,index) in categoryStore.categories">
                                    <td>{{ (categoryStore.pagination.currentPage*categoryStore.limit)-categoryStore.limit + index +1 }}</td>
                                    <td>{{category.name}}</td>
                                    <td>{{category.image}}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                        <input @change="categoryStore.changeStatus(category.id)" class="form-check-input" type="checkbox" role="switch" :checked="category.status">
                                        </div>
                                    </td>
                                    <td>
                                        <router-link :to="{name:'category.edit',params:{id:category.id}}" class="btn btn-warning">
                                           
                                            <i class='bx bxs-edit'></i>
                                        </router-link>
                                        <a @click.prevent="deleteCategory(category.id,category.name)" class="btn btn-danger ms-2">
                                            <i class="bx bxs-trash"></i>
                                        </a>
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <v-pagination
                            v-model="categoryStore.pagination.currentPage"
                            :pages="categoryStore.pagination.lastPage"
                            :range-size="1"
                            active-color="#DCEDFF"
                            @update:modelValue="categoryStore.getCategories(categoryStore.pagination.currentPage,categoryStore.limit);"
                        />
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>