<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  cardLink: {
    type: String,
  },
  cardHeader: {
    type: String,
  },
  cardParagraph: {
    type: String,
  },
})


</script>

<template>
  <Link :href="cardLink">
    <div class="flex items-start rounded-xl bg-white dark:bg-gray-800 p-4 shadow-lg">
      <slot />
      <div class="ml-4">
        <h2 class="font-semibold text-gray-900 dark:text-white">{{ cardHeader }}</h2>
        <p class="mt-2 text-sm text-gray-500 dark:text-white">{{ cardParagraph }}</p>
      </div>
    </div>
  </Link>
</template>

