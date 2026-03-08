<template>
  <AppLayout>
    <main>
      <HeaderComponent title="Customers" subtitle="Manage Customers" />
      <div class="wrapper d-flex justify-content-start">
        <Link class="btn btn-main-create py-1 px-4" :href="route('customer.create')"><i
          class="fa-solid fa-plus pe-4"></i>Add New</Link>
      </div>
      <div class="table-responsive mt-3 ">
        <table class="table table-hover" id="customerTable">
          <thead class="">
            <tr class="">
              <th class="text-center" scope="col">ID</th>
              <th class="text-center" scope="col">Name</th>
              <th class="text-center" scope="col">Email</th>
              <th class="text-center" scope="col">Address</th>
              <th class="text-center" scope="col">Phone Number</th>
              <th class="text-center" scope="col">Status</th>
              <th class="text-center" scope="col"></th>

            </tr>
          </thead>
          <tbody>
            <tr class="table-row-style" v-for="customer in customers" :key="customer.id">
              <td class="text-center">{{ customer.id }}</td>
              <td>{{ customer.name }}</td>
              <td>{{ customer.email }}</td>
              <td>{{ customer.address }}</td>
              <td>{{ customer.phone }}</td>
              <td class="text-center">
                <span :class="customer.status == 1 ? 'badge text-bg-success' : 'badge text-bg-danger'">
                  {{ customer.status == 1 ? 'Activated' : 'Deactivated' }}
                </span>
              </td>
              <td>
                <div class="btn-group">
                  <div type="button" class="drop-down-btn" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis"></i>
                  </div>
                  <ul class="dropdown-menu" style="opacity:9999;">
                    <li>
                      <Link class="dropdown-item action_edit" :data-id="customer.id">Edit</Link>
                    </li>
                    <li><a class="dropdown-item action_delete" :data-id="customer.id">Delete</a></li>

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
    customers: Array
  },
  mounted() {

    const vm = this;

    $(document).ready(function () {
      $('#customerTable').DataTable();
    });

    $("#customerTable").on("click", ".action_edit", function (evt) {
      evt.preventDefault();
      const id = $(this).data("id");
      vm.$inertia.visit(route("customer.edit", id));
      // console.log(id);
    });

    $("#customerTable").on("click", ".action_delete", function (evt) {
      evt.preventDefault();
      const id = $(this).data("id");
      vm.$inertia.delete(route("customer.delete", id));
      // console.log(id);
    });
  },
  methods: {

  },
}
</script>

<style>

</style>