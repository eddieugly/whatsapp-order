<template>
  <Section class="bg-orange-50">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">

      <SectionHeader header="Our Menu" description="Take a quick peek at our featured food menus. Add all food menu of your choice to cart and proceed." />

      <div class="grid gap-8 mb-6 lg:mb-16 lg:grid-cols-3 md:grid-cols-2">
        <Card v-for="menu in menus" :key="menu.id" class="relative mx-auto" :class="{ 'lg:col-start-2': menus.length == 1 }">
          <Link :href="route('frontend.menu.index', { id: menu.slug })">
          <img class="rounded-t-lg w-full" :src="menu.thumbnail" :alt="menu.name" />
          <span
            class="absolute top-0 left-0 m-2 rounded-full bg-black px-2 text-center text-sm font-medium text-white">39%
            OFF</span>
          <div class="p-5">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ menu.name }}</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400 py-5">
              {{ menu.description.substring(0, 55) }}...
            </p>
          </div>
          </Link>
          <div class="px-5 pb-5">
            <div class="flex items-center justify-between">
              <span class="text-3xl font-bold text-gray-900 dark:text-white">₦{{ menu.price.toLocaleString() }}</span>
              <AddToCartButton :menu="menu" />
            </div>
          </div>
        </Card>
      </div>
      <SectionLoadMore v-if="loadMore" :href="route('frontend.menus')" />
    </div>
  </Section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Section from './Section.vue';
import SectionHeader from './SectionHeader.vue';
import SectionLoadMore from './SectionLoadMore.vue';
import Card from './Card.vue';
import AddToCartButton from './AddToCartButton.vue';

defineProps({
  menus: {
    type: Object,
    default: () => ({}),
  },
  loadMore: {
    type: Boolean,
    default: false,
  },
});
</script>