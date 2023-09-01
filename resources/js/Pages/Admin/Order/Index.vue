<template>
  <Head :title="title" />

  <AuthenticatesLayout>
    <Card>
      <h5 class="p-5 text-2xl border-b-2 font-semibold tracking-tight text-gray-900 dark:text-white">
        Order List
      </h5>

      <Filters v-model="filters" :can-create="can.create" :filters="filters" />

      <Table :headers="headers" :items="items">
        <template v-slot="{ item }">
          <Td>
            <div class="text-xs font-semibold">#{{ item.id }}</div>
            <div class="text-xs font-semibold">
              {{ item.created_at }} | {{ item.created_date }}
            </div>
          </Td>
          <Td>
            <div class="text-xs font-semibold">Name: {{ item.customer_name }}</div>
            <div class="text-xs font-semibold">Phone {{ item.customer_phone }}</div>
            <div class="text-xs font-semibold">Email {{ item.customer_email }}</div>
          </Td>
          <Td> ₦{{ item.amount.toLocaleString() }} </Td>
          <Td>
            <Badge :type="item.payment_status == 2 ? 'green' : item.payment_status == 1 ? 'yellow' : 'red'">
              {{ item.payment_status == 2 ? "Paid" : item.payment_status == 1 ? "Pending" : "Cancelled" }}
            </Badge>
          </Td>
          <Td>
            <Badge :type="item.payment_method == 1 ? 'pink' : 'dark'" class="dark:text-white">
              {{ item.payment_method == 1 ? "Pay Now" : "Pickup Pay" }}
            </Badge>
          </Td>
          <Td>
            <Badge
              :type="item.order_status == 3 ? 'green' : item.order_status == 2 ? 'purple' : item.order_status == 1 ? 'yellow' : 'red'">
              {{ item.order_status == 3 ? "Picked" : item.order_status == 2 ? "Completed" : item.order_status == 1 ?
                "Pending" : "Cancelled" }}
            </Badge>
          </Td>
          <Td class="">
            <Button @click="iShowEditModal(item)" color="alternative">
              <template #prefix>
                <ViewOrder />
              </template>
              View
            </Button>
          </Td>
          <Td class="">
            <Actions @deleteClicked="showModal(item)"
              :edit-link="route(`admin.${routeResourceName}.edit`, { id: item.id })" :show-delete="can.delete"
              :show-edit="can.edit" />
          </Td>
        </template>
      </Table>
    </Card>

    <Modal size="lg" v-if="ShowEditModal" @close="noShowEditModal">
      <template #header>
        <div class="flex items-center text-lg text">Order Summary</div>
      </template>
      <template #body>
        <div>
          <div>
            <p class="text-gray-500 text-sm mb-2">#{{ orderItems.id }}</p>
            <div class="flex justify-between space-x-2 mb-2">
              <p class="text-gray-500 text-sm">Payment Status: </p>
              <Badge :type="orderItems.payment_status == 2 ? 'green' : orderItems.payment_status == 1 ? 'yellow' : 'red'">
                {{ orderItems.payment_status == 2 ? "Paid" : orderItems.payment_status == 1 ? "Pending" : "Cancelled" }}
              </Badge>
            </div>
            <div class="flex justify-between space-x-2 ">
              <p class="text-gray-500 text-sm">Order Status: </p>
              <Badge
                :type="orderItems.order_status == 3 ? 'green' : orderItems.order_status == 2 ? 'purple' : orderItems.order_status == 1 ? 'yellow' : 'red'">
                {{ orderItems.order_status == 3 ? "Picked" : orderItems.order_status == 2 ? "Completed" :
                  orderItems.order_status == 1 ? "Pending" : "Cancelled" }}
              </Badge>
            </div>
          </div>
          <div class="inline-flex items-center justify-center w-full">
            <hr class="w-full h-px my-8 bg-gray-200 border-0 dark:bg-gray-700">
            <span class="absolute px-3 font-medium text-gray-900 -translate-x-1/2 bg-white left-1/2 dark:text-white dark:bg-gray-900">Order Items</span>
          </div>

          <div class="flow-root">
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
              <li v-for="item in orderItems.cart" :key="item.id" class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                  <div class="flex-1 min-w-0">
                    <p class="text-base font-medium text-gray-900 truncate dark:text-white">
                      {{ item.name }}
                    </p>
                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                      ₦{{ item.price.toLocaleString() }}
                    </p>
                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                      <small>#{{ item.id }}</small>
                    </p>
                  </div>
                  <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                    x {{ item.quantity }}
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </template>
      <template #footer>
        <div class="flex justify-between">
          <Button @click="noShowEditModal" color="red">Close</Button>
          <Link :href="route(`admin.${routeResourceName}.edit`, { id: orderItems.id })"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          Update Order
          </Link>
        </div>
      </template>
    </Modal>

    <Modal size="lg" v-if="isShowModal" @close="closeModal">
      <template #header>
        <div class="flex items-center text-lg">Delete - {{ itemToDelete.name }}</div>
      </template>
      <template #body>
        <p class="text-base leading-relaxed text-red-500 dark:text-red-400">
          Are You Sure You Want To Delete This - {{ itemToDelete.name }}?
        </p>
      </template>
      <template #footer>
        <div class="flex justify-between">
          <Button @click="closeModal" color="light">Cancel</Button>
          <Button @click="handleDeleteItem" color="red" :disabled="isDeleting">
            <span v-if="isDeleting">Deleting..</span>
            <span v-else>Delete</span>
          </Button>
        </div>
      </template>
    </Modal>
  </AuthenticatesLayout>
</template>
<script setup>
import { ref } from "vue";
import AuthenticatesLayout from "@/Layouts/AuthenticatesLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import SearchAddButton from "@/Components/Table/SearchAddButton.vue";
import Section from "@/Components/Section.vue";
import Card from "@/Components/Card/Card.vue";
import Table from "@/Components/Table/Table.vue";
import Td from "@/Components/Table/Td.vue";
import Actions from "@/Components/Table/Actions.vue";
import { Modal, Button, Badge } from "flowbite-vue";
import Filters from "./Filters.vue";

import useDeleteItem from "@/Composables/useDeleteItem";
import useFilters from "@/Composables/useFilters";
import ViewOrder from "@/Components/Icons/ViewOrder.vue";

const props = defineProps({
  routeResourceName: {
    type: String,
    required: true,
  },
  title: {
    type: String,
    required: true,
  },
  items: {
    type: Object,
    default: () => ({}),
  },
  headers: {
    type: Object,
    default: () => [],
  },
  filters: {
    type: Object,
  },
  can: Object,
});

const orderItems = ref({});
const ShowEditModal = ref(false);

const iShowEditModal = (items) => {
  orderItems.value = items;
  ShowEditModal.value = true;
};

const noShowEditModal = () => {
  ShowEditModal.value = false;
  orderItems.value = {};
};

const {
  itemToDelete,
  isDeleting,
  isShowModal,
  closeModal,
  showModal,
  handleDeleteItem,
} = useDeleteItem({
  routeResourceName: props.routeResourceName,
});

const { filters } = useFilters({
  filters: props.filters,
  routeResourceName: props.routeResourceName,
});
</script>
