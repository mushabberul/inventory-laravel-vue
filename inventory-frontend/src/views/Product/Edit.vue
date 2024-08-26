<script setup>
// All import 
import { useRouter,useRoute } from 'vue-router';
import { useProductStore } from '@/stores/product';
import { useCategoryStore } from '@/stores/category';
import { useBrandStore } from '@/stores/brand';
import { useSupplierStore } from '@/stores/supplier';
import { reactive, inject,onMounted } from 'vue';
//All instance

const router = useRouter();
const productStore = useProductStore();
const categoryStore = useCategoryStore();
const supplierStore = useSupplierStore();
const brandStore = useBrandStore();
const swal = inject('$swal');
const route = useRoute();
//All variable
productStore.router = router;
productStore.swal = swal;


const schema = reactive({
    name: 'required'
});
//All methods
const onFileChange = (e) => {
    productStore.editForm.file = e.target.files[0];
};
const UpdateProduct = () => {
    productStore.updateProduct(productStore.editForm,route.params.id);
};
//hooks and computed

onMounted(()=>{
    productStore.getProduct(route.params.id)
    categoryStore.getCategories(categoryStore.pagination.currentPage,categoryStore.limit);
    supplierStore.getSuppliers(supplierStore.pagination.currentPage,supplierStore.limit);
    brandStore.getBrands(brandStore.pagination.currentPage,brandStore.limit);
});
</script>

<template>
    <div class="page-content">
        <div class="container-fluid">
            <!-- Content here -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4>Product Create</h4>
                                <RouterLink class="btn btn-success" :to="{ name: 'product.index' }">
                                    <i class='bx bx-arrow-back'></i>
                                    Product Index
                                </RouterLink>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <vee-form :validation-schema="schema" enctype="multipart/form-data" @submit="UpdateProduct">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="name">Category Name</label>
                                        <vee-field as="select" v-model="productStore.editForm.category_id" name="category_id" class="form-control mb-3"
                                            id="category_id">
                                            <option value="">Select a Category</option>
                                            <option :value="category.id" v-for="(category,index) in categoryStore.categories">{{category.name}}</option>
                                        </vee-field>
                                        <ErrorMessage name="category_id" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">Brand Name</label>
                                        <vee-field as="select" v-model="productStore.editForm.brand_id" name="brand_id" class="form-control mb-3"
                                            id="brand_id">
                                            <option value="">Select a Brand</option>
                                            <option :value="brand.id" v-for="(brand,index) in brandStore.brands">{{brand.name}}</option>
                                        </vee-field>
                                        <ErrorMessage name="category_id" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">Supplier Name</label>
                                        <vee-field as="select" v-model="productStore.editForm.supplier_id" name="supplier_id" class="form-control mb-3"
                                            id="supplier_id">
                                            <option value="">Select a Supplier</option>
                                            <option :value="supplier.id" v-for="(supplier,index) in supplierStore.suppliers">{{supplier.name}}</option>
                                        </vee-field>
                                        <ErrorMessage name="category_id" />
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="name">Name</label>
                                        <vee-field type="text" v-model="productStore.editForm.name" name="name" class="form-control mb-3"
                                            id="name" placeholder="Enter product name" />
                                        <ErrorMessage name="name" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">Code</label>
                                        <vee-field type="text" v-model="productStore.editForm.code" name="code" class="form-control mb-3"
                                            id="code" placeholder="Enter product code" />
                                        <ErrorMessage name="code" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">Original Price</label>
                                        <vee-field type="number" v-model="productStore.editForm.original_price" name="original_price" class="form-control mb-3"
                                            id="original_price" placeholder="Enter Original Price" />
                                        <ErrorMessage name="original_price" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">Sell Price</label>
                                        <vee-field type="number" v-model="productStore.editForm.sell_price" name="sell_price" class="form-control mb-3"
                                            id="sell_price" placeholder="Enter Sell Price" />
                                        <ErrorMessage name="sell_price" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">Stock</label>
                                        <vee-field type="number" v-model="productStore.editForm.stock" name="stock" class="form-control mb-3"
                                            id="stock" placeholder="Enter Stock" />
                                        <ErrorMessage name="stock" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="file">File</label>
                                        <vee-field name="file" @change="onFileChange" type="file" class="form-control mb-3"
                                            id="file" />
                                        <ErrorMessage name="file" />
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="name">Product Description</label>
                                        <textarea v-model="productStore.editForm.description" name="description" rows="5" class="form-control mb-3"
                                            id="description" placeholder="Enter Description">
                                        </textarea>
                                        <ErrorMessage name="description" />
                                    </div>
                                    
                                   
                                </div>
                                <div class="form-group mt-2">

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </vee-form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>