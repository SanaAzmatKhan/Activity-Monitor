<script setup>
import EmployerLayout from '@/Layouts/EmployerLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';
import '@/Assets/AdminLTE/adminlte';
import axios from 'axios';
import moment from 'moment';
import timezone from 'moment-timezone';

defineProps({
    logs: Object,
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
                <h1 class="m-0">Logs</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><Link :href="route('employer.index')">Dashboard</Link></li>
                  <li class="breadcrumb-item active">Logs</li>
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
                  <div class="row card-header">
                      <div class="col-3">
                          <select class="custom-select rounded-0" id="group" name="group" @change="_search">
                            <option value="">--Group--</option>
                            <option v-if="groups.length" v-for="group in groups" :key="group.group_id" :value="group.group_id">{{ group.name }}</option>
                          </select>
                      </div>
                      <div class="col-3">
                        <div class="input-group date" id="datepicker">
                          <input type="date" class="form-control" id="date_filter" name="date_filter" @change="_search"/>
                        </div>
                      </div>
                      <div class="col-3"></div>
                    <div class="col-3">
                      <div class="input-group input-group">
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
                          <th>Employee</th>
                          <th>Group</th>
                          <th>Total Usage</th>
                          <th>Idle Time</th>
                          <th>Start Time</th>
                          <th>End Time</th>
                          <th>Date</th>
                          <!-- <th>Actions</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-if="logs.data.length" v-for="log in logs.data" :key="log.log_id">
                          <td>{{ log.log_id }}</td>
                          <td>{{ log.employee.name }}</td>
                          <td>{{ log.employee.group.name }}</td>
                          <td>{{ formatTime(log.total_usage) }}</td>
                          <td>{{ formatTime(log.idle_time) }}</td>
                          <!-- <td>{{ log.total_usage }} Sec</td>
                          <td>{{ log.idle_time }} Sec</td> -->
                          <td>{{ moment.tz(log.created_at, 'Asia/Karachi').format('h:mm A') }}</td>
                          <td>{{ moment.tz(log.updated_at, 'Asia/Karachi').format('h:mm A') }}</td>
                          <td>{{ moment(log.created_at).format('Do MMM YYYY') }}</td>
                          <!-- <td><Link class="btn text-primary" :href="route('employer.log.edit', {'id': log.log_id})"><i class="fas fa-edit"></i></Link> | <Link class="btn text-danger"  @click="delete_log(log.log_id)"><i class="fas fa-trash"></i></Link></td> -->
                        </tr>
                      </tbody>
                    </table>
                    <Pagination :pageData="logs.links" :total="logs.total" @click="pageChange"/>
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
        delete_log(log_id) {

          if(confirm('Do you really want to delete it?')){
            let url = route('employer.log.destroy', {'id': log_id});
                axios.get(url).then((response) => {
                    Inertia.visit(route('employer.log.index'));
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
        formatTime(seconds) {
            const hours = Math.floor(seconds / 3600);
            const minutes = Math.floor((seconds % 3600) / 60);
            const secs = seconds % 60;

            return `${this.padTime(hours)} h : ${this.padTime(minutes)} m`;
        },
        padTime(num) {
          return String(num).padStart(2, '0');
        },
        pageChange($e){
            $e.preventDefault();
            let keywords = document.getElementById('search').value;
            let elem = $($e.target);
            //let page = elem.attr("data-page");
            let pageUrl = elem.attr('href');
            let Url = new URL(pageUrl);
            let page = Url.searchParams.get('page');
            let url = route('employer.log.listing', {'page': page, 'keywords': keywords});
            axios.get(url).then((response) => {
                this.$page.props.logs = response.data;
            }).catch(err => {
              console.log(err);
            });
        },
        _search() {
            let url = route('employer.log.listing');
            if (this.xhr !== null) {
                source.cancel();
                source = axios.CancelToken.source();
                cancelToken = source.token;
            }
            let keywords = document.getElementById('search').value;
            let group_id = document.getElementById('group').value;
            let date = document.getElementById('date_filter').value;

            this.xhr = axios.get(url, {
                params: {'keywords': keywords, 'group_id': group_id, 'date': date},
                cancelToken
            }).then((response) =>  {
                this.$page.props.logs = response.data;
            }).catch(err => {
                console.log(err);
            });
        },
    },
}

</script>