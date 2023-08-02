<template>
  <div class="flex justify-center col-span-2 mt-3 mb-5">
    <Link :href="href"
      class="inline-flex justify-center items-center text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-base px-5 py-2.5 mr-2 dark:bg-yellow-600 dark:hover:bg-yellow-700 focus:outline-none dark:focus:ring-yellow-800">
      Load More
      <LoadMoreIcon />
    </Link>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import LoadMoreIcon from './Icon/LoadMoreIcon.vue';

defineProps({
  href: String,
})

</script>