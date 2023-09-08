<template>
  <Section class="bg-gray-50">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">

      <SectionHeader header="Featured Categories" description="Browse our featured menu categories and find the perfect meal for you. Click on any of the category to see all associated food menus." />

      <CategoryCarousel v-if="(categories.length >= 3)">

        <Slide v-for="category in categories" :key="category.id">
          <div class="carousel__item">
            <CategoryCard  :background="category.thumbnail">

              <Link :href="route('frontend.category.index', { id: category.slug })">

                <div class="bg-black bg-opacity-20 min-h-100 px-10 flex flex-wrap flex-col pt-52 hover:bg-opacity-75 transform duration-300">
                  <h1 class="text-white text-3xl mb-5 transform translate-y-20 group-hover:translate-y-0 duration-300">
                    {{ category.name }}
                  </h1>
                  <div class="w-16 h-2 bg-yellow-700 rounded-full mb-5 transform translate-y-20 group-hover:translate-y-0 duration-300"></div>
                  <p class="opacity-0 text-white mb-5 text-xl group-hover:opacity-80 transform duration-500">
                    {{ category.description.substring(0, 55) }}...
                  </p>
                </div>

              </Link>

            </CategoryCard>
          </div>
        </Slide>
      
      </CategoryCarousel>

      <div v-if="(categories.length < 3)" class="grid gap-8 mb-6 lg:mb-16 lg:grid-cols-3 md:grid-cols-2" :class="{ 'lg:col-start-2': categories.length == 1 }">

        <CategoryCard v-for="category in categories" :key="category.id" :background="category.thumbnail">

          <Link :href="route('frontend.category.index', { id: category.slug })">

            <div class="bg-black bg-opacity-20 min-h-100 px-10 flex flex-wrap flex-col pt-52 hover:bg-opacity-75 transform duration-300">
              <h1 class="text-white text-3xl mb-5 transform translate-y-20 group-hover:translate-y-0 duration-300">
                {{ category.name }}
              </h1>
              <div class="w-16 h-2 bg-yellow-700 rounded-full mb-5 transform translate-y-20 group-hover:translate-y-0 duration-300"></div>
              <p class="opacity-0 text-white mb-5 text-xl group-hover:opacity-80 transform duration-500">
                {{ category.description.substring(0, 55) }}...
              </p>
            </div>

          </Link>

        </CategoryCard>

      </div>

      <SectionLoadMore :href="route('frontend.categories')" />

    </div>
  </Section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Section from './Section.vue';
import SectionHeader from './SectionHeader.vue';
import SectionLoadMore from './SectionLoadMore.vue';
import CategoryCard from './CategoryCard.vue';
import CategoryCarousel from './CategoryCarousel.vue';
import { Slide } from 'vue3-carousel';

defineProps({
  categories: {
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