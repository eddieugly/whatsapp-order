<template>
  <Carousel :autoplay="4000" v-bind="settings" :breakpoints="breakpoints" :wrap-around="true">
    <Slide v-for="slider in $page.props.slider_menues" :key="slider.id">
      <div class="carousel__item">
        <div class="mx-auto max-w-sm border border-orange-50 rounded-lg shadow dark:bg-orange-50 dark:border-orange-50">
          <Link :href="route('frontend.menu.index', { id: slider.slug })">
            <img class="p-0 rounded-t-lg" :src="slider.thumbnail" alt="product image" />
          </Link>
          <div class="px-5 py-5">
            <Link :href="route('frontend.menu.index', { id: slider.slug })">
              <h5 class="text-xl text-start font-semibold tracking-tight text-gray-900 dark:text-white">{{ slider.name }}</h5>
            </Link>
            <div class="flex items-center justify-between py-4">
              <span class="text-xl font-bold text-gray-900 dark:text-white">₦{{ slider.price.toLocaleString() }}</span>
              <Link :href="route('frontend.menu.index', { id: slider.slug })" class="text-white inline-flex items-center justify-center bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-orange-800">
                  <svg class="w-[20px] h-[20px] shrink-0 mr-3" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1" />
                  </svg>
                Add to cart
              </Link>
            </div>
          </div>
        </div>
      </div>
    </Slide>

    <template #addons>
      <Navigation />
    </template>
  </Carousel>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import { defineComponent } from 'vue'
import { Carousel, Navigation, Slide } from 'vue3-carousel'

import 'vue3-carousel/dist/carousel.css';

export default defineComponent({
  name: 'Breakpoints',
  components: {
    Carousel,
    Slide,
    Navigation,
    Link
},
  data: () => ({
    // carousel settings
    settings: {
      itemsToShow: 1,
      snapAlign: 'center',
    },
    // breakpoints are mobile first
    // any settings not specified will fallback to the carousel settings
    breakpoints: {
      // 700px and up
      700: {
        itemsToShow: 2.95,
        snapAlign: 'center',
      },
      // 1024 and up
      1024: {
        itemsToShow: 3.95,
        snapAlign: 'center',
      },
    },
  }),
})
</script>

<style scoped>
.carousel__slide {
  padding: 5px;
}
</style>