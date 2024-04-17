<script setup>

import axios from 'axios';
import {ref, onMounted, reactive, watch} from 'vue';
import {Bootstrap4Pagination} from 'laravel-vue-pagination';
import {debounce} from 'lodash';
import {useRouter} from 'vue-router';
import {ErrorMessage, Field, Form} from "vee-validate";
import * as yup from "yup";
import Swal from 'sweetalert2';

const router = useRouter();
const myForm = ref(null);
const categories = ref({'data': []});
const searchQuery = ref(null);

const category = ref({ name: '' });
const showModal = ref(false);

onMounted(() => {
    getCategories();
});

watch(searchQuery, debounce(() => {
    getCategories();
}, 300));

//  get all categories
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


const navigateToCreate = () => {
    router.push('/admin/categories/create'); // Route to user creation
};


// validation
const schema = yup.object({
    name: yup.string().min(3).required(),
});



async function handleSubmit() {

    if (myForm.value.$error) {
        console.error('Form has validation errors:', myForm.value.$error);
        return;
    }
    console.log('Category name:', category.value);

    try {
        const response = await axios.post('/api/categories', category.value); // Send entire category object
        console.log('Category created:', response.data);

        categories.value.data.push(response.data); //push data
        category.value.name = ''; // Clear form

        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: response.data.message, // Use message from response
        });

        closeModal();

        // Clear form or handle success (optional)
        // setCategory({ name: '' });
    } catch (error) {
        console.error('Error creating category:', error.response);
        // Handle error response (e.g., display error messages)
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: error.response.data.message || 'An error occurred.', // Handle potential error message
        });
    }
}

function openModal() {
    showModal.value = true;
}

function closeModal() {
    showModal.value = false;
}

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
                <!--                <button @click="navigateToCreate" type="button" class="mb-2 btn btn-primary">-->
                <!--                    <i class="fa fa-plus-circle mr-1"></i>-->
                <!--                    Add New Category-->
                <!--                </button>-->
                <button type="button" class="mb-2 btn btn-primary" data-toggle="modal" data-target="#modal-lg">
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
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody v-if="categories.data.length > 0">
                        <tr v-for="(category,index) in categories.data" :key="category.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ category.name }}</td>
                            <td>{{ category.created_at }}</td>
                            <td>
                                <div class="btn-group-horizontal">
                                    <button type="button" class="btn btn-default">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-default">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
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

    <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <Form :validation-schema="schema" ref="myForm">
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <Field name="name" type="text" class="form-control" id="name"
                                   placeholder="Enter category name" v-model="category.name"/>
                            <ErrorMessage name="name"/>
                        </div>
                    </Form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" @click="handleSubmit" class="btn btn-primary">Save changes</button>
                </div>
            </div>

        </div>

    </div>
</template>

<style scoped>

</style>
