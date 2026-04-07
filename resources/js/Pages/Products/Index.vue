<template>
    <AppLayout>
        <main>
            <HeaderComponent title="Products" subtitle="Manage Products" />
            <div class="wrapper d-flex justify-content-start">
                <Link class="btn btn-main-create py-1 px-4" :href="route('product.create')"><i
                    class="fa-solid fa-plus pe-4"></i>Add New</Link>
            </div>
            <div class="table-responsive">
                <table class="table table-hover" id="productsTable">
                    <thead class="">
                        <tr class="text-center">
                            <th class="fw-bold" scope="col">ID</th>
                            <th class="fw-bold" scope="col">Product Name</th>
                            <th class="fw-bold" scope="col">Product Description</th>
                            <th class="fw-bold" scope="col">Category</th>
                            <th class="fw-bold text-center" scope="col">Image</th>
                            <th class="fw-bold" scope="col">Quantity</th>
                            <th class="fw-bold" scope="col">Price</th>
                            <th class="fw-bold" scope="col">Status</th>
                            <th class="fw-bold" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products" :key="product.id">
                            <td class="text-start">{{ product.id }}</td>
                            <td class="text-start">{{ product.name }}</td>
                            <td class="text-secondary product-description" :class="product.description ||
                                'text-center text-secondary'
                                ">
                                - {{ product.description || "No Description" }}
                            </td>
                            <td class="text-center">{{ product.category ? product.category.name : 'no category' }}</td>
                            <td class="text-center">
                                <span v-for="i in product.media" :key="i.index">
                                    <img :src="i.original_url" alt="" class="mx-1" width="25" height="25" />
                                </span>
                            </td>
                            <td class="text-start">{{ product.quantity }}</td>
                            <td class="text-start">{{ product.price }}.00</td>
                            <td><span :class="product.status == 1
                                ? 'badge text-bg-primary'
                                : 'badge text-bg-danger'
                                ">
                                    {{
                                        product.status == 1
                                            ? "Activated"
                                            : "Deactivated"
                                    }}
                                </span></td>
                            <td>
                                <div class="btn-group">
                                    <div type="button" class="drop-down-btn" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </div>
                                    <ul class="dropdown-menu" style="opacity: 9999">
                                        <li>
                                            <Link class="dropdown-item action_edit" :data-id="product.id">Edit</Link>
                                        </li>
                                        <li>
                                            <a class="dropdown-item " data-bs-toggle="modal"
                                                data-bs-target="#staticBackdropproduct"
                                                @click="selectedId = product.id">Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
        <div class="modal fade" id="staticBackdropproduct" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <!-- <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1> -->
                    </div>
                    <div class="modal-body text-center">
                        Are you sure you want to delete this record ?
                    </div>
                    <div class="modal-footer border-0 d-flex justify-content-center">
                        <button type="button" class="btn" data-bs-dismiss="modal">Go Back</button>
                        <Link type="button" class="btn bg-black text-white rounded-0"
                            @click="deleteCategory(selectedId)">Confirm
                        </Link>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>

<script>
import HeaderComponent from '@/Components/HeaderComponent.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';



export default {
    components: {
        HeaderComponent,
        AppLayout,
        Link
    },
    data() {
        return {

        }
    },
    props: {
        products: Array
    },
    mounted() {

        const vm = this;

        $(document).ready(function () {
            $('#productsTable').DataTable();
        });

        $("#productsTable").on("click", ".action_edit", function (evt) {
            evt.preventDefault();
            const id = $(this).data("id");
            vm.$inertia.visit(route("product.edit", id));
            // console.log(id);
        });
    },
    methods: {
        deleteCategory(selectedId) {
            // console.log(selectedId);
            this.$inertia.delete(route("product.delete", selectedId), {
                onSuccess: () => {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('staticBackdropproduct'));
                    modal.hide();
                    
                }
            });
        },
    }

}
</script>

<style></style>