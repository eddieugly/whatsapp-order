<template>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-5">
    <div class="col-span-1">
      <Input v-model="filters.title" placeholder="Blog Name">
      <template #prefix>
        <Search class="w-5 h-5" />
      </template>
      </Input>
    </div>

    <div class="col-span-1 md:col-full">
      <SelectGroup v-model="filters.categoryId" :items="blogcategories" select-value="Select Category" />
    </div>

    <div class="col-span-1 md:col-full">
      <SelectGroup v-model="filters.status" :items="[{id: 1, name: 'Active'}, {id: 0, name: 'InActive'}]" select-value="Select Status" />
    </div>

    <div class="col-span-1 md:col-full">
      <SelectGroup v-model="filters.featured" :items="[{id: 1, name: 'Featured'}, {id: 0, name: 'NotFeatured'}]" select-value="Select Feature" />
    </div>

    <div class="col-span-1 md:col-full">
      <SelectGroup v-model="filters.featured" :items="[{id: 1, name: 'OnSlider'}, {id: 0, name: 'NotOnSlider'}]" select-value="Select Slider" />
    </div>

    <div class="col-span-1 md:col-full">
      <Link v-if="canCreate"
        class="flex w-full items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg  px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
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
import { Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import SelectGroup from '@/Components/SelectGroup.vue';
import { Input } from 'flowbite-vue';
import Search from '@/Components/Icons/Search.vue';

const props = defineProps({
  href: {
    type: String,
    default: () => '',
  },
  modelValue: {
    type: Object,
    default: () => ({}),
  },
  canCreate: {
    type: Boolean,
    default: () => true,
  },
  blogcategories: Array,
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