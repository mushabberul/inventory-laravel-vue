<script setup>
//all import
import { useAuthStore } from '@/stores/auth';
import { ref, reactive, inject } from 'vue';
import { useRouter } from 'vue-router';

//all instance
const authStore = useAuthStore();
const swal = inject('$swal');
const router = useRouter();

//All variable
const username = authStore.getUserName || 'Admin';

const logout = ()=>{
    authStore.removeToken();
    swal({
        icon: 'success',
        timer: 1000,
        title: 'Logout Successfully'
    });
    router.push({ name: 'login' });
}
</script>

<template>
    <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item user text-start d-flex align-items-center"
            id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="rounded-circle header-profile-user" src="../assets/images/users/avatar-3.jpg"
                alt="Header Avatar">
            <span class="ms-2 d-none d-xl-inline-block user-item-desc">
                <span class="user-name">{{username}} <i class="mdi mdi-chevron-down"></i></span>
            </span>
        </button>

        <div class="dropdown-menu dropdown-menu-end pt-0">
            <h6 class="dropdown-header">Welcome {{ username }}</h6>
            <a class="dropdown-item" href="pages-profile.html"><i
                    class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span
                    class="align-middle">Profile</span></a>
            <a class="dropdown-item" href="apps-chat.html"><i
                    class="mdi mdi-message-text-outline text-muted font-size-16 align-middle me-1"></i>
                <span class="align-middle">Messages</span></a>


            <a @click.prevent="logout" class="dropdown-item" href="javascript:void(0)"><i
                    class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i> <span
                    class="align-middle">Logout</span></a>
        </div>
    </div>
</template>