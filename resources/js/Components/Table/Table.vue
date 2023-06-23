<template>
  <div class="overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <Th v-for="header in headers"
            :key="header.label">
            {{ header.label }}
          </Th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in items.data" :key="item.id" class="border-b dark:border-gray-700">
          <slot :item="item"></slot>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>

import Th from './Th.vue';
import Td from './Td.vue';

defineProps({
  headers: {
    type: Array,
    default: () => [],
  },
  items: {
    type: Object,
    default: () => ({}),
  }
})

</script>

<style lang="scss" scoped></style>