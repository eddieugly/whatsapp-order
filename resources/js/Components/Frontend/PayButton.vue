<template>
  <button
    :disabled="disabled"
    class="inline-flex items-center justify-center mt-4 mb-8 w-full rounded-md bg-yellow-700 px-6 py-3 font-medium text-white hover:bg-yellow-800"
  >
    <slot />
  </button>
</template>

<script setup>
const props = defineProps({
  disabled: {
    type: Boolean,
    default: true,
  },
});
</script>
