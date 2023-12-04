<template>

  <label class="">
    <slot />

    <p class="peer-checked:bg-blue-900 peer-checked:text-white px-6 py-2 font-bold text-gray-900 rounded-lg border border-orange-300 hover:bg-orange-200 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 cursor-pointer">
      {{ peerLabel }}
    </p>

  </label>

</template>

<script setup>

defineProps({
  peerValue: {
    type: Object,
  },
  peerLabel: {
    type: String,
  },
  checked: {
    type: Boolean,
    default: false
  },
});

</script>

<style lang="scss" scoped></style>