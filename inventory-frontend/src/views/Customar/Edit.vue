<script setup>
// All import 
import { useRouter,useRoute } from 'vue-router';
import { useCustomarStore } from '@/stores/customar';
import { reactive, inject,onMounted } from 'vue';
//All instance

const router = useRouter();
const customarStore = useCustomarStore();
const swal = inject('$swal');
const route = useRoute();
//All variable
customarStore.router = router;
customarStore.swal = swal;


const schema = reactive({
    name: 'required'
});
//All methods

const UpdateCustomar = () => {
    customarStore.updateCustomar(customarStore.editForm,route.params.id);
};
//hooks and computed

onMounted(()=>{
    customarStore.getCustomar(route.params.id)
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
                                <h4>Customar Create</h4>
                                <RouterLink class="btn btn-success" :to="{ name: 'customar.index' }">
                                    <i class='bx bx-arrow-back'></i>
                                    Customar Index
                                </RouterLink>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <vee-form :validation-schema="schema" enctype="multipart/form-data" @submit="UpdateCustomar">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <vee-field type="text" v-model="customarStore.editForm.name" name="name" class="form-control"
                                            id="name" placeholder="Enter customar name" />
                                        <ErrorMessage name="name" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="code">Email</label>
                                        <vee-field type="text" v-model="customarStore.editForm.email" name="email" class="form-control"
                                            id="email" placeholder="Enter customar email" />
                                        <ErrorMessage name="email" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="code">Phone</label>
                                        <vee-field type="text" v-model="customarStore.editForm.phone" name="phone" class="form-control"
                                            id="phone" placeholder="Enter customar phone" />
                                        <ErrorMessage name="phone" />
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