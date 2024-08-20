<script setup>
// All import 
import { useRouter,useRoute } from 'vue-router';
import { useSupplierStore } from '@/stores/supplier';
import { reactive, inject,onMounted } from 'vue';
//All instance

const router = useRouter();
const supplierStore = useSupplierStore();
const swal = inject('$swal');
const route = useRoute();
//All variable
supplierStore.router = router;
supplierStore.swal = swal;


const schema = reactive({
    name: 'required'
});
//All methods
const onFileChange = (e) => {
    supplierStore.editForm.file = e.target.files[0];
};
const UpdateSupplier = () => {
    supplierStore.updateSupplier(supplierStore.editForm,route.params.id);
};
//hooks and computed

onMounted(()=>{
    supplierStore.getSupplier(route.params.id)
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
                                <h4>Supplier Create</h4>
                                <RouterLink class="btn btn-success" :to="{ name: 'supplier.index' }">
                                    <i class='bx bx-arrow-back'></i>
                                    Supplier Index
                                </RouterLink>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <vee-form :validation-schema="schema" enctype="multipart/form-data" @submit="UpdateSupplier">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <vee-field type="text" v-model="supplierStore.editForm.name" name="name" class="form-control"
                                            id="name" placeholder="Enter supplier name" />
                                        <ErrorMessage name="name" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="code">Email</label>
                                        <vee-field type="text" v-model="supplierStore.editForm.email" name="email" class="form-control"
                                            id="email" placeholder="Enter supplier email" />
                                        <ErrorMessage name="email" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="code">Phone</label>
                                        <vee-field type="text" v-model="supplierStore.editForm.phone" name="phone" class="form-control"
                                            id="phone" placeholder="Enter supplier phone" />
                                        <ErrorMessage name="phone" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="code">NID</label>
                                        <vee-field type="text" v-model="supplierStore.editForm.nid" name="nid" class="form-control"
                                            id="nid" placeholder="Enter supplier nid" />
                                        <ErrorMessage name="nid" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="code">Address</label>
                                        <vee-field type="text" v-model="supplierStore.editForm.address" name="address" class="form-control"
                                            id="address" placeholder="Enter supplier address" />
                                        <ErrorMessage name="address" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="code">Company Name</label>
                                        <vee-field type="text" v-model="supplierStore.editForm.company_name" name="company_name" class="form-control"
                                            id="company_name" placeholder="Enter supplier company name" />
                                        <ErrorMessage name="company_name" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="file">File</label>
                                        <vee-field name="file" @change="onFileChange" type="file" class="form-control"
                                            id="file" />
                                        <ErrorMessage name="file" />
                                    </div>
                                </div>
                                <div class="form-group mt-2">

                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </vee-form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>