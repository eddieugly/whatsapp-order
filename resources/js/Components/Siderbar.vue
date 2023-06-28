<template>
  <aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
        <li>
          <Sidelink :href="route('admin.dashboard')" :active="route().current('admin.dashboard')">
            <svg aria-hidden="true"
              class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
              fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
              <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
            </svg>
            <span class="ml-3">Dashboard</span>
          </Sidelink>
        </li>
        <li>
          <Sidelink :href="route('admin.roles.index')" :active="route().current('admin.roles*')">
            <svg aria-hidden="true"
              class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
              fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
              <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
            </svg>
            <span class="ml-3">Roles</span>
          </Sidelink>
        </li>
        <li>
          <Sidelink :href="route('admin.permissions.index')" :active="route().current('admin.permissions*')">
            <svg aria-hidden="true"
              class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
              fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
              <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
            </svg>
            <span class="ml-3">Permissions</span>
          </Sidelink>
        </li>
        <li>
          <Sidelink :href="route('admin.category.index')" :active="route().current('admin.category*')">
            <svg aria-hidden="true"
              class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
              fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
              <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
            </svg>
            <span class="ml-3">Category</span>
          </Sidelink>
        </li>
        <li>
          <Sidelink :href="route('admin.assign')" :active="route().current('admin.assign')">
            <svg aria-hidden="true"
              class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
              fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
              <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
            </svg>
            <span class="ml-3">Assign</span>
          </Sidelink>
        </li>
      </ul>
    </div>
  </aside>
</template>

<script lang="ts" setup>
import Sidelink from './Sidelink.vue';
import Sidesublink from './Sidesublink.vue';
import { computed, toRefs, onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import type { PropType } from 'vue';

const props = defineProps({
  children: {
    type: Array,
    default() {
      return []
    },
  },
  collapseBehavior: {
    type: String, // 'collapse' | 'hide';
    default: 'collapse',
  },
  collapsed: {
    type: Boolean,
    default: false,
  },
})
</script>