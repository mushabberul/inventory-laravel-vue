<script setup>
// All import 
import { useRouter,useRoute } from 'vue-router';
import { useExpenseCategoryStore } from '@/stores/expenseCategory';
import { useCategoryStore } from '@/stores/category';
import { useBrandStore } from '@/stores/brand';
import { useSupplierStore } from '@/stores/supplier';
import { reactive, inject,onMounted } from 'vue';
//All instance

const router = useRouter();
const expenseCategoryStore = useExpenseCategoryStore();
const categoryStore = useCategoryStore();
const supplierStore = useSupplierStore();
const brandStore = useBrandStore();
const swal = inject('$swal');
const route = useRoute();
//All variable
expenseCategoryStore.router = router;
expenseCategoryStore.swal = swal;


const schema = reactive({
    name: 'required'
});
//All methods
const onFileChange = (e) => {
    expenseCategoryStore.editForm.file = e.target.files[0];
};
const UpdateExpenseCategory = () => {
    expenseCategoryStore.updateExpenseCategory(expenseCategoryStore.editForm,route.params.id);
};
//hooks and computed

onMounted(()=>{
    expenseCategoryStore.getExpenseCategory(route.params.id)
  
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
                                <h4>ExpenseCategory Create</h4>
                                <RouterLink class="btn btn-success" :to="{ name: 'expense.category.index' }">
                                    <i class='bx bx-arrow-back'></i>
                                    ExpenseCategory Index
                                </RouterLink>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <vee-form :validation-schema="schema" enctype="multipart/form-data" @submit="UpdateExpenseCategory">
                                <div class="row">
                                    
                                    <div class="form-group col-md-12">
                                        <label for="name">Name</label>
                                        <vee-field type="text" v-model="expenseCategoryStore.editForm.name" name="name" class="form-control mb-3"
                                            id="name" placeholder="Enter expenseCategory name" />
                                        <ErrorMessage name="name" />
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