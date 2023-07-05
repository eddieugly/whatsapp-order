<template>
  <InputLabel v-if="label" :value="label" class="mb-2" />
  <label class="relative inline-flex items-center cursor-pointer">
    <Toogle :value="value" @update:checked="$emit('update:checked', $event)" v-bind="$attrs" />
  </label>

  <InputError v-if="errorMessage" :message="errorMessage" class="mt-1" />
</template>

<script setup>
import Toogle from '@/Components/Toogle.vue';
import InputError from './InputError.vue';
import InputLabel from './InputLabel.vue';


defineProps({
  value: {
    type: Boolean,
    default: false,
  },
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