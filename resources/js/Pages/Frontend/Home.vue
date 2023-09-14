<template>
  <Head :title="title" />
  <FrontEndLayout>

    <HeroSection />

    <FeaturedCategorySection :categories="featured_categories" />

    <FeaturedMenuSection :menus="featured_menus" />

    <HowItWorksSection />

    <MapSection />

    <SliderMenuSection>
      <MenuCarousel>
        <Slide v-for="slider in $page.props.slider_menues" :key="slider.id">
          <div class="carousel__item">
            <Card>
              <Link :href="route('frontend.menu.index', { id: slider.slug })">
                <img class="p-0 rounded-t-lg" :src="slider.thumbnail" alt="product image" />
                <div class="p-5">
                  <h5 class="text-xl text-start font-semibold tracking-tight text-gray-900 dark:text-white">{{ slider.name }}</h5>
                  <p class="font-normal text-start text-gray-700 dark:text-gray-400">
                    {{ slider.description.substring(0, 55) }}...
                  </p>
                </div>
              </Link>
              <div class="px-5 pb-5">
                <div class="flex flex-col items-start space-y-3">
                  <span class="text-xl font-bold text-gray-900 dark:text-white">₦ {{ slider.price.toLocaleString() }}</span>
                  <AddToCartButton :menu="slider" />
                </div>
              </div>
              
            </Card>
          </div>
        </Slide>
      </MenuCarousel>
    </SliderMenuSection>


  </FrontEndLayout>
</template>

<script setup>
import FrontEndLayout from '../../Layouts/FrontEndLayout.vue'
import { Head, Link } from '@inertiajs/vue3';
import MenuCarousel from '@/Components/Frontend/MenuCarousel.vue';
import { Slide } from 'vue3-carousel';

import HeroSection from '@/Components/Frontend/HeroSection.vue';
import FeaturedCategorySection from '@/Components/Frontend/FeaturedCategorySection.vue';
import FeaturedMenuSection from '@/Components/Frontend/FeaturedMenuSection.vue';
import HowItWorksSection from '@/Components/Frontend/HowItWorksSection.vue';
import MapSection from '@/Components/Frontend/MapSection.vue';
import SliderMenuSection from '@/Components/Frontend/SliderMenuSection.vue';
import Card from '@/Components/Frontend/Card.vue';
import AddToCartButton from '@/Components/Frontend/AddToCartButton.vue';

defineProps({
  featured_categories: {
    type: Object,
    default: () => ({}),
  },
  featured_menus: {
    type: Object,
    default: () => ({}),
  },
  title: {
    type: String,
    default: 'Menu',
  }
});
</script>

<style scoped>
.carousel__slide {
  padding: 5px;
}

.carousel__prev,
.carousel__next {
  width: 2.5rem;
  height: 2.5rem;
  font-size: 20px;
  border-radius: 100%;
  background-color: rgba(255, 255, 255, 0.3);
}

.carousel__prev:hover,
.carousel__next:hover {
  width: 2.5rem;
  height: 2.5rem;
  color: whitesmoke;
  border-radius: 100%;
}
</style>