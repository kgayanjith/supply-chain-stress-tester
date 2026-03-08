<template>
    <AppLayout>
        <main>
            <HeaderComponent title="Customer" subtitle="Create Customer Record" />
            <form @submit.prevent="submit">
                <div class="row">
                    <InputComponent id="name" label="Customer Name" name="customer-name" v-model="form.name"
                        :error="form.errors.name" :isRequired="true" />
                    <InputComponent id="email" type="email" label="Email" v-model="form.email"
                        :error="form.errors.email" :isRequired="true" />
                    <InputComponent id="phone" label="Phone No" v-model="form.phone" pattern="[0-9]*"
                        :error="form.errors.phone" :isRequired="true" />
                    <TextAreaComponent id="Address" label="Address" v-model="form.address" :error="form.errors.address"
                        :isRequired="true" />
                    <StatusComponent id="status" label="Status" v-model="form.status" :error="form.errors.status"
                        :isRequired="false" />

                </div>

                <div class="mt-5">
                    <Link class="btn btn-outline-danger py-1 px-5" :href="route('customer.index')">Cancel</Link>
                    <button type="submit" class="btn btn-primary ms-2 py-1 px-5" :disabled="form.processing">
                        {{ customers ? 'Update' : 'Create' }} Customer
                    </button>
                </div>
            </form>
        </main>
    </AppLayout>
</template>

<script>
import HeaderComponent from '@/Components/HeaderComponent.vue';
import InputComponent from '@/Components/InputComponent.vue';
import StatusComponent from '@/Components/StatusComponent.vue';
import TextAreaComponent from '@/Components/TextAreaComponent.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';



export default {
    components: {
        AppLayout,
        InputComponent,
        TextAreaComponent,
        StatusComponent,
        Link,
        HeaderComponent
    },
    data() {
        return {
            form: useForm({
                id: '',
                name: '',
                email: '',
                phone: '',
                address: '',
                status: 1,
            })
        }
    },
    props: {
        customers: Object,
    },
    watch: {

    },
    mounted() {
        let self = this;

        if (this.customers) {
            this.form.id = this.customers.id;
            this.form.name = this.customers.name;
            this.form.email = this.customers.email;
            this.form.phone = this.customers.phone;
            this.form.address = this.customers.address;
            this.form.status = this.customers.status;
        }


    },
    methods: {

        submit() {

            this.form.post(
                this.customers ? route('customer.update', this.form.id)
                    : route('customer.store'),
                {
                    onSuccess: () => {
                        this.form.reset();
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            },
                        });
                        Toast.fire({
                            icon: "success",
                            title: "Customer Saved",
                            text: "Customer has been saved successfully.",
                            iconColor: "#2563eb",
                            customClass: {
                                timerProgressBar: "custom-timer-bar",
                            },
                        });
                    },
                    onError: () => {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            },
                        });
                        Toast.fire({
                            icon: "error",
                            title: "Error!",
                            text: "Something went wrong!",
                            iconColor: "#2563eb",
                            customClass: {
                                timerProgressBar: "custom-timer-bar",
                            },
                        });
                    }
                });



        }
    }
}
</script>

<style scoped></style>