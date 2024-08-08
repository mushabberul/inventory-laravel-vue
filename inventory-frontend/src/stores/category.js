import config from "@/utils/config";
import { inventoryAxiosClient } from "@/utils/systemaxios";
import { defineStore } from "pinia";


export const useCategoryStore = defineStore('category', {
    state: () => ({
        rowData: [],
        categories: [],
        category: null,
        pagination: {
            currentPage: 1,
            lastPage: 0,
            totalCount: 0
        },
        dataLimit: config.defaultDataLimit,
    }),
    getters: {},
    actions: {
        async getAllCategories() {
            try {
                const { data } = await inventoryAxiosClient.get('/categories');
                this.categories = data;
            } catch (errors) {
                console.log(errors);
            }

        },
        async getCategories() {

        },
        async getCategory() { },
        async storeCategory() { },
        async updateCategory() { },
        async deleteCategory() { },
        async changeStatus() { }
    }
});