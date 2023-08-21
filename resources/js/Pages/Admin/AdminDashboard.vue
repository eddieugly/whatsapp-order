<script setup>
import DashOrderIcon from "@/Components/Icons/Dashboard/DashOrderIcon.vue";
import DashPendingIcon from "@/Components/Icons/Dashboard/DashPendingIcon.vue";
import DashWalletIcon from "@/Components/Icons/Dashboard/DashWalletIcon.vue";
import DashUsersIcon from "@/Components/Icons/Dashboard/DashUsersIcon.vue";
import AuthenticatesLayout from "@/Layouts/AuthenticatesLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
  title: {
    type: String,
    required: true,
  },
  total_orders_today: {
    type: Number,
  },
  pending_orders_today: {
    type: Number,
  },
  total_sales: {
    type: String,
  },
  registered_customers: {
    type: Number,
  },
  now: {
    type: String,
  },
});
</script>

<template>
  <Head :title="title" />

  <AuthenticatesLayout>
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-4">
      <div class="flex items-start rounded-xl bg-white p-4 shadow-lg">
        <div
          class="flex h-12 w-12 items-center justify-center rounded-full border border-green-100 bg-green-50"
        >
        <DashOrderIcon />
        </div>

        <div class="ml-4">
          <h2 class="font-semibold">{{ total_orders_today.toLocaleString() }}</h2>
          <p class="mt-2 text-sm text-gray-500">Total Orders Today</p>
        </div>
      </div>
      <div class="flex items-start rounded-xl bg-white p-4 shadow-lg">
        <div
          class="flex h-12 w-12 items-center justify-center rounded-full border border-yellow-100 bg-yellow-50"
        >
          <DashPendingIcon />
        </div>

        <div class="ml-4">
          <h2 class="font-semibold">{{ pending_orders_today.toLocaleString() }}</h2>
          <p class="mt-2 text-sm text-gray-500">Pending Orders Today</p>
        </div>
      </div>
      <div class="flex items-start rounded-xl bg-white p-4 shadow-lg">
        <div
          class="flex h-12 w-12 items-center justify-center rounded-full border border-blue-100 bg-blue-50"
        >
          <DashWalletIcon />
        </div>

        <div class="ml-4">
          <h2 class="font-semibold">₦{{ (total_sales / 100).toLocaleString() }}</h2>
          <p class="mt-2 text-sm text-gray-500">Total Sales</p>
        </div>
      </div>
      <div class="flex items-start rounded-xl bg-white p-4 shadow-lg">
        <div
          class="flex h-12 w-12 items-center justify-center rounded-full border border-red-100 bg-red-50"
        >
          <DashUsersIcon />
        </div>

        <div class="ml-4">
          <h2 class="font-semibold">{{ registered_customers.toLocaleString() }}</h2>
          <p class="mt-2 text-sm text-gray-500">Registered Customers</p>
        </div>
      </div>
    </div>
    <div
      class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"
    ></div>
    <div class="grid grid-cols-2 gap-4 mb-4">
      <div
        class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
      ></div>
      <div
        class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
      ></div>
      <div
        class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
      ></div>
      <div
        class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
      ></div>
    </div>
    <div
      class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"
    ></div>
    <div class="grid grid-cols-2 gap-4">
      <div
        class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
      ></div>
      <div
        class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
      ></div>
      <div
        class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
      ></div>
      <div
        class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
      ></div>
    </div>
  </AuthenticatesLayout>
</template>
