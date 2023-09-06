<template>
  <Section class="bg-orange-50 -mt-24 py-14">
    <div class="py-14 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
      <Link :href="route('frontend.menus')"
        class="inline-flex justify-between items-center py-1 px-1 pr-4 mb-7 text-sm text-gray-700 bg-orange-100 rounded-full dark:bg-gray-800 dark:text-white hover:bg-orange-200 dark:hover:bg-gray-700"
        role="alert">
      <span class="text-xs bg-yellow-700 rounded-full text-white px-4 py-1.5 mr-3">New</span>
      <span class="text-sm font-medium">Checkout our menu! See what's new</span>
      <HeroRightIcon />
      </Link>
      <h1
        class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
        Fast Order & Quick PickUp
      </h1>
      <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">
        Here at {{ $page.props.general.company_name }}, we focus on making it easy for customers to order food online. Our
        meals are tasty and can be ready with a few clicks.
      </p>
      <div class="flex flex-col mb-8 lg:mb-16 space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">
        <Link :href="route('frontend.faq')"
          class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-orange-300 dark:focus:ring-orange-900">
        About {{ $page.props.general.company_name }}
        <HeroLearnMoreIcon />
        </Link>
        <Link :href="route('frontend.menus')"
          class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-lg border border-orange-300 hover:bg-orange-200 focus:ring-4 focus:ring-orange-300 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-yellow-800">
        <HeroCategoryIcon />
        Menu Categories
        </Link>
      </div>
      <div class="px-4 mx-auto text-center md:max-w-screen-md lg:max-w-screen-lg lg:px-26">
        <span class="font-semibold text-gray-400 uppercase">3 STEPS ORDER</span>
        <div class="flex flex-wrap justify-center items-center text-gray-500 sm:space-x-5">
          <div class="flex p-8 items-center mb-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400">
            <span class="flex items-center justify-center w-8 h-8 mr-4 shrink-0">
              <svg class="" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 5h4m-2 2V3M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.938-11H17l-2 7H5m0 0L3 4m0 0h2M3 4l-.792-3H1" />
              </svg>
            </span>
            <span class="text-start">
              <h3 class="font-bold text-lg">Add To Cart</h3>
              <p class="text-sm">Add your menu to cart</p>
            </span>
          </div>
          <div class="flex p-8 items-center mb-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400">
            <span class="flex items-center justify-center w-8 h-8 mr-4 shrink-0">
              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11.905 1.316 15.633 6M18 10h-5a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h5m0-5a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1m0-5V7a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h15a1 1 0 0 0 1-1v-3m-6.367-9L7.905 1.316 2.352 6h9.281Z" />
              </svg>
            </span>
            <span class="text-start">
              <h3 class="font-bold text-lg">Secure Checkout</h3>
              <p class="text-sm">Checkout & pay for order</p>
            </span>
          </div>
          <div class="flex p-8 items-center mb-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400">
            <span class="flex items-center justify-center w-8 h-8 mr-4 shrink-0">
              <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 9V4a3 3 0 0 0-6 0v5m9.92 10H2.08a1 1 0 0 1-1-1.077L2 6h14l.917 11.923A1 1 0 0 1 15.92 19Z" />
              </svg>
            </span>
            <span class="text-start">
              <h3 class="font-bold text-lg">Order Pickup</h3>
              <p class="text-sm">Come & PickUp Order</p>
            </span>
          </div>
        </div>
      </div>
    </div>
  </Section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Section from './Section.vue';
import HeroRightIcon from './Icon/HeroRightIcon.vue';
import HeroLearnMoreIcon from './Icon/HeroLearnMoreIcon.vue';
import HeroCategoryIcon from './Icon/HeroCategoryIcon.vue';


</script>

<style lang="scss" scoped></style>