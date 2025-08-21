<script setup>
import EmployerLayout from '@/Layouts/EmployerLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import '@/Assets/AdminLTE/adminlte';
import axios from 'axios';

defineProps({
    employees: Object,
});
</script>

<template>
    <Head title="Dashboard" />

  <EmployerLayout>
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <!-- <h1 class="m-0">Employers List</h1> -->
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><Link :href="route('employer.index')">Dashboard</Link></li>
                  <li class="breadcrumb-item active">Employees</li>
                  <li class="breadcrumb-item active">List</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Employees</h3>
                    <div class="">
                      <div class="input-group input-group w-25 float-right">
                        <input type="text" id="search" name="search" class="form-control float-right" placeholder="Search" @keyup="_search">
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Group</th>
                          <th>Key</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-if="employees.data.length" v-for="employee in employees.data" :key="employee.employee_id">
                          <td>{{ employee.employee_id }}</td>
                          <td>{{ employee.name }}</td>
                          <td>{{ employee.email }}</td>
                          <td><span class="tag tag-success">{{ employee.group.name }}</span></td>
                          <td>{{ employee.key }}</td>
                          <td v-if="employee.activation !== null">{{ employee.activation.is_active ? 'Active' : 'Inactive'}}</td>
                          <td v-else>{{ 'Inactive' }}</td>
                          <td><Link class="btn text-primary" :href="route('employer.employee.edit', {'id': employee.employee_id})"><i class="fas fa-edit"></i></Link> | <Link class="btn text-danger"  @click="delete_employee(employee.employee_id)"><i class="fas fa-trash"></i></Link></td>
                        </tr>
                      </tbody>
                    </table>
                    <Pagination :pageData="employees.links" :total="employees.total" @click="pageChange"/>
                  </div>
                  <div class="card-footer"> <div class="msg-box mt-2"></div></div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
  </EmployerLayout>
</template>
<script>

var source = axios.CancelToken.source();
var cancelToken = source.token;

export default {
    data() {
        return {
            keyword: null,
            requests: [],
            request: null,
            xhr: null,
        };
    }, 
  
    methods: {
        delete_employee(employee_id) {

          if(confirm('Do you really want to delete it?')){
            let url = route('employer.employee.destroy', {'id': employee_id});
                axios.get(url).then((response) => {
                    Inertia.visit(route('employer.employee.index'));
                }).catch(err => {
                  console.log(err);
                  if ( err.response !== undefined ) {
                        if ( err.response.status == 422 ) {
                            let html = '<div class="alert alert-danger">Please fix the errors and try again</div><ul>';
                            var errors = err.response.data;
                            $.each(errors.errors, function(key, value) {
                                html = html + '<li class="err-msg-text text-danger">'+ value +'</li>';
                            });
                            html = html + '</ul>';
                            $(".msg-box").html(html);
                            setTimeout(() => {
                                $(".msg-box").html('');
                            }, 5000);
                        }
                    }
                });
              }
        },

        pageChange($e){
            $e.preventDefault();
            let keywords = document.getElementById('search').value;
            let elem = $($e.target);
            //let page = elem.attr("data-page");
            let pageUrl = elem.attr('href');
            let Url = new URL(pageUrl);
            let page = Url.searchParams.get('page');
            let url = route('employer.employee.listing', {'page': page, 'keywords': keywords});
            axios.get(url).then((response) => {
                this.$page.props.employees = response.data;
            }).catch(err => {
              console.log(err);
            });
        },

        _search() {
            let url = route('employer.employee.listing');
            if (this.xhr !== null) {
                source.cancel();
                source = axios.CancelToken.source();
                cancelToken = source.token;
            }
            let keywords = document.getElementById('search').value;
            
            this.xhr = axios.get(url, {
                params: {'keywords': keywords},
                cancelToken
            }).then((response) =>  {
                this.$page.props.employees = response.data;
            }).catch(err => {
                console.log(err);
            });
        },
    },
}

</script>