<template>
  <InputLabel v-if="label" :value="label" class="mb-2" />

  <label for="dropzone-file"
    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
    <ImageUpload @update:model-value="$emit('update:modelValue', $event)" v-bind="$attrs" />
  </label>

  <InputError v-if="errorMessage" :message="errorMessage" class="mt-1" />
</template>

<script setup>
import TextArea from './TextArea.vue';
import InputError from './InputError.vue';
import InputLabel from './InputLabel.vue';
import ImageUpload from './ImageUpload.vue';


defineProps({
  modelValue: {},
  value: {},
  label: {
    type: String,
    default: "",
  },
  errorMessage: {
    type: String,
    default: "",
  },
});
</script>

<style lang="scss" scoped></style>