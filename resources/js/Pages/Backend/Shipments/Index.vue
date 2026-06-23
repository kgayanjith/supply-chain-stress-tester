<template>
    <AppLayout>
        <main>
            <HeaderComponent title="Shipments & Tracking" subtitle="Manage Shipments" />
            <div class="wrapper d-flex justify-content-start">
                <Link class="btn btn-main-create py-1 px-4" :href="route('banner.create')"><i
                    class="fa-solid fa-plus pe-4"></i>Add New</Link>
            </div>
            <div class="table-responsive">
                <table class="table table-hover" id="shippingTable">
                    <thead class="">
                        <tr>
                            <th class="fw-bold text-start" scope="col">ID</th>
                            <th class="fw-bold text-center" scope="col">IMO Code</th>
                            <th class="fw-bold" scope="col">Shipname</th>
                            <th class="fw-bold text-center" scope="col">Destination</th>
                            <th class="fw-bold text-center" scope="col">MMSI Code</th>
                            <th class="fw-bold" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="shipment in shipments" :key="shipment.id">
                            <td class="text-start">{{ shipment.id }}</td>
                            <td class="text-center">{{ shipment.imo }}</td>
                            <td class="text-start">{{ shipment.ship_name }}</td>


                            <td class="text-center"><span>
                                    {{ shipment.dest }}
                                </span></td>
                            <td class="text-center"><span>
                                    {{ shipment.mmsi }}
                                </span></td>

                            <td>
                                <Link class="btn btn-danger btn-sm rounded-0 action_track"
                                    :data-id="shipment.id">Track</Link>
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
import AppLayout from '@/Layouts/SideNavBar.vue';
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from "vue";



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
        shipments: Object,
    },
    mounted() {

        const vm = this;

        $(document).ready(function () {
            $('#shippingTable').DataTable();
        });

        $("#shippingTable").on("click", ".action_track", function (evt) {
            evt.preventDefault();

            const id = $(this).data("id");
            // console.log(id);
            vm.$inertia.visit(route("shipment.tracking", id));
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