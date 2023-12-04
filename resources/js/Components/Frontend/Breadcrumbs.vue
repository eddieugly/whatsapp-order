<script setup>
import { Link } from '@inertiajs/vue3';
import Section from './Section.vue';
import BreadcrumbsHomeIcon from './Icon/BreadcrumbsHomeIcon.vue';
import BreadcrumbsArrowIcon from './Icon/BreadcrumbsArrowIcon.vue';
import AllMenuFilters from '@/Pages/Frontend/AllMenuFilters.vue';

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

        <nav class="flex px-5 py-4 text-gray-700 shadow-md rounded-lg bg-white dark:bg-gray-800 dark:border-gray-700"
          aria-label="Breadcrumb">

          <ol class="inline-flex items-center space-x-1 md:space-x-3">

            <li class="inline-flex items-center">

              <Link href="/" class="inline-flex items-center font-semibold text-gray-700 hover:text-yellow-700 dark:text-gray-400 dark:hover:text-white">
                
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
              <h5 class="mr-3 font-semibold dark:text-white">Our Menu</h5>
              <p class="text-gray-500 dark:text-gray-400">Select a category to view relating menu.s</p>
            </div>
            <div v-show="showDropdownButton">
              <AllMenuFilters v-if="showDropdownButton" :myfilters="myfilters" :categories="categories" />
            </div>
            
          </div>
        </div>
      </div>

    </div>
  </Section>
</template>
