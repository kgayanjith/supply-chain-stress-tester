<template>
    <AppLayout>
        <Link class="btn btn-danger py-1 px-5" :href="route('products.create')">Create</Link>
        <div class="table-responsive">
        <table class="table table-bordered" id="productsTable">
            <thead class="">
                <tr class="text-center">
                    <th class="fw-bold" scope="col">ID</th>
                    <th class="fw-bold" scope="col">Product Name</th>
                    <th class="fw-bold" scope="col">Product Description</th>
                    <th class="fw-bold" scope="col">Quantity</th>
                    <th class="fw-bold" scope="col">Price</th>
                    <th class="fw-bold" scope="col">Status</th>
                    <th class="fw-bold" scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td>{{ product.id }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.description }}</td>
                    <td>{{ product.quantity }}</td>
                    <td>{{ product.price }}</td>
                    <td>{{ product.status }}</td>
                    <td>action</td>
                </tr>
            </tbody>
        </table>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';


export default {
    components: {
        AppLayout,
        Link
    },
    props: {
        products: Array
    },
    mounted() {
        $(document).ready(function () {
            $('#productsTable').DataTable();
        });
    }
    
}
</script>

<style></style>