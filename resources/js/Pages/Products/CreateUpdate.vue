<template>
    <AppLayout>
        <form @submit.prevent="submit">
        <div class="row">
            <InputComponent id="name" label="Product Name" v-model="form.name" :error="form.errors.name" :isRequired="true" />
            <InputComponent id="slug" label="Slug" v-model="form.slug" :error="form.errors.slug" :disabled="true" />
            <InputComponent id="quantity" label="Product Quantity" type="number" v-model="form.quantity" :error="form.errors.quantity" :isRequired="true" />
            <TextAreaComponent id="description" label="Description" v-model="form.description"
                :error="form.errors.description" :isRequired="false" />
            <InputComponent id="price" label="Product Price" v-model="form.price" :error="form.errors.price" :isRequired="true" />
            <StatusComponent id="status" label="Status" v-model="form.status" :error="form.errors.status" :isRequired="false" />
        </div>
        <div class="mt-2">
                                <button type="submit" class="btn btn-secondary me-2" :disabled="form.processing">
                                   Create Product
                                </button>
                                <Link class="btn btn-outline-danger" :href="route('products.index')">Cancel</Link>
                            </div>
        </form>
    </AppLayout>
</template>

<script>
import InputComponent from '@/Components/InputComponent.vue';
import StatusComponent from '@/Components/StatusComponent.vue';
import TextAreaComponent from '@/Components/TextAreaComponent.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';



export default {
    components: {
        AppLayout,
        InputComponent,
        TextAreaComponent,
        StatusComponent,
        Link
    },
    data() {
        return {
            form: useForm({
                id: '',
                name: '',
                slug: '',
                quantity: '',
                description: '',
                price: '',
                status: 1,
            })
        }
    },
     watch: {
        'form.name'(value) {
            this.form.slug = this.slugify(value);
        }
    },
    methods:{
        slugify(text) {
            return text
                .toString()
                .toLowerCase()
                .trim()
                .replace(/\s+/g, '-')      
                .replace(/[^\w\-]+/g, '')  
                .replace(/\-\-+/g, '-'); 
        },
        submit(){
            this.form.post(route('products.store'), {
                onSuccess: () => {
                    this.form.reset();
                    alert('Product created successfully!');
                },
                onError: () => {
                    alert('There were errors while creating the product.');
                }
            });
        }
    }
}
</script>

<style></style>