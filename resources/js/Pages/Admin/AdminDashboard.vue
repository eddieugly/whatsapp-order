<script setup>
import DashOrderIcon from "@/Components/Icons/Dashboard/DashOrderIcon.vue";
import DashPendingIcon from "@/Components/Icons/Dashboard/DashPendingIcon.vue";
import DashWalletIcon from "@/Components/Icons/Dashboard/DashWalletIcon.vue";
import DashUsersIcon from "@/Components/Icons/Dashboard/DashUsersIcon.vue";
import DashCategoryIcon from "@/Components/Icons/Dashboard/DashCategoryIcon.vue";
import DashMenuIcon from "@/Components/Icons/Dashboard/DashMenuIcon.vue";
import AuthenticatesLayout from "@/Layouts/AuthenticatesLayout.vue";
import { Head } from "@inertiajs/vue3";
import DashCard from "@/Components/DashCard.vue";

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
  total_sales_today: {
    type: [String, Number],
  },
  registered_customers_today: {
    type: Number,
  },
  total_sales: {
    type: [String, Number],
  },
  active_categories: {
    type: Number,
  },
  active_menus: {
    type: Number,
  },
  registered_customers: {
    type: Number,
  },
});
</script>

<template>
  <Head :title="title" />

  <AuthenticatesLayout>
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-4">

    <DashCard :card-link="route('admin.orders.index')" :card-header="total_orders_today.toLocaleString()" card-paragraph="Total Orders Today">
      <div class="flex h-12 w-12 items-center justify-center rounded-full border border-green-100 bg-green-50">
        <DashOrderIcon />
      </div>
    </DashCard>

    <DashCard :card-link="route('admin.orders.index')" :card-header="pending_orders_today.toLocaleString()" card-paragraph="Pending Orders Today">
      <div class="flex h-12 w-12 items-center justify-center rounded-full border border-yellow-100 bg-yellow-50">
        <DashPendingIcon />
      </div>
    </DashCard>
    
    <DashCard :card-link="route('admin.orders.index')" :card-header="`₦${(total_sales_today / 100).toLocaleString()}`" card-paragraph="Total Sales Today">
      <div class="flex h-12 w-12 items-center justify-center rounded-full border border-blue-100 bg-blue-50">
        <DashWalletIcon />
      </div>
    </DashCard>

    <DashCard :card-link="route('admin.users.index')" :card-header="registered_customers_today.toLocaleString()" card-paragraph="Signups Today">
      <div class="flex h-12 w-12 items-center justify-center rounded-full border border-red-100 bg-red-50">
        <DashUsersIcon />
      </div>
    </DashCard>

    <DashCard :card-link="route('admin.orders.index')" :card-header="`₦${(total_sales / 100).toLocaleString()}`" card-paragraph="Total Sales">
      <div class="flex h-12 w-12 items-center justify-center rounded-full border border-purple-100 bg-purple-50">
        <DashWalletIcon />
      </div>
    </DashCard>

    <DashCard :card-link="route('admin.category.index')" :card-header="active_categories.toLocaleString()" card-paragraph="Active Categories">
      <div class="flex h-12 w-12 items-center justify-center rounded-full border border-green-100 bg-green-50">
        <DashCategoryIcon />
      </div>
    </DashCard>

    <DashCard :card-link="route('admin.menu.index')" :card-header="active_menus.toLocaleString()" card-paragraph="Active Menus">
      <div class="flex h-12 w-12 items-center justify-center rounded-full border border-yellow-100 bg-yellow-50">
        <DashMenuIcon />
      </div>
    </DashCard>

    <DashCard :card-link="route('admin.users.index')" :card-header="registered_customers.toLocaleString()" card-paragraph="Total Signups">
      <div class="flex h-12 w-12 items-center justify-center rounded-full border border-red-100 bg-red-50">
        <DashUsersIcon />
      </div>
    </DashCard>
    
    </div>
    <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"></div>
    <div class="grid grid-cols-2 gap-4 mb-4">
      <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
      <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
      <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
      <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
    </div>
    <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"></div>
    <div class="grid grid-cols-2 gap-4">
      <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
      <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
      <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
      <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"></div>
    </div>
  </AuthenticatesLayout>
</template>
