<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';



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
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>

    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="card px-4 py-5 rounded-5 border-0" style="width: 100%; max-width: 380px;">
            <!-- Logo -->
            <div class="row justify-content-center pb-4">
                <div class="col-8">
                    <div class="img-wrapper">
                        <img src="/Images/scst.png" class="w-100 h-100" alt="Foodzy Logo">
                    </div>
                </div>
            </div>
            <!-- Login Form -->
            <form @submit.prevent="submit" class="login-form">
                <div class="mb-3 field">
                    <!-- <label for="email" class="form-label">Email</label> -->
                    <input type="text" class="form-control rounded py-2" id="email" v-model="form.email"
                        placeholder="Email" autofocus autocomplete="username" required>
                </div>
                
                <div class="mt-4">
                    <div class="mb-3 field">
                        <!-- <label for="formGroupExampleInput2" class="form-label">Password</label> -->
                        <input type="password" class="form-control rounded py-2" id="password" v-model="form.password"
                            placeholder="Password" autocomplete="current-password" required>
                    </div>
                </div>
                <InputError class="mt-2 text-danger" :message="form.errors.email" />
                <div class="block mt-4">
                    <label class="flex items-center">
                        <Checkbox v-model:checked="form.remember" class="" name="remember"  />
                        <span class="ms-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <div class="mt-4">
                    <!-- <Link v-if="canResetPassword" :href="route('password.request')"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Forgot your password?
                        </Link> -->

                    <button class="btn btn-primary bg-black border-black rounded w-100 py-2" type="submit"
                        :disabled="form.processing">
                        Log in
                    </button>
                </div>
            </form>
        </div>
    </div>

</template>
<style></style>
