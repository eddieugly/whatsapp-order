<template>
  <InputLabel v-if="label" :value="label" class="mb-2" />

  <TextArea :model-value="modelValue" @update:model-value="$emit('update:modelValue', $event)" v-bind="$attrs" />

  <InputError v-if="errorMessage" :message="errorMessage" class="mt-1" />
</template>

<script setup>
import TextArea from './TextArea.vue';
import InputError from './InputError.vue';
import InputLabel from './InputLabel.vue';


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