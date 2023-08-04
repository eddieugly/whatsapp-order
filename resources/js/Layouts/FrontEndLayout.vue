<template>
  <div class="antialiased">
    <!-- NavBar -->
    <LargeNavBar />

    <!-- Main -->
    <main class="h-auto">

      <slot />
      <Footer />
    </main>

    <Alert />
  </div>
</template>

<script setup>
import Alert from '@/Components/Alert.vue';
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import Footer from '@/Components/Frontend/Footer.vue';

import LargeNavBar from '@/Components/Frontend/LargeNavBar.vue';

onMounted(() => {
  initFlowbite();
});

</script>