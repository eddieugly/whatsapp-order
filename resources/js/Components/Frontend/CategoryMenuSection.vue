<template>

  <Section class="bg-white">

    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">

      <SectionHeader :header="category.name" :description="category.description.substring(0,
        100) + '...'" />

      <div class="grid gap-8 mb-6 lg:mb-16 lg:grid-cols-3 md:grid-cols-2">

        <Card v-for="menu in category.menus" :key="menu.id" class="relative mx-auto" :class="{ 'lg:col-start-2': category.menus.length == 1 }">

          <Link :href="route('frontend.menu.index', { id: menu.slug })">

            <div class="p-5 relative">

              <img class="rounded-t-lg w-full" :src="menu.thumbnail" :alt="menu.name" />

              <span class="absolute top-5 left-5 m-2 rounded-full bg-black px-2 text-center text-sm font-medium text-white">
                39% OFF
              </span>

              <h5 class="my-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ menu.name }}
              </h5>

              <p class="font-normal text-gray-700 dark:text-gray-400">
                {{ menu.description.substring(0, 55) }}...
              </p>
            
            </div>

          </Link>

          <div class="px-5 pb-5">

            <div class="flex flex-col items-start space-y-3">

              <span class="text-2xl font-bold text-blue-900 dark:text-white">
                ₦{{ menu.price.toLocaleString() }}
              </span>

              <AddToCartButton :menu="menu" />

            </div>

          </div>

        </Card>

      </div>

    </div>

  </Section>

</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Section from './Section.vue';
import SectionHeader from './SectionHeader.vue';
import Card from './Card.vue';
import AddToCartButton from './AddToCartButton.vue';

defineProps({
  category: {
    type: Object,
  },
});
</script>