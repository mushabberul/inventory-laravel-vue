import config from "@/utils/config";
import { inventoryAxiosClient } from "@/utils/systemaxios";
import { defineStore } from "pinia";


export const useDashboardStore = defineStore('dashboard', {
    state: () => ({
        rowData: [],
        dashboardInfo: [],
        dashboard: null,
        swal: null,
        months: [],
        sales: [],
        expense: [],
        salary: [],
        revenue: [],
        notifications: [],
        errors: null,
        router: null,
      
    }),
    getters: {
        getUnReadNotificationCount(state){
            return state.notifications.length;
        }
    },
    actions: {
        async getAllDashboards() {
            try {
                const { data } = await inventoryAxiosClient.get('dashboard');
                console.log(data);
                this.rowData = data;
                this.dashboardInfo = data.data;
                this.dashboardInfo.stats.map((item) => {
                    this.months.push(item.month);
                    this.sales.push(item.sales);
                    this.expense.push(item.expense);
                    this.salary.push(item.salary);
                    let revenueAmount = parseFloat(item.sales) - (parseFloat(item.salary)+parseFloat(item.expense));
                    this.revenue.push(revenueAmount)
                })
                this.is_loading = false;
            } catch (error) {
                this.is_loading = false;
                this.errors = error.response.data;
                this.swal({
                    icon: 'error',
                    title: 'Something Went Wrong!',
                    text: this.errors.message
                })
            }
        },

            
        
    }
});