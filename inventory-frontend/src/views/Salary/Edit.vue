<script setup>
// All import 
import { useRouter,useRoute } from 'vue-router';
import { useSalaryStore } from '@/stores/salary';
import { useStaffStore } from '@/stores/staff';
import { reactive, inject,onMounted } from 'vue';
import { getYears,getMonths } from '@/helpers/helper';
//All instance

const router = useRouter();
const salaryStore = useSalaryStore();
const staffStore = useStaffStore();

const swal = inject('$swal');
const route = useRoute();
//All variable
salaryStore.router = router;
salaryStore.swal = swal;


const schema = reactive({
    staff_id: 'required',
    date: 'required',
    month: 'required',
    year: 'required',
    amount: 'required',
    type: 'required',
});
//All methods

const UpdateSalary = () => {
    salaryStore.updateSalary(salaryStore.editForm,route.params.id);
};
//hooks and computed

onMounted(()=>{
    salaryStore.getSalary(route.params.id)
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
                                <h4>Salary Create</h4>
                                <RouterLink class="btn btn-success" :to="{ name: 'salary.index' }">
                                    <i class='bx bx-arrow-back'></i>
                                    Salary Index
                                </RouterLink>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <vee-form :validation-schema="schema" enctype="multipart/form-data" @submit="UpdateSalary">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Staff Name</label>
                                        <vee-field as="select" v-model="salaryStore.editForm.staff_id" name="staff_id" class="form-control mb-3"
                                            id="staff_id">
                                            <option value="">Select a Staff</option>
                                            <option :value="staff.id" v-for="(staff,index) in staffStore.staffs">{{staff.name}}</option>
                                        </vee-field>
                                        <ErrorMessage name="staff_id" />
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="name">Date</label>
                                        <vee-field type="date" v-model="salaryStore.editForm.date" name="date" class="form-control mb-3"
                                            id="date" placeholder="Enter salary name" />
                                        <ErrorMessage name="date" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">Months</label>
                                        <vee-field as="select" v-model="salaryStore.editForm.month" name="month" class="form-control mb-3"
                                            id="month">
                                            <option value="">Select a Months</option>
                                            <option :value="month" v-for="(month,index) in getMonths()">{{month}}</option>
                                        </vee-field>
                                        <ErrorMessage name="month" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">Year</label>
                                        <vee-field as="select" v-model="salaryStore.editForm.year" name="year" class="form-control mb-3"
                                            id="year">
                                            <option value="">Select a Years</option>
                                            <option :value="year" v-for="(year,index) in getYears(2010)">{{year}}</option>
                                        </vee-field>
                                        <ErrorMessage name="year" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">Amount</label>
                                        <vee-field type="number" v-model="salaryStore.editForm.amount" name="amount" class="form-control mb-3"
                                            id="amount" placeholder="Enter Amount" />
                                        <ErrorMessage name="amount" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="name">Type</label>
                                        <vee-field as="select" v-model="salaryStore.editForm.type" name="type" class="form-control mb-3"
                                            id="type">
                                            <option value="">Select a Years</option>
                                            <option value="regular">Regular</option>
                                            <option value="advance">Advance</option>
                                            <option value="late">Late</option>
                                         
                                        </vee-field>
                                        <ErrorMessage name="type" />
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