<template>
    <AppLayout>
        <main>
            <HeaderComponent title="Banners" subtitle="Create a banner" />
            <form @submit.prevent="submit">
                <div class="row">
                    <InputComponent id="name" label="Name" name="customer-name" v-model="form.name"
                        :error="form.errors.name" :isRequired="true" />
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
                    <Link class="btn btn-outline-danger py-1 px-5" :href="route('banner.index')">Cancel</Link>
                    <button type="submit" class="btn btn-primary ms-2 py-1 px-5" :disabled="form.processing">
                        {{ banners ? 'Update' : 'Create' }} Category
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
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';



export default {
    components: {
        AppLayout,
        InputComponent,
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
                image: '',
                status: 1,

            })
        }
    },
    props: {
        banners: Object,
    },
    watch: {

    },
    mounted() {
        let self = this;

        if (this.banners) {
            this.form.id = this.banners.id;
            this.form.name = this.banners.name;
            this.form.status = this.banners.status;

        }


    },
    computed: {
        previewSrc() {
            return this.banners ? this.banners?.media[0]?.original_url ?? "" : "";
        }
    },
    methods: {

        submit() {

            this.form.post(
                this.banners ? route('banner.update', this.form.id)
                    : route('banner.store'),
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
                            title: "Banner Saved",
                            text: "Banner has been saved successfully.",
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