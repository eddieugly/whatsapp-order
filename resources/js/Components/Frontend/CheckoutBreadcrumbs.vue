<script setup>
import { Link } from '@inertiajs/vue3';
import Section from './Section.vue';
import BreadcrumbsHomeIcon from './Icon/BreadcrumbsHomeIcon.vue';
import BreadcrumbsArrowIcon from './Icon/BreadcrumbsArrowIcon.vue';
import AllMenuFilters from '@/Pages/Frontend/AllMenuFilters.vue';
import CheckoutCheckIcon from './Icon/CheckoutCheckIcon.vue';

defineProps({
  currentPage: {
    type: String,
    default: 'QuickPick',
  },
  middlePage: {
    type: String,
    default: 'General',
  },
  middlePageLink: {
    type: String,
    default: '/',
  },
  categories: {
    type: Object,
    default: [],
  },
  myfilters: {
    type: Object,
  },
  showDropdown: {
    type: Boolean,
    default: false,
  },
  showDropdownButton: {
    type: Boolean,
    default: false,
  },
})
</script>
<template>
  <!-- Breadcrumb -->
  <Section class="bg-gray-50">
    <div class="py-8 px-2 mx-auto max-w-screen-xl space-y-6">
      <div>
        <nav
          class="flex px-5 py-4 text-gray-700 shadow-md rounded-lg bg-white dark:bg-gray-800 dark:border-gray-700"
          aria-label="Breadcrumb">
          <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
              <Link href="/"
                class="inline-flex items-center font-semibold text-gray-700 hover:text-yellow-700 dark:text-gray-400 dark:hover:text-white">
                <BreadcrumbsHomeIcon />
                Home
              </Link>
            </li>
            <li>
              <div class="flex items-center">
                <BreadcrumbsArrowIcon />
                <Link :href="middlePageLink"
                  class="ml-1 font-semibold text-gray-700 hover:text-yellow-700 md:ml-2 dark:text-gray-400 dark:hover:text-white">
                  {{ middlePage }}
                </Link>
              </div>
            </li>
            <li aria-current="page">
              <div class="flex items-center">
                <BreadcrumbsArrowIcon />
                <span class="ml-1 font-semibold text-gray-500 md:ml-2 dark:text-gray-400">
                  {{ currentPage }}
                </span>
              </div>
            </li>
          </ol>
        </nav>
      </div>

      <div v-show="showDropdown" class="w-full">
        <div class="relative bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
          <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
            <div>
              <h5 class="mr-3 font-semibold dark:text-white">Our Menu</h5>
              <p class="text-gray-500 dark:text-gray-400">Select a category to view relating menu.s</p>
            </div>
            <div v-show="showDropdownButton">
              <AllMenuFilters v-if="showDropdownButton" :myfilters="myfilters" :categories="categories" />
            </div>
            
          </div>
        </div>
      </div>

      <div class="flex flex-col items-center border-b bg-white py-4 sm:flex-row px-5 rounded-lg shadow-md">
          <div class="mt-4 py-2 text-xs sm:mt-0 sm:ml-auto sm:text-base">
            <div class="relative">
              <ul class="relative flex w-full items-center justify-between space-x-2 sm:space-x-4">
                <li class="flex items-center space-x-3 text-left sm:space-x-4">
                  <button class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-200 text-xs font-semibold text-emerald-700">
                    <CheckoutCheckIcon />
                  </button>
                  <span class="font-semibold text-gray-900">Shop</span>
                </li>
                <BreadcrumbsArrowIcon />
                <li class="flex items-center space-x-3 text-left sm:space-x-4">
                  <button class="flex h-6 w-6 items-center justify-center rounded-full bg-yellow-600 text-xs font-semibold text-white ring ring-yellow-600 ring-offset-2">
                    2
                  </button>
                  <span class="font-semibold text-gray-900">Order</span>
                </li>
                <BreadcrumbsArrowIcon />
                <li class="flex items-center space-x-3 text-left sm:space-x-4">
                  <button class="flex h-6 w-6 items-center justify-center rounded-full bg-orange-200 text-xs font-semibold text-gray-500">3</button>
                  <span class="font-semibold text-gray-500">Payment</span>
                </li>
              </ul>
            </div>
          </div>
        </div>

    </div>
  </Section>
</template>
