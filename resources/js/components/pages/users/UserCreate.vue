<script setup>
import {Field, Form, ErrorMessage} from 'vee-validate';
import * as yup from 'yup';
import {ref} from "vue";

const schema = yup.object({
    name: yup.string().min(5).required(),
    email: yup.string().email().required(),
    password: yup.string().password().required(),
});

const myForm = ref(null);

async function handleSubmit() {
    // Access form data using myForm.value
    // const values = myForm.value; // Get form data from ref
    const values = myForm.value.form.value;

    // console.log(values);

    if (myForm.value.$error) {
        console.error('Form has validation errors:', myForm.value.$error);
        return;
    }

    try {
        const response = await axios.post('/api/users', values); // Replace with your API endpoint
        console.log('User created:', response.data);
        // Handle successful submission (e.g., clear form, show success message)
    } catch (error) {
        console.error('Error creating user:', error.response.data);
        // Handle error response (e.g., display error messages)
    }
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
                            <ErrorMessage name="name" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <Field name="email" type="email" class="form-control" id="email" placeholder="Enter email"/>
                            <ErrorMessage name="email" />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <Field name="password" type="password" class="form-control" id="password" placeholder="Enter password" />
                            <ErrorMessage name="password" />
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
