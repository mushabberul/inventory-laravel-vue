<script setup>
import ShortDashboard from '@/components/ShortDashboard.vue';
import chart from '../components/chart.vue';
import { useDashboardStore } from '@/stores/dashboard';
const dashboardStore = useDashboardStore();
</script>
<template>
    <ShortDashboard />
    <div class="page-content">
        <div class="container-fluid">
            <!-- Content here -->

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <chart title="Expense Chart" :labels="dashboardStore.months" :data="dashboardStore.expense"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <chart title="Sales Chart" :labels="dashboardStore.months" :data="dashboardStore.sales"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <chart title="Salary Chart" :labels="dashboardStore.months" :data="dashboardStore.salary"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <chart title="Revenue Chart" :labels="dashboardStore.months" :data="dashboardStore.revenue"/>
                        </div>
                    </div>
               
            </div>

        </div>
        </div>
    </div>
</template>