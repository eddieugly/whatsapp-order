<template>

  <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">

    <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-blue-900 dark:text-white">
      {{ header }}
    </h2>

    <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">
      {{ description }}
    </p>

  </div>

</template>

<script setup>

defineProps({
  header: String,
  description: String,
});

</script>