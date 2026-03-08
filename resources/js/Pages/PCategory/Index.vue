<template>
  <AppLayout>
    <main>
      <HeaderComponent title="Product Categories" subtitle="Manage Product Categories" />
      <div class="wrapper d-flex justify-content-start">
        <Link class="btn btn-main-create py-1 px-4" :href="route('pcategory.create')"><i
          class="fa-solid fa-plus pe-4"></i>Add New</Link>
      </div>
      <div class="table-responsive mt-3 ">
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
              <td :class="pcategory.description || 'text-center text-secondary'">{{ pcategory.description || 'No Description' }}</td>
              <td class="text-center">
                <img :src="pcategory.media?.[0]?.original_url" alt="" class="" width="50" height="50">
              </td>
              <td class="text-center">
                <span :class="pcategory.status == 1 ? 'badge text-bg-success' : 'badge text-bg-danger'">
                  {{ pcategory.status == 1 ? 'Activated' : 'Deactivated' }}
                </span>
                
              </td>
              <td>
                <div class="btn-group">
                  <div type="button" class="drop-down-btn" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis"></i>
                  </div>
                  <ul class="dropdown-menu" style="opacity:9999;">
                    <li>
                      <Link class="dropdown-item action_edit" :data-id="pcategory.id">Edit</Link>
                    </li>
                    <li><a class="dropdown-item action_delete" :data-id="pcategory.id">Delete</a></li>

                  </ul>
                </div>
              </td>
            </tr>

          </tbody>
        </table>
      </div>
    </main>
  </AppLayout>
</template>

<script>
import HeaderComponent from '@/Components/HeaderComponent.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';


export default {
  components: {
    AppLayout,
    Link,
    HeaderComponent
  },
  props: {
    productcategories: Array
  },
  mounted() {

    const vm = this;

    $(document).ready(function () {
      $('#PcategoryTable').DataTable();
    });

    $("#PcategoryTable").on("click", ".action_edit", function (evt) {
      evt.preventDefault();
      const id = $(this).data("id");
      vm.$inertia.visit(route("pcategory.edit", id));
      // console.log(id);
    });

    $("#PcategoryTable").on("click", ".action_delete", function (evt) {
      evt.preventDefault();
      const id = $(this).data("id");
      vm.$inertia.delete(route("pcategory.delete", id));
      // console.log(id);
    });
  },
  methods: {

  },
}
</script>

<style>

</style>