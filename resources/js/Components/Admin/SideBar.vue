<script setup>
import { Head, Link } from '@inertiajs/vue3';
import '@/Assets/AdminLTE/adminlte';
</script>
<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-bold">{{ $page.props.auth.user.name }}</span>
      <div class="">{{ $page.props.auth.user.role }}</div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <Link :href="route('admin.index')" :class="(route().current('admin.index')) ? 'nav-link active' : 'nav-link'">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </Link>
          </li>
          <li class="nav-item">
            <a href="#" :class="(route().current().includes('admin.employer')) ? 'nav-link active' : 'nav-link'">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Employer
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <Link :href="route('admin.employer.create')" :class="(route().current('admin.employer.create')) ? 'nav-link active' : 'nav-link'">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create</p>
                </Link>
              </li>
              <li class="nav-item">
                <Link :href="route('admin.employer.index')" :class="(route().current('admin.employer.index')) ? 'nav-link active' : 'nav-link'">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </Link>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    </aside>
</template>

<script>
    export default {
        mounted: function() {
            $(document).ready(function() {
                $(".nav-link").on("click", function() {
                    $(this).parent(".nav-item").toggleClass('menu-is-opening menu-open');
                });

                $(".nav-link").on("click" ,function () {
                    $("li").removeClass('active');
                    $(this).parent("li").addClass('active');
                });

            });
        }, 
       
    }
</script>