<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
defineProps({
    canResetPassword: Boolean,
    status: String,
});
const form = useForm({
    email: '',
    password: '',
    remember: false,
});
const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
<template>
    <GuestLayout>
        <Head title="Log in" />
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <!-- Section: Design Block -->
            <section class="">
            <!-- Jumbotron -->
                <div class="px-4 py-5 px-md-5 text-lg-start" style="background-color: hsl(0, 0%, 96%)">
                    <div class="container">
                        <div class="row gx-lg-5 align-items-center">
                            <div class="col-lg-6 mb-5 mb-lg-0">
                                <h1 class="my-5 display-3 fw-bold ls-tight">
                                    The best offer <br />
                                    <span class="text-primary">for your business</span>
                                </h1>
                                <p style="color: hsl(217, 10%, 50.8%)">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Eveniet, itaque accusantium odio, soluta, corrupti aliquam
                                    quibusdam tempora at cupiditate quis eum maiores libero
                                    veritatis? Dicta facilis sint aliquid ipsum atque?
                                </p>
                            </div>
                            <div class="col-lg-6 mb-5 mb-lg-0">
                                <div class="card">
                                    <div class="card-body py-5 px-md-5">
                                        <form @submit.prevent="submit">
                                            <!-- 2 column grid layout with text inputs for the first and last names -->
                                            <div class="row text-center">
                                                <div class="col-md-12 mb-4">
                                                    <h2>Let's Get started</h2>
                                                    <h6>Sign in to continue.</h6>
                                                </div>
                                            </div>
                                            <!-- Email input -->
                                            <div class="form-outline mb-4">
                                                <label class="form-label text-left" for="form3Example3">Email address</label>
                                                <input type="email" id="email" v-model="form.email" class="form-control" required autofocus autocomplete="username"/>
                                                <InputError class="mt-2" :message="form.errors.email" />
                                            </div>
                                            <!-- Password input -->
                                            <div class="form-outline mb-4">
                                                <label class="form-label" for="form3Example4">Password</label>
                                                <input type="password" id="password" v-model="form.password" class="form-control" autofocus  autocomplete="current-password" />
                                                <InputError class="mt-2" :message="form.errors.password" />
                                            </div>
                                            <!-- Checkbox -->
                                            <div class="row mx-4">
                                                <div class="form-check mb-4 float-start col-md-6">
                                                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
                                                    <label class="form-check-label" for="form2Example33">
                                                        Remember me
                                                    </label>
                                                </div>
                                                <div class="col-md-6 ms-auto">
                                                    <Link
                                                        v-if="canResetPassword"
                                                        :href="route('password.request')"
                                                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                    >
                                                        Forgot your password?
                                                    </Link>
                                                </div>
                                            </div>
                                            <!-- Submit button -->
                                            <button type="submit" class="btn btn-primary btn-block mb-4" :disabled="form.processing">
                                                Sign In
                                            </button>
                                            <!-- Register buttons -->
                                            <div class="text-center">
                                                <p>Not a member? <Link :href="route('register')" class="mx-2">Sign Up</Link></p>
                                                <p>or sign up with:</p>
                                                <button type="button" class="btn btn-link btn-floating mx-1">
                                                    <i class="fab fa-facebook-f"></i>
                                                </button>
                                                <button type="button" class="btn btn-link btn-floating mx-1">
                                                    <i class="fab fa-google"></i>
                                                </button>
                                                <button type="button" class="btn btn-link btn-floating mx-1">
                                                    <i class="fab fa-twitter"></i>
                                                </button>
                                                <button type="button" class="btn btn-link btn-floating mx-1">
                                                    <i class="fab fa-github"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Jumbotron -->
            </section>
        <!-- Section: Design Block -->
    </GuestLayout>
</template>