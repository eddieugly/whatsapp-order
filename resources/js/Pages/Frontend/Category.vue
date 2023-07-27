<template>
  <Head :title="title" />
  <FrontEndLayout>

    <section class="bg-gray-50 dark:bg-gray-900">
      <div class="pt-8 px-2 mx-auto max-w-screen-xl md:px-0">
        <CategoriesBreadcrumbs class="shadow-md" :current-page="category.name" middle-page="Categories" :middle-page-link="route('frontend.categories')" />
      </div>
    </section>

    <section class="bg-gray-50 dark:bg-gray-900">
      <div class="py-8 px-2 mx-auto max-w-screen-xl md:px-0">
        <div class="w-full">
          <!-- Start coding here -->
          <div class="relative bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
            <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
              <div>
                <h5 class="mr-3 font-semibold dark:text-white">Menu Categories</h5>
                <p class="text-gray-500 dark:text-gray-400">Choose & select a category to view relating menu.</p>
              </div>
              <button id="dropdownDefaultButton" data-dropdown-target="dropdown-filters-0090"
                data-dropdown-toggle="dropdown-filters-0090"
                class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-orange-800"
                type="button">
                Select Category
                <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
                </svg>
              </button>
              <!-- Dropdown menu -->
              <div id="dropdown-filters-0090"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                  <li v-for="all_category in all_categories">
                    <Link :href="route('frontend.category.index', { id: all_category.slug })" class="block px-4 py-2 hover:bg-orange-50 dark:hover:bg-gray-600 dark:hover:text-white">
                      {{ all_category.name }}
                    </Link>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="bg-white dark:bg-gray-900">
      <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
        <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
          <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">{{ category.name }}</h2>
          <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">{{ category.description.substring(0,
            100) }}</p>
        </div>
        <div class="grid gap-8 mb-6 lg:mb-16 lg:grid-cols-3 md:grid-cols-2">
          <div v-for="menu in category.menus" :key="menu.id" :class="{ 'lg:col-start-2': category.menus.length == 1 }">
            <the-card class="mx-auto" variant="image" :img-src="menu.thumbnail" img-alt="Food Menu">
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ menu.name }}</h5>
              <p class="font-normal text-gray-700 dark:text-gray-400 py-5">
                {{ menu.description.substring(0, 55) }}...
              </p>
              <div class="flex items-center justify-between">
                <span class="text-3xl font-bold text-gray-900 dark:text-white">₦{{ menu.price.toLocaleString() }}</span>
                <Link :href="route('frontend.menu.index', { id: menu.slug })"
                  class="text-white inline-flex items-center justify-center bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                  <svg class="w-[20px] h-[20px] shrink-0 mr-3" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1" />
                  </svg>
                
                  Add to cart
                </Link>
              </div>
            </the-card>
          </div>
        </div>
        <div class="flex justify-center col-span-2 mt-3 mb-5">
          <Link :href="route('frontend.menus')"
            class="inline-flex justify-center items-center text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-base px-5 py-2.5 mr-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 focus:outline-none dark:focus:ring-yellow-800">
            Load More
            <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
              </svg>
          </Link>
        </div>
      </div>
    </section>

    <section class="bg-gray-50 dark:bg-gray-900">
      <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
          <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">How It Works</h2>
          <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">Take a quick peek at our featured
            food menus. Add all food menu of your choice to cart and proceed.</p>
        </div>
        <div class="space-y-8 text-center md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
          <div>
            <div
              class="mx-auto hover:shadow-lg dark:hover:shadow-lg-light max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
              <a href="#">
                <FoodOrder />
                <!-- <a href="https://storyset.com/online">Online illustrations by Storyset</a> -->
              </a>
              <div class="p-5 text-center">
                <a href="#">
                  <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Add Meal To Cart</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Browser through our menus and add your
                  desired meal to cart.</p>
              </div>
            </div>
          </div>
          <div>
            <div
              class="mx-auto hover:shadow-lg dark:hover:shadow-lg-light max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
              <a href="#">
                <OrderCheckout />
                <!-- <a href="https://storyset.com/online">Online illustrations by Storyset</a> -->
              </a>
              <div class="p-5 text-center">
                <a href="#">
                  <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Proceed To Check Out
                  </h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Browser through our menus and add your
                  desired meal to cart.</p>
              </div>
            </div>
          </div>
          <div>
            <div
              class="mx-auto hover:shadow-lg dark:hover:shadow-lg-light max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
              <a href="#">
                <OrderPickUp />
                <!-- <a href="https://storyset.com/online">Online illustrations by Storyset</a> -->
              </a>
              <div class="p-5 text-center">
                <a href="#">
                  <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Come For Quick PickUp
                  </h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Follow the address on the map below to pick
                  up your order.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="bg-gray-50 dark:bg-gray-900">
      <div class="py-8 px-4 mx-auto max-w-full h-screen sm:py-16 lg:px-6">
        <iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" title="map" scrolling="no"
          src="https://maps.google.com/maps?width=100%&height=600&hl=en&q=%C4%B0zmir+(My%20Business%20Name)&ie=UTF8&t=&z=14&iwloc=B&output=embed"
          style=""></iframe>
      </div>
    </section>

    <section class="bg-gray-50 dark:bg-gray-900">
      <div class="py-20 px-4 mx-auto max-w-screen-xl sm:py-20 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center mb-12 lg:mb-16">
          <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Menu Slider</h2>
          <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">Take a quick peek at our featured
            food menus. Add all food menu of your choice to cart and proceed.</p>
        </div>
        <div class="">
          <MenuCarousel />
        </div>
      </div>
    </section>
  </FrontEndLayout>
</template>

<script setup>
import FrontEndLayout from '../../Layouts/FrontEndLayout.vue'
import { Head, Link } from '@inertiajs/vue3';
import FoodOrder from '@/Components/Frontend/Svg/FoodOrder.vue';
import OrderCheckout from '@/Components/Frontend/Svg/OrderCheckout.vue';
import OrderPickUp from '@/Components/Frontend/Svg/OrderPickUp.vue';
import { TheCard } from 'flowbite-vue';
import MenuCarousel from '@/Components/Frontend/MenuCarousel.vue';
import CategoriesBreadcrumbs from '@/Components/Frontend/CategoriesBreadcrumbs.vue';

defineProps({
  category: {
    type: Object,
    default: () => ({}),
  },
  all_categories: {
    type: Object,
    default: () => ({}),
  },
  title: {
    type: String,
    default: 'Category',
  }
});

</script>