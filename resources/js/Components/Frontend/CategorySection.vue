<template>
  <Section class="bg-white">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">

      <SectionHeader header="Categories Quick Peek" description="Take a quick peek at our featured
            menu category. Click on any of the category to see all food menues belonging to the category." />

      <div class="grid gap-8 mb-6 lg:mb-16 lg:grid-cols-3 md:grid-cols-2">
        <CategoryCard
          v-for="category in categories"
          :key="category.id"
          :background="category.thumbnail"
          :class="{ 'lg:col-start-2': categories.length == 1 }">
          <Link :href="route('frontend.category.index', { id: category.slug })">
          <div class="bg-black bg-opacity-20 min-h-100 px-10 flex flex-wrap flex-col pt-52 hover:bg-opacity-75 transform duration-300">
            <h1 class="text-white text-3xl mb-5 transform translate-y-20 group-hover:translate-y-0 duration-300">
              {{ category.name }}
            </h1>
            <div
              class="w-16 h-2 bg-yellow-700 rounded-full mb-5 transform translate-y-20 group-hover:translate-y-0 duration-300">
            </div>
            <p class="opacity-0 text-white mb-5 text-xl group-hover:opacity-80 transform duration-500">
              {{ category.description.substring(0, 55) }}...
            </p>
          </div>
          </Link>
        </CategoryCard>
      </div>
    </div>
  </Section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Section from './Section.vue';
import SectionHeader from './SectionHeader.vue';
import CategoryCard from './CategoryCard.vue';

defineProps({
  categories: {
    type: Object,
    default: () => ({}),
  },
});
</script>