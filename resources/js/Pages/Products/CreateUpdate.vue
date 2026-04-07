<template>
    <AppLayout>
        <form @submit.prevent="submit">
            <div class="row">
                <InputComponent id="name" label="Product Name" v-model="form.name" :error="form.errors.name"
                    :isRequired="true" />
                <SelectCompo id="category" label="Category" v-model="form.category"
                    :options="productcategories.map(c => ({ value: c.id, label: c.name }))"
                    placeholder="Select category" />
                <InputComponent id="quantity" label="Product Quantity" type="number" v-model="form.quantity"
                    :error="form.errors.quantity" :isRequired="true" />
                <TextAreaComponent id="description" label="Description" v-model="form.description"
                    :error="form.errors.description" :isRequired="false" />
                <InputComponent id="price" label="Product Price" type="number" v-model="form.price" :error="form.errors.price"
                    :isRequired="true" />
                <div class="mb-3 col-md-6">
                    <div class="d-flex align-items-center">
                        <div>
                            <label for="feature_image" class="form-label me-3">
                                Feature Image
                                <sup>*</sup>
                            </label>
                            <br />
                            <FileInputComponent name="feature_image" id="feature_image" :prvImage="featureImageUrl"
                                v-model="form.feature_image" :isMultiple="false" :isRequired="false" />
                            <div class="text-danger">{{ form.errors.feature_image }}</div>
                        </div>
                        <div>
                            <label for="image" class="form-label me-3">
                                Secondary Images
                                <sup>*</sup>
                            </label>
                            <br />
                            <div class="d-flex">
                                <FileInputComponent name="first_image" id="first_image" class="mx-1"
                                    :prvImage="secondaryImageUrls[0] ?? ''" v-model="form.first_image"
                                    :isMultiple="false" :isRequired="false" />
                                <FileInputComponent name="second_image" id="second_image" class="mx-1"
                                    :prvImage="secondaryImageUrls[1] ?? ''" v-model="form.second_image"
                                    :isMultiple="false" :isRequired="false" />
                                <FileInputComponent name="third_image" id="third_image" class="mx-1"
                                    :prvImage="secondaryImageUrls[2] ?? ''" v-model="form.third_image"
                                    :isMultiple="false" :isRequired="false" />
                            </div>
                            <div class="text-danger">{{ form.errors.first_image }}</div>
                            <div class="text-danger">{{ form.errors.second_image }}</div>
                            <div class="text-danger">{{ form.errors.third_image }}</div>
                        </div>

                    </div>

                </div>
                <StatusComponent id="status" label="Status" v-model="form.status" :error="form.errors.status"
                    :isRequired="false" />
            </div>
            <div class="mt-5">
                <Link class="btn btn-outline-danger py-1 px-5" :href="route('product.index')">Cancel</Link>
                <button type="submit" class="btn btn-primary ms-2 py-1 px-5" :disabled="form.processing">
                    {{ products ? 'Update' : 'Create' }} Product
                </button>
            </div>
        </form>
    </AppLayout>
</template>

<script>
import InputComponent from '@/Components/InputComponent.vue';
import StatusComponent from '@/Components/StatusComponent.vue';
import TextAreaComponent from '@/Components/TextAreaComponent.vue';
import FileInputComponent from '@/Components/FileInputComponent.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import SelectCompo from '@/Components/SelectCompo.vue';
import Swal from 'sweetalert2';

export default {
    components: {
        AppLayout,
        InputComponent,
        TextAreaComponent,
        StatusComponent,
        FileInputComponent,
        Link,
        SelectCompo
    },
    data() {
        return {
            form: useForm({
                id: '',
                name: '',
                quantity: '',
                description: '',
                price: '',
                status: 1,
                feature_image: null,
                first_image: null,
                second_image: null,
                third_image: null,
                category: ''
            }),
        }
    },
    props: {
        products: Object,
        productcategories: Array
    },
    watch: {
       
       
    },
    mounted() {
        let self = this;

        if (this.products) {
            this.form.id = this.products.id;
            this.form.name = this.products.name;
            this.form.description = this.products.description;
            this.form.category = this.products.product_category_id;
            this.form.quantity = this.products.quantity;
            this.form.price = this.products.price;
            this.form.status = this.products.status;
        }
    },
    methods: {
        
       
            // console.log(this.form.image);
            submit() {

            this.form.post(
                this.products ? route('product.update', this.form.id)
                    : route('product.store'),
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
                            title: "Product Saved",
                            text: "Product has been saved successfully.",
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
        },

    computed: {
 
        featureImageUrl() {
            if (!this.products?.media) return '';
            const media = this.products.media.find(
                m => m.collection_name === 'feature_image'
            );
            return media?.original_url ?? '';
        },

        secondaryImageUrls() {
            if (!this.products?.media) return [];
            return this.products.media
                .filter(m => m.collection_name === 'product_images')
                .map(m => m.original_url);
        }
    },
}
</script>

<style></style>