<template>
  <button id="dropdownDefaultButton" data-dropdown-target="dropdown-filters-0090"
    data-dropdown-toggle="dropdown-filters-0090" ref="selectedButton"
    class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-orange-800"
    type="button">
    Select Category
    <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
    </svg>
  </button>
  <!-- Dropdown menu -->
  <div id="dropdown-filters-0090" class="z-10 hidden bg-white rounded-lg shadow w-48 p-3 dark:bg-gray-700">
    <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Choose Category</h6>
    <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefaultButton">
      <li v-for="(category, index) in categories" :key="index" class="flex items-center">
        <input v-model="selectedCategory" name="category" :id="category.slug" type="checkbox" v-bind:value="category.slug"
          class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-yellow-600 focus:ring-yellow-500 dark:focus:ring-yellow-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
          :checked="radioTrue(category.slug)">
        <label :for="category.slug" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">{{ category.name }}
          ({{ category.menus_count }})</label>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, watch, reactive, onMounted } from 'vue';
import debounce from 'lodash/debounce';
import { router } from '@inertiajs/vue3';
import { Dropdown } from "flowbite";

const props = defineProps({
  myfilters: {
    type: Object,
    category: {},
  },
  categories: Array,
});

const selectedCategory = ref([]);
const selectedButton = ref();


onMounted(() => {
  if (Array.isArray(props.myfilters.category)) {
    selectedCategory.value = props.myfilters.category;
  }
});


watch(
  props.myfilters,
  () => {
    selectedCategory.value = props.myfilters.category
  },
  {
    deep: true,
  }
);
const radioTrue = (categorySlug) => {
  if (props.myfilters.length) {
    const isCategoryPresent = props.myfilters.category.some((category) => category === categorySlug);

    console.log(isCategoryPresent);

    return isCategoryPresent;
  } else {
    return false;
  }
};
function myFunction() {
  document.getElementById("dropdownDefaultButton").click('click');
  console.log('Button Pressed');
}
const checkedNames = ref([]);

watch(selectedCategory, debounce(function (value) {
  router.get(route('frontend.menus'), { category: value }, { preserveState: true, replace: true });
}, 500), {
  deep: true,
});

</script>