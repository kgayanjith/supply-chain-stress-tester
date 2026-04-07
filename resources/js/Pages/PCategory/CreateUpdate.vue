<template>
    <AppLayout>
        <main>
            <HeaderComponent title="Product Category" subtitle="Create Product Category" />
            <form @submit.prevent="submit">
                <div class="row">
                    <InputComponent id="name" label="Name" name="customer-name" v-model="form.name"
                        :error="form.errors.name" :isRequired="true" />
                    <TextAreaComponent id="description" label="Description" v-model="form.description"
                        :error="form.errors.description" :isRequired="false" />
                    <div class="mb-3 col-md-6">
                        <label for="image" class="form-label me-3">
                            Image
                            <sup>*</sup>
                        </label>
                        <br />
                        <FileInputComponent name="image" id="image" :prvImage="previewSrc" v-model="form.image"
                            :isRequired="false" :isMultiple="false" />
                        <div class="text-danger">{{ form.errors.image }}</div>
                    </div>

                    <StatusComponent id="status" label="Status" v-model="form.status" :error="form.errors.status"
                        :isRequired="false" />

                </div>

                <div class="mt-5">
                    <Link class="btn btn-outline-danger py-1 px-5" :href="route('pcategory.index')">Cancel</Link>
                    <button type="submit" class="btn btn-primary ms-2 py-1 px-5" :disabled="form.processing">
                        {{ productcategories ? 'Update' : 'Create' }} Category
                    </button>
                </div>
            </form>
        </main>
    </AppLayout>
</template>

<script>

import FileInputComponent from '@/Components/FileInputComponent.vue';
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
        HeaderComponent,
        FileInputComponent,
    },
    data() {
        return {
            form: useForm({
                id: '',
                name: '',
                description: '',
                image: '',
                status: 1,

            })
        }
    },
    props: {
        productcategories: Object,
    },
    watch: {

    },
    mounted() {
        let self = this;

        if (this.productcategories) {
            this.form.id = this.productcategories.id;
            this.form.name = this.productcategories.name;
            this.form.description = this.productcategories.description;
            this.form.status = this.productcategories.status;

        }


    },
    computed: {
        previewSrc() {
            return this.productcategories ? this.productcategories?.media[0]?.original_url ?? "" : "";
        }
    },
    methods: {

        submit() {

            this.form.post(
                this.productcategories ? route('pcategory.update', this.form.id)
                    : route('pcategory.store'),
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
                            title: "Product Category Saved",
                            text: "Product Category has been saved successfully.",
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



        },
    }
}
</script>

<style scoped></style>