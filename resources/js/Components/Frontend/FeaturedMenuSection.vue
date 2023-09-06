<template>
  <Section class="bg-orange-50">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">

      <SectionHeader header="Featured Menu"
        description="Take a quick peek at our featured 0food menus. Add all food menu of your choice to cart and proceed." />

      <MenuCarousel>
        <Slide v-for="slider in menus" :key="slider.id">
          <div class="carousel__item">
            <Card>
              <Link :href="route('frontend.menu.index', { id: slider.slug })">
              <div class="p-5 relative">
                <img class="rounded-t-lg w-full" :src="slider.thumbnail" :alt="slider.name" />
                <span
                  class="absolute top-5 left-5 m-2 rounded-full bg-black px-2 text-center text-sm font-medium text-white">39%
                  OFF</span>
                <h5 class="my-2 text-2xl text-start font-bold tracking-tight text-gray-900 dark:text-white">{{ slider.name }}</h5>
                <p class="font-normal text-start text-gray-700 dark:text-gray-400">
                  {{ slider.description.substring(0, 55) }}...
                </p>
              </div>
              </Link>
              <div class="px-5 pb-5">
                <div class="flex flex-col items-start space-y-3">
                  <span class="text-2xl font-bold text-gray-900 dark:text-white">₦ {{ slider.price.toLocaleString()
                  }}</span>
                  <AddToCartButton :menu="slider" />
                </div>
              </div>
            </Card>
          </div>
        </Slide>
      </MenuCarousel>


      <SectionLoadMore :href="route('frontend.menus')" />
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
import SliderMenuSection from './SliderMenuSection.vue';
import MenuCarousel from './MenuCarousel.vue';
import { Slide } from 'vue3-carousel';

defineProps({
  menus: {
    type: Object,
    default: () => ({}),
  },
});
</script>

<style>
.carousel__slide {
  padding: 5px;
}

.carousel__prev,
.carousel__next {
  width: 2.5rem;
  height: 2.5rem;
  font-size: 35px;
  border-radius: 100%;
  border: 1px solid #86858589;
  box-shadow: 5px;
  background-color: rgba(129, 116, 116, 0.3);
}

.carousel__prev:hover,
.carousel__next:hover {
  width: 2.5rem;
  height: 2.5rem;
  color: whitesmoke;
  border: 1px solid #dfdcdc89;
  border-radius: 100%;
}</style>