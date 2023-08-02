<template>
  <div class="mx-auto max-w-md shadow-xl bg-cover bg-center min-h-100 transform duration-500 hover:-translate-y-2 cursor-pointer group"
    :style='{ backgroundImage: `url(${background})` }'>
    <slot />
  </div>
</template>

<script setup>
  defineProps({
    background: String,
  });
</script>