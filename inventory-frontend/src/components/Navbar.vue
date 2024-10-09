<script setup>

import MenuBar from './MenuBar.vue';
import Profile from '@/components/Profile.vue';
// import Notification from '@/components/Notification.vue';
</script>

<template>
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <RouterLink :to="{ name: 'dashboard' }" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="@/assets/images/logo-sm.svg" alt="" height="26">
                        </span>
                        <span class="logo-lg">
                            <img src="@/assets/images/logo-sm.svg" alt="" height="26"> <span
                                class="logo-txt">Inventory</span>
                        </span>
                    </RouterLink>

                    <RouterLink :to="{ name: 'dashboard' }" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="@/assets/images/logo-sm.svg" alt="" height="26">
                        </span>
                        <span class="logo-lg">
                            <img src="@/assets/images/logo-sm.svg" alt="" height="26"> <span
                                class="logo-txt">Inventory</span>
                        </span>
                    </RouterLink>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item"
                    data-bs-toggle="collapse" id="horimenu-btn" data-bs-target="#topnav-menu-content">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <MenuBar />

            </div>
            <div class="d-flex">
                <!-- <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-search icon-sm"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                        <form class="p-2">
                            <div class="search-box">
                                <div class="position-relative">
                                    <input type="text" class="form-control rounded bg-light border-0"
                                        placeholder="Search...">
                                    <i class="bx bx-search search-icon"></i>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> -->


                <!-- Notification -->
                <!-- <Notification />

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon right-bar-toggle" id="right-bar-toggle">
                        <i class="bx bx-cog icon-sm"></i>
                    </button>
                </div> -->

                <!-- Profile -->
                <Profile />
            </div>
        </div>


    </header>
</template>
