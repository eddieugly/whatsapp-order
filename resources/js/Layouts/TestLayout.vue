<template>
  <div class="antialiased">
    <!-- NavBar -->
    <TestNav />

    <!-- Sidebar -->
    <TestSide />

    <!-- Main -->
    <main class="p-4 md:ml-64 h-auto pt-20">

      <slot />
    </main>

    <Alert />
  </div>
</template>

<script setup>
import TestNav from '@/Components/TestNav.vue';
import TestSide from '@/Components/TestSide.vue';
import Alert from '@/Components/Alert.vue';
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';


onMounted(() => {
  initFlowbite();
})

</script>

<style lang="scss" scoped></style>