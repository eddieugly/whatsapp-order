<template>
  <Section class="bg-gray-50">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">

      <SectionHeader header="Menu Slider" description="Take a quick peek at our featured food menus. Add all food menu of your choice to cart and proceed." />

      <div class="" >
        <slot />
      </div>
    </div>
  </Section>
</template>

<script setup>
import Section from './Section.vue';
import SectionHeader from './SectionHeader.vue';
</script>