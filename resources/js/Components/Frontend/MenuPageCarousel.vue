<template>
  <Carousel :autoplay="4000" v-bind="settings" :breakpoints="breakpoints" :wrap-around="true">
    <Slide v-for="slider in $page.props.slider_menues" :key="slider.id">
      <div class="carousel__item">
        <div class="mx-auto max-w-sm bg-blue-50 border border-orange-50 rounded-lg shadow dark:bg-orange-50 dark:border-orange-50">
          <a href="#">
            <img class="p-0 rounded-t-lg" :src="slider.thumbnail" alt="product image" />
          </a>
          <div class="px-5 py-5">
            <a href="#">
              <h5 class="text-xl text-start font-semibold tracking-tight text-gray-900 dark:text-white">{{ slider.name }}</h5>
            </a>
            <div class="flex items-center justify-between py-4">
              <span class="text-xl font-bold text-gray-900 dark:text-white">₦{{ slider.price.toLocaleString() }}</span>
              <a href="#"
                class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">Add
                to cart</a>
            </div>
          </div>
        </div>
      </div>
    </Slide>

    <template #addons>
      <Navigation />
    </template>
  </Carousel>


  <Carousel id="gallery" :items-to-show="1" :wrap-around="false" v-model="currentSlide">
    <Slide v-for="image in menu.images" :key="image">
      <div class="carousel__item">
        <div v-html="image.html" class="[&_img]:h-48 [&_img]:w-full [&_img]:object-conver"></div>
      </div>
    </Slide>
  </Carousel>

  <Carousel
    id="thumbnails"
    :items-to-show="4"
    :wrap-around="true"
    v-model="currentSlide"
    ref="carousel"
  >
    <Slide v-for="image in menu.images" :key="image">
      <div class="carousel__item" @click="slideTo(image - 1)">
        <div v-html="image.html" class="[&_img]:h-48 [&_img]:w-full [&_img]:object-conver"></div>
      </div>
    </Slide>
  </Carousel>
</template>

<script>
import { defineComponent } from 'vue'
import { Carousel, Navigation, Slide } from 'vue3-carousel'

import 'vue3-carousel/dist/carousel.css';

export default defineComponent({
  name: 'Breakpoints',
  
  components: {
    Carousel,
    Slide,
    Navigation,
    
  },
  data: () => ({
    currentSlide: 0,
    // carousel settings
    settings: {
      itemsToShow: 2.95,
      snapAlign: 'center',
    },
    menu: {
    type: Object,
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
  methods: {
    slideTo(val) {
      this.currentSlide = val
    },
  },
})
</script>

<style scoped>
.carousel__slide {
  padding: 5px;
}
</style>