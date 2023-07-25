<template>
  <button id="dropdownDefaultButton" data-dropdown-target="dropdown-filters-0090"
    data-dropdown-toggle="dropdown-filters-0090"
    class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800"
    type="button">
    Select Category
    <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
    </svg>
  </button>
  <!-- Dropdown menu -->
  <div id="dropdown-filters-0090" class="z-10 hidden bg-white rounded rounded-lg shadow w-48 p-3 dark:bg-gray-700">
    <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Choose Category</h6>
    <ul class="space-y-2 text-sm" aria-labelledby="dropdownDefaultButton">
      <li v-for="(category, index) in categories" :key="index" class="flex items-center">
        <input name="category[]" :id="category.slug" type="checkbox" :value="category.slug" @change="selectCategory(category.slug)"
          class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" :checked="String(selectedCategory.category).includes(category.slug)">
        <label :for="category.slug" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">{{ category.name }}
          (56)</label>
      </li>
      <li class="flex items-center">
                  <input id="asus" type="checkbox" value="" :checked="true"
                    class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                  <label for="asus" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                    Asus (97)
                  </label>
                </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';

const emits = defineEmits(['setCategory']);

const props = defineProps({
    categories: Array,
    category: Array,
});

const selectedCategory = ref(props.category) 

const selectCategory = (categorySlug) => {

    if (! String(selectedCategory.value).includes(categorySlug)) {
        selectedCategory.value == '' 
            ? selectedCategory.value = categorySlug
            : selectedCategory.value += ',' + categorySlug         
    } else {
        // the url and laravel expect a string (of one or more categories separated by a comma)
        // To remove a category already present in the list,
        // I first turn the string into an array, then remove the category, and finally turn it back into a string
        selectedCategory.value = !Array.isArray(selectedCategory.value) ? selectedCategory.value.split(',') : selectedCategory.value;
       
        let index = selectedCategory.value.indexOf(categorySlug);

        selectedCategory.value.splice(index, 1);

        selectedCategory.value = selectedCategory.value.join(',') 
    }
};

watch(() => props.category, () => {    
    selectedCategory.value = props.category 
})

watch(() => selectedCategory.value, () => {
    emits('setCategory', selectedCategory.value)
})
</script>