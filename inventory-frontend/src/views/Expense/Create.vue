<script setup>
// All import 
import { useRouter } from 'vue-router';
import { useExpenseStore } from '@/stores/expense';
import { useExpenseCategoryStore } from '@/stores/expenseCategory';
import { useStaffStore } from '@/stores/staff';

import { reactive, inject,onMounted } from 'vue';
//All instance

const router = useRouter();
const expenseStore = useExpenseStore();
const expenseCategoryStore = useExpenseCategoryStore();
const staffStore = useStaffStore();

const swal = inject('$swal');
//All variable
expenseStore.router = router;
expenseStore.swal = swal;
const formData = reactive({
    expense_category_id: null,
    staff_id: null,
    amount: null,
    note: null,
    file:null,
});

const schema = reactive({
    expense_category_id: 'required',
    staff_id: 'required',
    amount: 'required',
});
//All methods
const onFileChange = (e) => {
    formData.file = e.target.files[0];
};
const StoreExpense = () => {
    expenseStore.storeExpense(formData);
};
//hooks and computed

onMounted(()=>{
    expenseCategoryStore.getExpenseCategorys(expenseCategoryStore.pagination.currentPage,expenseCategoryStore.limit);
    staffStore.getStaffs(staffStore.pagination.currentPage,staffStore.limit);
    
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
                                <h4>Expense Create</h4>
                                <RouterLink class="btn btn-success" :to="{ name: 'expense.index' }">
                                    <i class='bx bx-arrow-back'></i>
                                    Expense Index
                                </RouterLink>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <vee-form :validation-schema="schema" enctype="multipart/form-data" @submit="StoreExpense">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="name">Expense Category</label>
                                        <vee-field as="select" v-model="formData.expense_category_id" name="expense_category_id" class="form-control mb-3"
                                            id="expense_category_id">
                                            <option value="">Select a Staff</option>
                                            <option :value="expenseCategory.id" v-for="(expenseCategory,index) in expenseCategoryStore.expenseCategorys">{{expenseCategory.name}}</option>
                                        </vee-field>
                                        <ErrorMessage name="expense_category_id" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">Staff Name</label>
                                        <vee-field as="select" v-model="formData.staff_id" name="staff_id" class="form-control mb-3"
                                            id="staff_id">
                                            <option value="">Select a Staff</option>
                                            <option :value="staff.id" v-for="(staff,index) in staffStore.staffs" :key="staff.id">{{staff.name}}</option>
                                        </vee-field>
                                        <ErrorMessage name="staff_id" />
                                    </div>
                                    
                                    <div class="form-group col-md-4">
                                        <label for="name">Amount</label>
                                        <vee-field type="text" v-model="formData.amount" name="amount" class="form-control mb-3"
                                            id="amount" placeholder="Enter expense amount" />
                                        <ErrorMessage name="amount" />
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="name">Note</label>
                                        <textarea v-model="formData.note" name="note" class="form-control mb-3"
                                            id="note" placeholder="Enter expense note" >
                                        </textarea>
                                        <ErrorMessage name="note" />
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="file">File</label>
                                        <vee-field name="file" @change="onFileChange" type="file" class="form-control mb-3"
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