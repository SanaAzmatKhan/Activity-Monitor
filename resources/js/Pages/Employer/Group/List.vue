<script setup>
import EmployerLayout from '@/Layouts/EmployerLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import '@/Assets/AdminLTE/adminlte';
import axios from 'axios';

defineProps({
    groups: Object,
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
                  <li class="breadcrumb-item active">Group</li>
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
                    <h3 class="card-title">Groups</h3>
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
                          <th>Description</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-if="groups.data.length" v-for="group in groups.data" :key="group.group_id">
                          <td>{{ group.group_id }}</td>
                          <td>{{ group.name }}</td>
                          <td>{{ group.description }}</td>
                          <td><Link class="btn text-primary" :href="route('employer.group.edit', {'id': group.group_id})"><i class="fas fa-edit"></i></Link> | <Link class="btn text-danger"  @click="delete_group(group.group_id)"><i class="fas fa-trash"></i></Link></td>
                        </tr>
                      </tbody>
                    </table>
                    <Pagination :pageData="groups.links" :total="groups.total" @click="pageChange"/>
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
        delete_group(group_id) {

          if(confirm('Do you really want to delete it?')){
            let url = route('employer.group.destroy', {'id': group_id});
                axios.get(url).then((response) => {
                    Inertia.visit(route('employer.group.index'));
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
            let url = route('employer.group.listing', {'page': page, 'keywords': keywords});
            axios.get(url).then((response) => {
                this.$page.props.groups = response.data;
            }).catch(err => {
              console.log(err);
            });
        },

        _search() {
            let url = route('employer.group.listing');
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
                this.$page.props.groups = response.data;
            }).catch(err => {
                console.log(err);
            });
        },
    },
}

</script>