<script setup>
// All import 
import { useRouter } from 'vue-router';
import { useSupplierStore } from '@/stores/supplier';
import { reactive, inject } from 'vue';
//All instance

const router = useRouter();
const supplierStore = useSupplierStore();
const swal = inject('$swal');
//All variable
supplierStore.router = router;
supplierStore.swal = swal;
const formData = reactive({
    name: null,
    phone: null,
    file: null,
    email:null,
    nid:null,
    address:null,
    company_name:null,
});

const schema = reactive({
    name: 'required',
    email: 'required',
});
//All methods
const onFileChange = (e) => {
    formData.file = e.target.files[0];
};
const StoreSupplier = () => {
    supplierStore.storeSupplier(formData);
};
//hooks and computed
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

                            <vee-form :validation-schema="schema" enctype="multipart/form-data" @submit="StoreSupplier">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <vee-field type="text" v-model="formData.name" name="name" class="form-control"
                                            id="name" placeholder="Enter supplier name" />
                                        <ErrorMessage name="name" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">Email</label>
                                        <vee-field type="text" v-model="formData.email" name="email" class="form-control"
                                            id="email" placeholder="Enter supplier email" />
                                        <ErrorMessage name="email" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">Phone</label>
                                        <vee-field type="text" v-model="formData.phone" name="phone" class="form-control"
                                            id="phone" placeholder="Enter supplier phone" />
                                        <ErrorMessage name="phone" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">NID</label>
                                        <vee-field type="text" v-model="formData.nid" name="nid" class="form-control"
                                            id="nid" placeholder="Enter supplier nid" />
                                        <ErrorMessage name="nid" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">Address</label>
                                        <vee-field type="text" v-model="formData.address" name="address" class="form-control"
                                            id="address" placeholder="Enter supplier address" />
                                        <ErrorMessage name="address" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">Company Name</label>
                                        <vee-field type="text" v-model="formData.company_name" name="company_name" class="form-control"
                                            id="company_name" placeholder="Enter supplier company_name" />
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