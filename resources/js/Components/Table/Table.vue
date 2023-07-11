<template>
  <div class="overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-sm text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <Th v-for="header in headers" :key="header.label">
            {{ header.label }}
          </Th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in items.data" :key="item.id" class="border-b dark:border-gray-700">
          <slot :item="item"></slot>
        </tr>
        <tr v-if="items.data.length === 0">
          <Td :colspan="headers.length">
            No Records Available
          </Td>
        </tr>
      </tbody>
    </table>
  </div>
  <div v-if="items.meta.links.length > 3" class="flex items-center justify-center text-center py-4">
    <Pagination :links="items.meta.links" />
  </div>
</template>

<script setup>

import Th from './Th.vue';
import Td from './Td.vue';
import Pagination from '../Pagination.vue';


const props = defineProps({
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