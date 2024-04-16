<script setup>

import axios from 'axios';
import {ref, onMounted, reactive, watch} from 'vue';
import {Bootstrap4Pagination} from 'laravel-vue-pagination';
import {debounce} from 'lodash';
import {useRouter} from 'vue-router';

const categories = ref({'data': []});
const searchQuery = ref(null);

const getCategories = (page = 1) => {
    axios.get(`/api/categories?page=${page}`, {
        params: {
            query: searchQuery.value
        }
    })
        .then((response) => {
            categories.value = response.data;
        })
}

onMounted(() => {
    getCategories();
});

watch(searchQuery, debounce(() => {
    getCategories();
}, 300));

const router = useRouter();

const navigateToCreate = () => {
    router.push('/admin/categories/create'); // Route to user creation
};

</script>

<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <button @click="navigateToCreate" type="button" class="mb-2 btn btn-primary">
                    <i class="fa fa-plus-circle mr-1"></i>
                    Add New Category
                </button>
                <div>
                    <input type="text" v-model="searchQuery" class="form-control" placeholder="Search..."/>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>Created Date</th>
                        </tr>
                        </thead>
                        <tbody v-if="categories.data.length > 0">
                        <tr v-for="(category,index) in categories.data" :key="category.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ category.name }}</td>
                            <td>{{ category.created_at }}</td>
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
                :data="categories"
                @pagination-change-page="getCategories"
            />
        </div>
    </div>
</template>

<style scoped>

</style>
