<template>
  <Head :title="title" />

  <AuthenticatesLayout>
    <Card>
      <h5
        class="mb-2 p-5 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white"
      >
        Order List
      </h5>

      <Filters v-model="filters" :can-create="can.create" />

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
            <Badge
              :type="
                item.payment_status == 2
                  ? 'green'
                  : item.payment_status == 1
                  ? 'yellow'
                  : 'red'
              "
            >
              {{
                item.payment_status == 2
                  ? "Paid"
                  : item.payment_status == 1
                  ? "Pending"
                  : "Cancelled"
              }}
            </Badge>
          </Td>
          <Td>
            <Badge :type="item.payment_method == 1 ? 'pink' : 'dark'">
              {{ item.payment_method == 1 ? "Pay Now" : "Pay on Pickup" }}
            </Badge>
          </Td>
          <Td>
            <Badge
              :type="
                item.order_status == 3
                  ? 'green'
                  : item.order_status == 2
                  ? 'purple'
                  : item.order_status == 1
                  ? 'yellow'
                  : 'red'
              "
            >
              {{
                item.order_status == 3
                  ? "Picked"
                  : item.order_status == 2
                  ? "Completed"
                  : item.order_status == 1
                  ? "Pending"
                  : "Cancelled"
              }}
            </Badge>
          </Td>
          <Td class="">
            <Button @click="iShowEditModal(item)" color="alternative">
              <template #prefix>
                <svg
                  class="w-[20px] h-[20px] text-gray-800 dark:text-white"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 20 14"
                >
                  <g
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                  >
                    <path d="M10 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    <path
                      d="M10 13c4.97 0 9-2.686 9-6s-4.03-6-9-6-9 2.686-9 6 4.03 6 9 6Z"
                    />
                  </g>
                </svg>
              </template>
              View
            </Button>
          </Td>
          <Td class="">
            <Actions
              @deleteClicked="showModal(item)"
              :edit-link="route(`admin.${routeResourceName}.edit`, { id: item.id })"
              :show-delete="can.delete"
              :show-edit="can.edit"
            />
          </Td>
        </template>
      </Table>
    </Card>

    <Modal size="lg" v-if="ShowEditModal" @close="noShowEditModal">
      <template #header>
        <div class="flex items-center text-lg">Order - {{ orderItems.id }}</div>
      </template>
      <template #body>
        <div>
          <div class="flow-root">
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
              <li v-for="item in orderItems.cart" :key="item.id" class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                      {{ item.id }}
                    </p>
                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                      ₦{{ item.price.toLocaleString() }}
                    </p>
                  </div>
                  <div
                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white"
                  >
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
import { Head } from "@inertiajs/vue3";
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
    default: () => ({}),
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
