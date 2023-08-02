<template>
  <section class="dark:bg-gray-900">
    <slot />
  </section>
</template>

<script setup>

defineProps({
  header: String,
  description: String,
});

</script>