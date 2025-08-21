<script setup>
import { Head, Link } from '@inertiajs/vue3';
import '@/Assets/AdminLTE/adminlte';
</script>
<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <Link :href="route('employer.index')" class="brand-link">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-bold">{{ $page.props.auth.user.name }}</span>
      <div class="">{{ $page.props.auth.user.role }}</div>
    </Link>

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
            <Link :href="route('employer.index')" :class="(route().current('employer.index')) ? 'nav-link active' : 'nav-link'">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </Link>
          </li>
          <li class="nav-item">
            <a href="#" :class="(route().current().includes('employer.group')) ? 'nav-link active' : 'nav-link'">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Group
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <Link :href="route('employer.group.create')" :class="(route().current('employer.group.create')) ? 'nav-link active' : 'nav-link'">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create</p>
                </Link>
              </li>
              <li class="nav-item">
                <Link :href="route('employer.group.index')" :class="(route().current('employer.group.index')) ? 'nav-link active' : 'nav-link'">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </Link>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" :class="(route().current().includes('employer.employee')) ? 'nav-link active' : 'nav-link'">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Employee
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <Link :href="route('employer.employee.create')" :class="(route().current('employer.employee.create')) ? 'nav-link active' : 'nav-link'">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create</p>
                </Link>
              </li>
              <li class="nav-item">
                <Link :href="route('employer.employee.index')" :class="(route().current('employer.employee.index')) ? 'nav-link active' : 'nav-link'">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List</p>
                </Link>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" :class="(route().current().includes('employer.log')) ? 'nav-link active' : 'nav-link'">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Log
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right"></span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <Link :href="route('employer.log.index')" :class="(route().current('employer.log.index')) ? 'nav-link active' : 'nav-link'">
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