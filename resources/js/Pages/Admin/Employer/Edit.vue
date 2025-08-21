<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import '@/Assets/AdminLTE/adminlte';
defineProps({
    user: Object,
    csrf_token: String,
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
                <!-- <h1 class="m-0">Create Employer</h1> -->
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><Link :href="route('admin.index')">Dashboard</Link></li>
                  <li class="breadcrumb-item active">Employer</li>
                  <li class="breadcrumb-item active">Edit</li>
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <!-- left column -->
            <div class="col-md-2"></div>
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Employer</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form @submit="update_employer" id="update_employer" method="post" enctype="multipart/form-data" :action="route('admin.employer.update')">
                            <div class="card-body">
                                <input type="hidden" name="id" :value="user.id"/>
                                <input type="hidden" name="csrf_token" :value="csrf_token"/>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" :value="user.name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email"  placeholder="Enter email" :value="user.email">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                              <div class="row mt-4">
                                  <div class="d-grid gap-2 col-4 mx-auto">
                                    <button type="submit" class="btn btn-primary w-100"><span>Update</span><span class="loader ms-2 d-none"><i class="fas fa-spin fa-spinner"></i></span></button>
                                  </div>
                                </div>
                                <div class="msg-box mt-2"></div>
                            </div>
                        </form>
                        <form @submit="update_password" id="update_employer" method="post" enctype="multipart/form-data" :action="route('admin.employer.update')">
                            <div class="card-body">
                                <input type="hidden" name="id" :value="user.id"/>
                                <input type="hidden" name="csrf_token" :value="csrf_token"/>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                              <div class="row mt-4">
                                  <div class="d-grid gap-2 col-4 mx-auto">
                                    <button type="submit" class="btn btn-primary w-100"><span>Update</span><span class="loader ms-2 d-none"><i class="fas fa-spin fa-spinner"></i></span></button>
                                  </div>
                                </div>
                                <div class="pass-msg-box mt-2"></div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </AdminLayout>
</template>

<script>

export default {
        data() {
            return {}
        },
        methods: {
          
          update_employer($e) {
               $e.preventDefault();
               $(".errors").html('');
               $(".alert").remove();
               let form = $($e.target);
               form.find("button[type=submit]").attr("disabled", true);
               form.find("button[type=submit]").find(".loader").removeClass('d-none');
               let data = new FormData( form[0] );
               let url = route('admin.employer.update');
               axios.post(url, data).then((response) => {
                   form.find("button[type=submit]").attr("disabled", false);
                   form.find("button[type=submit]").find(".loader").addClass('d-none');
                   form[0].reset();
                   $(".msg-box").html('<div class="alert alert-success"><strong>Success!</strong> Employer Updated.</div>');
                   $("html, body").animate({ scrollTop: 0 }, 300);
                   setTimeout(() => {
                        $(".msg-box").html('');
                    }, 5000);
                
               }).catch(err => {
                   form.find("button[type=submit]").find(".loader").addClass("d-none");
                   form.find(".btn").attr("disabled", false);
                   if ( err.response !== undefined ) {
                       if ( err.response.status === 422 ) {
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
           },
           update_password($e) {
               $e.preventDefault();
               $(".errors").html('');
               $(".alert").remove();
               let form = $($e.target);
               form.find("button[type=submit]").attr("disabled", true);
               form.find("button[type=submit]").find(".loader").removeClass('d-none');
               let data = new FormData( form[0] );
               let url = route('admin.employer.update');
               axios.post(url, data).then((response) => {
                   form.find("button[type=submit]").attr("disabled", false);
                   form.find("button[type=submit]").find(".loader").addClass('d-none');
                   form[0].reset();
                   $(".pass-msg-box").html('<div class="alert alert-success"><strong>Success!</strong> Password Updated.</div>');
                   $("html, body").animate({ scrollTop: 0 }, 300);
                   setTimeout(() => {
                        $(".pass-msg-box").html('');
                    }, 5000);
                
               }).catch(err => {
                   form.find("button[type=submit]").find(".loader").addClass("d-none");
                   form.find(".btn").attr("disabled", false);
                   if ( err.response !== undefined ) {
                       if ( err.response.status === 422 ) {
                           let html = '<div class="alert alert-danger">Please fix the errors and try again</div><ul>';
                           var errors = err.response.data;
                           $.each(errors.errors, function(key, value) {
                               html = html + '<li class="err-msg-text text-danger">'+ value +'</li>';
                           });
                           html = html + '</ul>';
                           $(".pass-msg-box").html(html);
                           setTimeout(() => {
                                $(".pass-msg-box").html('');
                            }, 5000);
                       }
                   }
               });
           },
        }
    }

</script>