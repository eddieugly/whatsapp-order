<template>

  <div class="flex flex-col items-center">
    <!-- Help text -->
    <span class="text-sm text-gray-700 dark:text-gray-400">
        Showing <span class="font-semibold text-gray-900 dark:text-white">{{ meta.from }}</span> to <span class="font-semibold text-gray-900 dark:text-white">{{ meta.to }}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{ meta.total }}</span> Entries
    </span>
    <!-- Buttons -->
    <div class="inline-flex mt-2 xs:mt-0">
      <Component :is="link.url && ! link.active ? Link : 'span'" v-for="link in links" :href="link.url" v-html="link.label"
      class="px-4 py-2 ml-0 border border-gray-300 dark:border-gray-700 dark:bg-gray-700 leading-tight hover:bg-gray-100"
      :class="{ 'text-gray-500': !link.url, 'text-blue-600 font-bold bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:text-white': link.active }" />
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  links: Array,
  meta: Object,
})

</script>