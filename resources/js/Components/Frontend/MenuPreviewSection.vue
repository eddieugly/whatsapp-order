<template>
  <Section class="bg-white">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">

      <div class="lg:col-gap-12 xl:col-gap-16 mt-8 grid grid-cols-1 gap-12 lg:mt-12 lg:grid-cols-5 lg:gap-16">
        <div class="lg:col-span-3 lg:row-end-1">
          <div class="lg:flex lg:items-start">
            <img class="w-full h-full object-cover" :src="menu.thumbnail" alt="Product Image">
          </div>
        </div>

        <div class="lg:col-span-2 lg:row-span-2 lg:row-end-2">
          <h1 class="sm: text-2xl font-bold text-gray-900 sm:text-3xl">{{ menu.name }}</h1>

          <div class="mt-5 flex items-center">
            <div class="flex items-center">
              <MenuStarIcon />
              <MenuStarIcon />
              <MenuStarIcon />
              <MenuStarIcon />
              <MenuStarIcon />
            </div>
          </div>

          <h2 class="mt-8 text-base text-gray-900">Side Type</h2>
          <div class="mt-3 flex select-none flex-wrap items-center gap-1">
            <label class="">
              <input type="radio" name="type" value="Powder" class="peer sr-only" checked />
              <p class="peer-checked:bg-yellow-800 peer-checked:text-white px-6 py-2 font-bold text-gray-900 rounded-lg border border-orange-300 hover:bg-orange-200 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 cursor-pointer">
                Powder
              </p>
            </label>
            <label class="">
              <input type="radio" name="type" value="Whole Bean" class="peer sr-only" />
              <p class="peer-checked:bg-yellow-800 peer-checked:text-white px-6 py-2 font-bold text-gray-900 rounded-lg border border-orange-300 hover:bg-orange-200 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 cursor-pointer">
                Whole Bean
              </p>
            </label>
            <label class="">
              <input type="radio" name="type" value="Groud" class="peer sr-only" />
              <p class="peer-checked:bg-yellow-800 peer-checked:text-white px-6 py-2 font-bold text-gray-900 rounded-lg border border-orange-300 hover:bg-orange-200 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 cursor-pointer">
                Groud
              </p>
            </label>
          </div>

          <h2 class="mt-8 text-base text-gray-900">Extra Chicken?</h2>
          <div class="mt-3 flex select-none flex-wrap items-center gap-1">
            <label class="">
              <input type="radio" name="subscription" value="4 Months" class="peer sr-only" />
              <p class="peer-checked:bg-yellow-800 peer-checked:text-white px-6 py-2 font-bold text-gray-900 rounded-lg border border-orange-300 hover:bg-orange-200 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 cursor-pointer">
                4 Months
              </p>
              <span class="mt-1 block text-center text-xs">₦1,950</span>
            </label>
            <label class="">
              <input type="radio" name="subscription" value="8 Months" class="peer sr-only" checked />
              <p class="peer-checked:bg-yellow-800 peer-checked:text-white px-6 py-2 font-bold text-gray-900 rounded-lg border border-orange-300 hover:bg-orange-200 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 cursor-pointer">
                8 Months
              </p>
              <span class="mt-1 block text-center text-xs">₦2,050</span>
            </label>
            <label class="">
              <input type="radio" name="subscription" value="12 Months" class="peer sr-only" />
              <p class="peer-checked:bg-yellow-800 peer-checked:text-white px-6 py-2 font-bold text-gray-900 rounded-lg border border-orange-300 hover:bg-orange-200 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 cursor-pointer">
                12 Months
              </p>
              <span class="mt-1 block text-center text-xs">₦1,800</span>
            </label>
          </div>

          <div class="mt-10 flex flex-col items-center justify-between space-y-4 border-t border-b py-4 sm:flex-row sm:space-y-0">
            <div class="flex items-end">
              <h1 class="text-3xl font-bold">₦{{ menu.price.toLocaleString() }}</h1>
            </div>
            <AddToCartButton :menu="menu" />
          </div>

          <ul class="mt-8 space-y-2">
            <li class="flex items-center text-left text-sm font-medium text-gray-600">
              <svg class="mr-2 block h-5 w-5 align-middle text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                  class=""></path>
              </svg>
              Free shipping worldwide
            </li>

            <li class="flex items-center text-left text-sm font-medium text-gray-600">
              <svg class="mr-2 block h-5 w-5 align-middle text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" class="">
                </path>
              </svg>
              Cancel Anytime
            </li>
          </ul>
        </div>

        <div class="lg:col-span-3">
          <div class="border-b border-gray-300">
            <nav class="flex gap-4">
              <Link
                :href="route('frontend.menu.index', { id: menu.slug })"
                title=""
                class="border-b-2 border-gray-900 py-4 text-sm font-medium text-gray-900 hover:border-gray-400 hover:text-gray-800">
                Menu Description
              </Link>
            </nav>
          </div>

          <div class="mt-8 flow-root sm:mt-12">
            {{ menu.description }}
          </div>
        </div>
      </div>
    </div>
  </Section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Section from './Section.vue';
import AddToCartButton from './AddToCartButton.vue';
import MenuStarIcon from './Icon/MenuStarIcon.vue';

defineProps({
  menu: {
    type: Object,
  },
});
</script>