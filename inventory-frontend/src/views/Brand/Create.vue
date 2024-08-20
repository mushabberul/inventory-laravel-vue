<script setup>
// All import 
import { useRouter } from 'vue-router';
import { useBrandStore } from '@/stores/brand';
import { reactive, inject } from 'vue';
//All instance

const router = useRouter();
const brandStore = useBrandStore();
const swal = inject('$swal');
//All variable
brandStore.router = router;
brandStore.swal = swal;
const formData = reactive({
    name: null,
    file: null,
    code:null
});

const schema = reactive({
    name: 'required'
});
//All methods
const onFileChange = (e) => {
    formData.file = e.target.files[0];
};
const StoreBrand = () => {
    brandStore.storeBrand(formData);
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
                                <h4>Brand Create</h4>
                                <RouterLink class="btn btn-success" :to="{ name: 'brand.index' }">
                                    <i class='bx bx-arrow-back'></i>
                                    Brand Index
                                </RouterLink>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <vee-form :validation-schema="schema" enctype="multipart/form-data" @submit="StoreBrand">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <vee-field type="text" v-model="formData.name" name="name" class="form-control"
                                            id="name" placeholder="Enter brand name" />
                                        <ErrorMessage name="name" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">code</label>
                                        <vee-field type="text" v-model="formData.code" name="code" class="form-control"
                                            id="code" placeholder="Enter brand code" />
                                        <ErrorMessage name="code" />
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="file">Image</label>
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