<template>
  <Head title="Home" />
  <FrontEndLayout>
    <section class="bg-white dark:bg-gray-900">
      <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
        <div class="mr-auto place-self-center lg:col-span-7">
          <a href="#"
            class="inline-flex justify-between items-center py-1 px-1 pr-4 mb-7 text-sm text-gray-700 bg-gray-100 rounded-full dark:bg-gray-800 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700"
            role="alert">
            <span class="text-xs bg-blue-600 rounded-full text-white px-4 py-1.5 mr-3">New</span> <span
              class="text-sm font-medium">Flowbite is out! See what's new</span>
            <svg class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                clip-rule="evenodd"></path>
            </svg>
          </a>
          <h1
            class="max-w-xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
            Fastest Delivery & Quick Pickup</h1>
          <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Our job is
            to fill your tummy with the most tastiest meals, that will wow your imagination. Go through our menus and
            place an order now!.</p>
          <a href="#"
            class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
            Get started
            <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
            </svg>
          </a>
          <a href="#"
            class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
            Speak to Sales
          </a>
        </div>
        <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
          <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/hero/phone-mockup.png" alt="mockup">
        </div>
      </div>
    </section>



    <section class="bg-white dark:bg-gray-900">
      <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
        <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
          <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Categories Quick Peek</h2>
          <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">Take a quick peek at our featured
            menu category. Click on any of the category to see all food menues belonging to the category</p>
        </div>
        <div class="grid gap-8 mb-6 lg:mb-16 lg:grid-cols-3 md:grid-cols-2">
          <div v-for="category in $page.props.featured_categories" :key="category.id">
            <article
              class="mx-auto max-w-md shadow-xl bg-cover bg-center min-h-100 transform duration-500 hover:-translate-y-2 cursor-pointer group"
              :style='{ backgroundImage: `url(${category.thumbnail})` }'>
              <div
                class="bg-black bg-opacity-20 min-h-100 px-10 flex flex-wrap flex-col pt-52 hover:bg-opacity-75 transform duration-300">
                <h1 class="text-white text-3xl mb-5 transform translate-y-20 group-hover:translate-y-0 duration-300">
                  {{ category.name }}
                </h1>
                <div
                  class="w-16 h-2 bg-yellow-500 rounded-full mb-5 transform translate-y-20 group-hover:translate-y-0 duration-300">
                </div>
                <p class="opacity-0 text-white mb-5 text-xl group-hover:opacity-80 transform duration-500">
                  {{ category.description.substring(0, 55) }}...
                </p>
              </div>
            </article>
          </div>
        </div>
        <div class="flex justify-center col-span-2 mt-3 mb-5">
          <button
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
            type="button">
            Load More
          </button>
        </div>
      </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
      <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
        <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
          <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Our Menus</h2>
          <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">Take a quick peek at our featured
            food menus. Add all food menu of your choice to cart and proceed.</p>
        </div>
        <div class="grid gap-8 mb-6 lg:mb-16 lg:grid-cols-3 md:grid-cols-2">
          <div v-for="menu in $page.props.featured_menues" :key="menu.id">
            <the-card class="mx-auto" variant="image" :img-src="menu.thumbnail" img-alt="Food Menu">
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ menu.name }}</h5>
              <p class="font-normal text-gray-700 dark:text-gray-400 py-5">
                {{ menu.description.substring(0, 55) }}...
              </p>
              <div class="flex items-center justify-between">
                <span class="text-3xl font-bold text-gray-900 dark:text-white">₦{{ menu.price.toLocaleString() }}</span>
                <a href="#"
                  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                  to cart</a>
              </div>
            </the-card>
          </div>
        </div>
        <div class="flex justify-center col-span-2 mt-3 mb-5">
          <button
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
            type="button">
            Load More
          </button>
        </div>
      </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
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
                <!-- Credits SVG -->
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
                <!-- Credits SVG -->
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
                <!-- Credits For SVG -->
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

    <section class="bg-white dark:bg-gray-900">
      <div class="py-8 px-4 text-center mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <Carousel :items-to-show="4" :wrap-around="true">
          <Slide v-for="slider in $page.props.slider_menues" :key="slider.id">
            <div class="carousel__item">
              <div class="mx-auto max-w-sm bg-gray-200 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                  <a href="#">
                      <img class="p-8 rounded-t-lg" :src="slider.thumbnail" alt="product image" />
                  </a>
                  <div class="px-5 pb-5">
                      <a href="#">
                          <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ slider.name }}</h5>
                      </a>
                      <div class="flex items-center justify-between">
                          <span class="text-3xl font-bold text-gray-900 dark:text-white">₦{{ slider.price.toLocaleString() }}</span>
                          <a href="#" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add to cart</a>
                      </div>
                  </div>
              </div>
            </div>
          </Slide>

          <template #addons>
            <Navigation />
          </template>
        </Carousel>
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
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
import { TheCard } from 'flowbite-vue';

</script>

<style lang="scss" scoped></style>