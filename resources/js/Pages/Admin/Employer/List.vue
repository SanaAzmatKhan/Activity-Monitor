<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import '@/Assets/AdminLTE/adminlte';

defineProps({
    users: Object,
});
</script>

<template>
    <Head title="Dashboard" />

  <AdminLayout>
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <!-- <h1 class="m-0">Employers List</h1> -->
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><Link :href="route('admin.index')">Dashboard</Link></li>
                  <li class="breadcrumb-item active">Employer</li>
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
                    <h3 class="card-title">Employers</h3>
                    <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
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
                          <th>Role</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-if="users.data.length" v-for="user in users.data" :key="user.id">
                          <td>{{ user.id }}</td>
                          <td>{{ user.name }}</td>
                          <td>{{ user.email }}</td>
                          <td><span class="tag tag-success">{{ user.role }}</span></td>
                          <td><Link class="btn text-primary" :href="route('admin.employer.edit', {'id': user.id})"><i class="fas fa-edit"></i></Link> | <Link class="btn text-danger"  @click="delete_user(user.id)"><i class="fas fa-trash"></i></Link></td>
                        </tr>
                      </tbody>
                    </table>
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
  </AdminLayout>
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
        delete_user(user_id) {

          if(confirm('Do you really want to delete it?')){
            let url = route('admin.employer.destroy', {'id': user_id});
                axios.get(url).then((response) => {
                    Inertia.visit(route('admin.employer.index'));
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
            let url = route('admin.employer.listing', {'page': page, 'keywords': keywords});
            axios.get(url).then((response) => {
                this.$page.props.users = response.data;
            }).catch(err => {});
        },

        _search() {
            let url = route('admin.employer.listing');
            if (this.xhr !== null) {
                source.cancel();
                source = axios.CancelToken.source();
                cancelToken = source.token;

            }
            let keywords = document.getElementById('search').value;
            //let data = {'keywords': keywords};
            
            this.xhr = axios.get(url, {
                params: {'keywords': keywords},
                cancelToken
            }).then((response) =>  {
                this.$page.props.users = response.data;
            }).catch(err => {
                console.log(err);

            });
        },

    },

}

</script>