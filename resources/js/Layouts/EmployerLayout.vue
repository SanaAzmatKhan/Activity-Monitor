<script setup>
import { ref } from 'vue';
import SideBar from '@/Components/Employer/SideBar.vue';
import TopBar from '@/Components/Employer/TopBar.vue';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <main>
        <div class="wrapper">
            <div class="topbar-wrapper">
                <TopBar />
            </div>
            <div class="sidebar-wrapper">
                <SideBar />
            </div>
             <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <slot />
            </div>
            <!-- /.content-wrapper -->
        </div>
    </main>
</template>
