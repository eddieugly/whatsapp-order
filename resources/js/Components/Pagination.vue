<template>
  <div>
    <Component
        :is="link.url && ! link.active ? Link : 'span'"
        v-for="link in links"
        :href="link.url"
        v-html="link.label"
        class="px-4 py-2 ml-0 border border-gray-300 dark:border-gray-700 dark:bg-gray-700 leading-tight hover:bg-gray-100"
        :class="{ 'text-gray-500' : ! link.url, 'text-blue-600 font-bold bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:text-white' : link.active }"
    />
</div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  links: Array,
})

</script>