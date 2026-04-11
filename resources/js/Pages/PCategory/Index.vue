<template>
  <AppLayout>
    <main>
      <HeaderComponent title="Product Categories" subtitle="Manage Product Categories" />
      <div class="wrapper d-flex justify-content-start">
        <Link class="btn btn-main-create py-1 px-4" :href="route('pcategory.create')"><i
          class="fa-solid fa-plus pe-4"></i>Add New</Link>
      </div>
      <div class="table-responsive mt-3">
        <table class="table table-hover" id="PcategoryTable">
          <thead class="">
            <tr class="">
              <th class="text-center" scope="col">ID</th>
              <th class="text-center" scope="col">Name</th>
              <th class="text-center" scope="col">Description</th>
              <th class="text-center" scope="col">Image</th>
              <th class="text-center" scope="col">Status</th>
              <th class="text-center" scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <tr class="table-row-style" v-for="pcategory in productcategories" :key="pcategory.id">
              <td class="text-center">{{ pcategory.id }}</td>
              <td>{{ pcategory.name }}</td>
              <td class="text-secondary product-description" :class="pcategory.description ||
                'text-center text-secondary'
                ">
                - {{ pcategory.description || "No Description" }}
              </td>
              <td class="text-center">
                <img :src="pcategory.media?.[0]?.original_url" alt="" class="" width="25" height="25" />
              </td>
              <td class="text-center">
                <span :class="pcategory.status == 1
                  ? 'badge text-bg-primary'
                  : 'badge text-bg-danger'
                  ">
                  {{
                    pcategory.status == 1
                      ? "Active"
                      : "Disabled"
                  }}
                </span>
              </td>
              <td>
                <div class="btn-group">
                  <div type="button" class="drop-down-btn" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis"></i>
                  </div>
                  <ul class="dropdown-menu" style="opacity: 9999">
                    <li>
                      <Link class="dropdown-item action_edit" :data-id="pcategory.id">Edit</Link>
                    </li>
                    <li>
                      <a class="dropdown-item " data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                        @click="selectedId = pcategory.id">Delete</a>
                    </li>
                  </ul>
                </div>
              </td>

            </tr>
          </tbody>
        </table>
      </div>
    </main>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
            <Link type="button" class="btn bg-black text-white rounded-0" @click="deleteCategory(selectedId)">Confirm
            </Link>
          </div>
        </div>

      </div>
    </div>
  </AppLayout>
</template>

<script>
import HeaderComponent from "@/Components/HeaderComponent.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";

export default {
  components: {
    AppLayout,
    Link,
    HeaderComponent,
  },
  data() {
    return {
      selectedId: null
    }
  },
  props: {
    productcategories: Array,
  },

  mounted() {
    const vm = this;

    $(document).ready(function () {
      $("#PcategoryTable").DataTable();
    });

    $("#PcategoryTable").on("click", ".action_edit", function (evt) {
      evt.preventDefault();
      const id = $(this).data("id");
      vm.$inertia.visit(route("pcategory.edit", id));
      // console.log(id);
    });

  },
  methods: {

    deleteCategory(selectedId) {
      // console.log(selectedId);
      this.$inertia.delete(route("pcategory.delete", selectedId), {
        onSuccess: () => {
          const modal = bootstrap.Modal.getInstance(document.getElementById('staticBackdrop'));
          modal.hide();
          this.$inertia.reload();
        }
      });
    },
  },
};
</script>

<style>

</style>
