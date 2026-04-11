<template>
    <AppLayout>
        <main>
            <HeaderComponent title="Banners" subtitle="Manage Banners" />
            <div class="wrapper d-flex justify-content-start">
                <Link class="btn btn-main-create py-1 px-4" :href="route('banner.create')"><i
                    class="fa-solid fa-plus pe-4"></i>Add New</Link>
            </div>
            <div class="table-responsive">
                <table class="table table-hover" id="bannersTable">
                    <thead class="">
                        <tr>
                            <th class="fw-bold text-start" scope="col">ID</th>
                            <th class="fw-bold" scope="col">Name</th>
                            <th class="fw-bold text-center" scope="col">Image</th>
                            <th class="fw-bold text-center" scope="col">Status</th>
                            <th class="fw-bold" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="banner in banners" :key="banner.id">
                            <td class="text-start">{{ banner.id }}</td>
                            <td class="text-start">{{ banner.name }}</td>
                            <td class="text-center">
                                <span>
                                    <img :src="banner.media[0].original_url" alt="" width="50" height="35" />
                                </span>
                            </td>
                         
                            <td class="text-center"><span :class="banner.status == 1
                                ? 'badge text-bg-primary'
                                : 'badge text-bg-danger'
                                ">
                                    {{
                                        banner.status == 1
                                            ? "Active"
                                            : "Disabled"
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
                                            <Link class="dropdown-item action_edit" :data-id="banner.id">Edit</Link>
                                        </li>
                                        <li>
                                            <span class="dropdown-item " data-bs-toggle="modal"
                                                data-bs-target="#staticBackdropbanner"
                                                @click="selectedId = banner.id">Delete</span>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
        <div class="modal fade" id="staticBackdropbanner" data-bs-backdrop="static" data-bs-keyboard="false"
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
        banners: Array
    },
    mounted() {

        const vm = this;

        $(document).ready(function () {
            $('#bannersTable').DataTable();
        });

        $("#bannersTable").on("click", ".action_edit", function (evt) {
            evt.preventDefault();
            const id = $(this).data("id");
            vm.$inertia.visit(route("banner.edit", id));
            // console.log(id);
        });
    },
    methods: {
        deleteCategory(selectedId) {
            // console.log(selectedId);
            this.$inertia.delete(route("banner.delete", selectedId), {
                onSuccess: () => {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('staticBackdropbanner'));
                    modal.hide();
                    
                }
            });
        },
    }

}
</script>

<style></style>