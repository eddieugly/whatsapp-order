<template>
  <div class="lg:hidden fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200 dark:bg-gray-700 dark:border-gray-600">
    <div class="grid h-full max-w-lg grid-cols-4 mx-auto font-medium">
      <Link :href="route('home')" type="button"
        class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
        <MobileNavHomeIcon />
        <span class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-yellow-600 dark:group-hover:text-yellow-500">Home</span>
      </Link>
      <Link :href="route('frontend.menus')" type="button"
        class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
        <MobileNavMenuIcon />
        <span class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-yellow-600 dark:group-hover:text-yellow-500">Menu</span>
      </Link>
      <Link :href="route('frontend.cart.index')" type="button" class="relative inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
        <MobileNavCartIcon />
        <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-yellow-600 border-2 border-white rounded-full top-0 right-7 dark:border-gray-900">
          {{ cartStore.cart.length }}
        </div>
        <span class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-yellow-600 dark:group-hover:text-yellow-500">Cart</span>
      </Link>
      <Link :href="route('login')" type="button" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
        <MobileNavUserIcon />
        <span class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-yellow-600 dark:group-hover:text-yellow-500">Account</span>
      </Link>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import MobileNavHomeIcon from './Icon/MobileNavHomeIcon.vue';
import MobileNavMenuIcon from './Icon/MobileNavMenuIcon.vue';
import MobileNavCartIcon from './Icon/MobileNavCartIcon.vue';
import MobileNavUserIcon from './Icon/MobileNavUserIcon.vue';

import { useCartStore } from '@/Store/cart';
import { storeToRefs } from 'pinia';

const cartStore = useCartStore();
const { cart } = storeToRefs(cartStore);
</script>