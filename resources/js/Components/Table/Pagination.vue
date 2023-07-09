<template>
  <nav aria-label="Page navigation example">
    <ul class="inline-flex -space-x-px text-base h-10">
      <li v-for="link in links" :key="link.label">
        <button
          class="flex items-center justify-center px-4 h-10 ml-0 border border-gray-300 rounded dark:border-gray-700 dark:bg-gray-700 leading-tight hover:bg-gray-100"
          v-html="link.label"
          :class="{
            'text-blue-600 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:text-white': link.active,
            'text-gray-500 cursor-not-allowed': isDisabled(link),
            'text-gray-500 bg-white hover:text-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white': !isDisabled(link),
          }"
          @click.prevent="goToUrl(link)"
          :disabled="isDisabled(link)">
        </button>
      </li>
    </ul>
  </nav>
</template>

<script setup>
import { router } from '@inertiajs/vue3';

defineProps({
  links: Array,
})

const goToUrl = (link) => {
  router.get(link.url);
}

const isDisabled = (link) => {
  return link.url === null || link.active;
}
</script>

<style lang="scss" scoped></style>