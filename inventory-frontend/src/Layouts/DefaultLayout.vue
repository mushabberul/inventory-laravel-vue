<template>
    <div id="layout-wrapper">
        <NavbarView />
        <div class="hori-overlay"></div>

        <div class="main-content">
            <router-view />
            
        </div>
    </div>
</template>

<script setup>
import NavbarView from '../components/Navbar.vue';
</script>