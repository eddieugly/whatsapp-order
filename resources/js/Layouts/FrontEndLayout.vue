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
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import Footer from "@/Components/Frontend/Footer.vue";

import LargeNavBar from "@/Components/Frontend/LargeNavBar.vue";
import Alert from "@/Components/Frontend/Alert.vue";

onMounted(() => {
  initFlowbite();
});
</script>
