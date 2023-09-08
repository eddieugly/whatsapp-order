<template>
  <div class="px-4 mx-auto text-center md:max-w-screen-md lg:max-w-screen-lg lg:px-26">
    <span class="font-semibold text-gray-400 uppercase">3 STEPS ORDER</span>
    <div class="flex flex-wrap justify-center items-center text-yellow-800 lg:space-x-5">
      <div class="flex p-4 lg:p-8 items-center lg:mb-0 hover:text-yellow-600 dark:hover:text-yellow-400">
        <span class="flex items-center justify-center w-8 h-8 mr-4 shrink-0">
          <HeroAddCartIcon />
        </span>
        <span class="text-start">
          <h3 class="font-bold text-lg">Add To Cart</h3>
          <p class="text-sm">Add your menu to cart</p>
        </span>
      </div>
      <div class="flex p-4 lg:p-8 items-center lg:mb-0 hover:text-yellow-600 dark:hover:text-yellow-400">
        <span class="flex items-center justify-center w-8 h-8 mr-4 shrink-0">
          <HeroCheckoutIcon />
        </span>
        <span class="text-start">
          <h3 class="font-bold text-lg">Secure Checkout</h3>
          <p class="text-sm">Checkout & pay for order</p>
        </span>
      </div>
      <div class="flex p-4 lg:p-8 items-center lg:mb-0 hover:text-yellow-600 dark:hover:text-yellow-400">
        <span class="flex items-center justify-center w-8 h-8 mr-4 shrink-0">
          <HeroBagIcon />
        </span>
        <span class="text-start">
          <h3 class="font-bold text-lg">Order Pickup</h3>
          <p class="text-sm">Come & PickUp Order</p>
        </span>
      </div>
    </div>
  </div>
</template>

<script setup>
import HeroAddCartIcon from './Icon/HeroAddCartIcon.vue';
import HeroBagIcon from './Icon/HeroBagIcon.vue';
import HeroCheckoutIcon from './Icon/HeroCheckoutIcon.vue';


</script>