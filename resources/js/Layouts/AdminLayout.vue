<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import SideBar from '@/Components/Admin/SideBar.vue';
import TopBar from '@/Components/Admin/TopBar.vue';

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
