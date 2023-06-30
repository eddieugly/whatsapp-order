<template>
  <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
    <div class="w-full md:w-1/2">
      <div class="flex items-center">
        <Input class="w-full" v-model="filters.name" placeholder="Search Name">
        <template #prefix>
          <SearchVue class="w-5 h-5" />
        </template>
        </Input>
      </div>
    </div>
    <div
      class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
      <Link v-if="canCreate"
        class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
        as="button" :href="href">
      <svg class="h-5 w-6 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true">
        <path clip-rule="evenodd" fill-rule="evenodd"
          d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
      </svg>
      <slot />
      </Link>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { Input } from 'flowbite-vue';
import SearchVue from '../Icons/Search.vue';

const props = defineProps({
  href: {
    type: String,
    default: () => '',
  },
  filters: {
    type: Object,
    default: () => ({}),
  },
  modelValue: {
    type: Object,
    default: () => ({}),
  },
  canCreate: {
    type: Boolean,
    default: () => true,
  },
});

const emits = defineEmits(["update:modelValue"]);

const filters = ref({ ...props.modelValue });

watch(
  filters,
  () => {
    emits("update:modelValue", filters.value);
  },
  {
    deep: true,
  }
);

</script>

<style lang="scss" scoped></style>