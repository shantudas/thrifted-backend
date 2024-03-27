<script setup>
import axios from 'axios';
import {ref, onMounted, reactive, watch} from 'vue';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';

const users = ref({'data': []});
const getUsers = (page=1) => {
    axios.get(`/api/users?page=${page}`, {})
        .then((response) => {
            users.value = response.data;
        })
}
onMounted(() => {
    getUsers();
});
</script>

<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Registered Date</th>
                        </tr>
                        </thead>
                        <tbody v-if="users.data.length > 0">
                        <tr v-for="(user,index) in users.data" :key="user.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.created_at }}</td>
                        </tr>
                        </tbody>
                        <tbody v-else>
                        <tr>
                            <td colspan="6" class="text-center">No results found...</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <Bootstrap4Pagination
                :data="users"
                @pagination-change-page="getUsers"
            />
        </div>
    </div>
</template>

<style scoped>

</style>
