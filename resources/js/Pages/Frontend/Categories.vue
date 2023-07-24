<template>
  <Head :title="title" />
  <FrontEndLayout>

    <section class="bg-gray-50 dark:bg-gray-900">
      <div class="pt-8 px-2 mx-auto max-w-screen-xl md:px-0">
        <Breadcrumbs class="shadow-md" current-page="All Categories" middle-page="Categories" :middle-page-link="route('frontend.categories')" />
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
                <p class="text-gray-500 dark:text-gray-400">Select a category to view relating menu.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="bg-gray-50 dark:bg-gray-900">
      <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
        <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
          <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Categories Quick Peek</h2>
          <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">Take a quick peek at our featured
            menu category. Select on any of the category to see all relating food menus</p>
        </div>
        <div class="grid gap-8 mb-6 lg:mb-16 lg:grid-cols-3 md:grid-cols-2">
          <div v-for="category in all_categories" :key="category.id"
            :class="{ 'lg:col-start-2': all_categories.length == 1 }">
            <Link :href="route('frontend.category.index', { id: category.slug })">
            <article
              class="mx-auto max-w-md shadow-xl bg-cover bg-center min-h-100 transform duration-500 hover:-translate-y-2 cursor-pointer group"
              :style='{ backgroundImage: `url(${category.thumbnail})` }'>
              <div
                class="bg-black bg-opacity-20 min-h-100 px-10 flex flex-wrap flex-col pt-52 hover:bg-opacity-75 transform duration-300">
                <h1 class="text-white text-3xl mb-5 transform translate-y-20 group-hover:translate-y-0 duration-300">
                  {{ category.name }}
                </h1>
                <div
                  class="w-16 h-2 bg-yellow-700 rounded-full mb-5 transform translate-y-20 group-hover:translate-y-0 duration-300">
                </div>
                <p class="opacity-0 text-white mb-5 text-xl group-hover:opacity-80 transform duration-500">
                  {{ category.description.substring(0, 55) }}...
                </p>
              </div>
            </article>
            </Link>
          </div>
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
import MenuCarousel from '@/Components/Frontend/MenuCarousel.vue';
import Breadcrumbs from '@/Components/Frontend/Breadcrumbs.vue';

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