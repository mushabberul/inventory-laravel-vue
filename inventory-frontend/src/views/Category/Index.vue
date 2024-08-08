<script setup>
//All libery import
import { useCategoryStore } from '@/stores/category';
import { ref, reactive, onMounted } from 'vue';
import { useRouter } from 'vue-router';

//All instance
const categoryStore = useCategoryStore();
const router = useRouter();
//All veriable

//All methods

//Hooks & Computed
onMounted(()=>{
    categoryStore.getAllCategories();
});
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
                                <router-link :to="{ name: 'category.create' }">Create New</router-link>
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
                                    <span>Total Count: 12</span>
                                </div>
                                <div class="col-md-4">
                                    <input type="search" name="" placeholder="Search ..." class="form-control" id="">
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
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2</td>
                                    <td>Hellow</td>
                                    <td>Image Header</td>
                                    <td>Active</td>
                                    <td>edit</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>