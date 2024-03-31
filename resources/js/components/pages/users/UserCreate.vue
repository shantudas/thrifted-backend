<script setup>
import {Field, Form, ErrorMessage} from 'vee-validate';
import * as yup from 'yup';
import {ref} from "vue";

const schema = yup.object({
    name: yup.string().min(5).required(),
    email: yup.string().email().required(),
});

const myForm = ref(null);

function handleSubmit() {
    // Access form data using myForm.value
    const values = myForm.value; // Get form data from ref

    if (myForm.value.$error) { // Check for validation errors
        console.error('Form has validation errors:', myForm.value.$error);
        return;
    }

    onSubmit(values); // Call onSubmit with form data
}

function onSubmit(values) {
    alert(JSON.stringify(values, null, 2));
}

</script>

<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">New User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">New User</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <Form :validation-schema="schema" ref="myForm" >
                        <div class="form-group">
                            <label for="name">Name</label>
                            <Field name="name" type="text" class="form-control" id="name" placeholder="Enter name"/>
                            <ErrorMessage name="name"/>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <Field name="email" type="email" class="form-control" id="email" placeholder="Enter email"/>
                            <ErrorMessage name="email"/>
                        </div>
                    </Form>
                </div>
                <div class="card-footer">
                    <button type="submit" @click="handleSubmit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
