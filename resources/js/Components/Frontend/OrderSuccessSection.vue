<template>
  <Section class="bg-white">
    <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
      <div class="mx-auto max-w-screen-xl justify-center md:flex md:space-x-6 xl:px-0">
        <div
          class="max-w-lg w-full bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
          <div class="flex flex-col items-center text-center px-5 py-10">
            <svg class="w-[40px] h-[40px] text-green-500 dark:text-white" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
              <path fill="currentColor"
                d="m18.774 8.245-.892-.893a1.5 1.5 0 0 1-.437-1.052V5.036a2.484 2.484 0 0 0-2.48-2.48H13.7a1.5 1.5 0 0 1-1.052-.438l-.893-.892a2.484 2.484 0 0 0-3.51 0l-.893.892a1.5 1.5 0 0 1-1.052.437H5.036a2.484 2.484 0 0 0-2.48 2.481V6.3a1.5 1.5 0 0 1-.438 1.052l-.892.893a2.484 2.484 0 0 0 0 3.51l.892.893a1.5 1.5 0 0 1 .437 1.052v1.264a2.484 2.484 0 0 0 2.481 2.481H6.3a1.5 1.5 0 0 1 1.052.437l.893.892a2.484 2.484 0 0 0 3.51 0l.893-.892a1.5 1.5 0 0 1 1.052-.437h1.264a2.484 2.484 0 0 0 2.481-2.48V13.7a1.5 1.5 0 0 1 .437-1.052l.892-.893a2.484 2.484 0 0 0 0-3.51Z" />
              <path fill="#fff"
                d="M8 13a1 1 0 0 1-.707-.293l-2-2a1 1 0 1 1 1.414-1.414l1.42 1.42 5.318-3.545a1 1 0 0 1 1.11 1.664l-6 4A1 1 0 0 1 8 13Z" />
            </svg>
            <h5 class="my-2 text-xl font-bold text-gray-900 dark:text-white">
              We received your order!
            </h5>
            <p class="text-base text-gray-500 dark:text-gray-400">
              Your order <strong>#{{ orderId }}</strong> {{ orderStatus }}
            </p>

            <OrderStatus :statuses="statuses" />

            <OrderSuccess />
            <!-- <a href="https://storyset.com/online">Online illustrations by Storyset</a> -->
            <Link href="/"
              class="w-full text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-orange-800">
            Go Home
            </Link>
          </div>
        </div>
      </div>
    </div>
  </Section>
</template>

<script setup>
import { computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import Section from "./Section.vue";
import OrderSuccess from "./Svg/OrderSuccess.vue";
import { Button } from "flowbite-vue";
import Card from "./Card.vue";
import CheckoutCheckIcon from "./Icon/CheckoutCheckIcon.vue";
import BreadcrumbsArrowIcon from "./Icon/BreadcrumbsArrowIcon.vue";
import OrderStatus from "./OrderStatus.vue";

const props = defineProps({
  orderId: {
    type: String,
  },
  orderStatus: {
    type: String,
  },
  statuses: {
    type: Number,
  },
});
</script>
