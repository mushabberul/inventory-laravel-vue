<script setup>
// All import 
import { useRouter } from 'vue-router';
import { useCustomerStore } from '@/stores/customer';
import { reactive, inject } from 'vue';
//All instance

const router = useRouter();
const customerStore = useCustomerStore();
const swal = inject('$swal');
//All variable
customerStore.router = router;
customerStore.swal = swal;
const formData = reactive({
    name: null,
    phone: null,
    email:null,
   
});

const schema = reactive({
    name: 'required',
    email: 'required',
});
//All methods

const StoreCustomer = () => {
    customerStore.storeCustomer(formData);
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
                                <h4>Customer Create</h4>
                                <RouterLink class="btn btn-success" :to="{ name: 'customer.index' }">
                                    <i class='bx bx-arrow-back'></i>
                                    Customer Index
                                </RouterLink>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <vee-form :validation-schema="schema" enctype="multipart/form-data" @submit="StoreCustomer">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <vee-field type="text" v-model="formData.name" name="name" class="form-control"
                                            id="name" placeholder="Enter customer name" />
                                        <ErrorMessage name="name" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">Email</label>
                                        <vee-field type="text" v-model="formData.email" name="email" class="form-control"
                                            id="email" placeholder="Enter customer email" />
                                        <ErrorMessage name="email" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">Phone</label>
                                        <vee-field type="text" v-model="formData.phone" name="phone" class="form-control"
                                            id="phone" placeholder="Enter customer phone" />
                                        <ErrorMessage name="phone" />
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