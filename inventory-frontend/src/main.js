import { createApp } from 'vue'
import { createPinia } from 'pinia'


import './assets/css/bootstrap.min.css';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import VPagination from "@hennge/vue3-pagination";
import "@hennge/vue3-pagination/dist/vue3-pagination.css";

import App from './App.vue'
import router from './router'

import VeeValidatePlugin from '@/utils/validation';
const app = createApp(App)

app.component('v-pagination',VPagination);
app.use(createPinia())

app.use(router)
app.use(VeeValidatePlugin);
app.use(VueSweetalert2,{
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674',
  });

app.mount('#app')
