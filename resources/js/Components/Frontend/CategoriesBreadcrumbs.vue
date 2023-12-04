<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import Section from './Section.vue';
import BreadcrumbsHomeIcon from './Icon/BreadcrumbsHomeIcon.vue';
import BreadcrumbsArrowIcon from './Icon/BreadcrumbsArrowIcon.vue';
import BreadcrumbsArrowDownIcon from './Icon/BreadcrumbsArrowDownIcon.vue';

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
    default: () => ({}),
  },
  showDropdown: {
    type: Boolean,
    default: false,
  },
  showDropdownButton: {
    type: Boolean,
    default: false,
  },
});

const goToMenu = (slug) => {
  router.get(route('frontend.category.index', { id: slug }));
};


</script>

<template>
  <!-- Breadcrumb -->
  <Section class="bg-gray-50">

    <div class="py-8 px-2 mx-auto max-w-screen-xl space-y-6">

      <div>

        <nav class="flex px-5 py-4 text-gray-700 shadow-md rounded-lg bg-white dark:bg-gray-800 dark:border-gray-700"
          aria-label="Breadcrumb">

          <ol class="inline-flex items-center space-x-1 md:space-x-3">

            <li class="inline-flex items-center">

              <Link href="/" class="inline-flex items-center font-semibold text-blue-900 hover:text-yellow-700 dark:text-gray-400 dark:hover:text-white">
                
                <BreadcrumbsHomeIcon />

                Home

              </Link>

            </li>

            <li>

              <div class="flex items-center">

                <BreadcrumbsArrowIcon />

                <Link :href="middlePageLink" class="ml-1 font-semibold text-yellow-700 hover:text-blue-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">
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

              <h5 class="mr-3 font-semibold text-blue-900 dark:text-white">
                Menu Categories
              </h5>

              <p class="text-gray-500 dark:text-gray-400">
                Choose & select a category to view relating menu.
              </p>

            </div>

            <button
              v-show="showDropdownButton"
              id="dropdownDefaultButton"
              data-dropdown-target="dropdown-filters-0090"
              data-dropdown-toggle="dropdown-filters-0090"
              class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-orange-800"
              type="button">

              Select Category

              <BreadcrumbsArrowDownIcon />

            </button>

            <!-- Dropdown menu -->
            <div id="dropdown-filters-0090" class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
              
              <ul class="p-3 space-y-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                
                

                <li v-for="(category, index) in categories" :key="index" class="flex items-center">

                    <input type="checkbox" :id="category.slug"
                      class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-yellow-600 focus:ring-yellow-500 dark:focus:ring-yellow-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                      :checked="$page.url.endsWith(category.slug)" @click="goToMenu(category.slug)">

                    <label :for="category.slug" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                      {{ category.name }} ({{ category.menus_count }})
                    </label>

                </li>

              </ul>

            </div>

          </div>

        </div>

      </div>

    </div>

  </Section>

</template>
