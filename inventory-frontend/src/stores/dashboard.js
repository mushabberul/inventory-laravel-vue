import config from "@/utils/config";
import { inventoryAxiosClient } from "@/utils/systemaxios";
import { defineStore } from "pinia";


export const useDashboardStore = defineStore('dashboard', {
    state: () => ({
        rowData: [],
        dashboards: [],
        dashboard: null,
        swal: null,
        errors: null,
        router: null,
      
    }),
    getters: {},
    actions: {
        async getAllDashboards() {
            try {
                const { data } = await inventoryAxiosClient.get('dashboard');
                console.log(data);
                this.rowData = data;
                this.dashboards = data.data;
                this.pagination.totalCount = data.metadata.count;

            } catch (error) {
                console.log(error);
                this.swal({
                    icon: 'error',
                    title: 'Something Went Wrong!',
                    text: this.errors.message
                });
                this.errors = error.response.data;
            }
        },
      
    }
});