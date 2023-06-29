<script setup>
import { computed, onMounted, ref } from "vue";

const props = defineProps({
  modelValue: {},
  items: Array,
  itemText: {
    type: String,
    default: "name",
  },
  itemValue: {
    type: String,
    default: "id",
  },
  withoutSelect: {
    type: Boolean,
    default: false,
  },
});

defineEmits(["update:modelValue"]);

const options = computed(() => {
  if (props.withoutSelect) return props.items;

  return [
    { [props.itemText]: "Select", [props.itemValue]: "" },
    ...props.items,
  ];
});

const select = ref(null);

onMounted(() => {
  if (select.value.hasAttribute("autofocus")) {
    select.value.focus();
  }
});
</script>

<template>
  <select :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="select" class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option v-for="item in options" :key="item[itemValue]" :value="item[itemValue]">
      {{ item[itemText] }}
    </option>
  </select>
</template>