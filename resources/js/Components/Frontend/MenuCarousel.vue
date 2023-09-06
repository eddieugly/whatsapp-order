<template>
  <Carousel
    :autoplay="4000"
    v-bind="settings"
    :breakpoints="breakpoints"
    :wrap-around="true"
  >
    <slot />
    <template #addons>
      <Navigation />
    </template>
  </Carousel>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import { defineComponent } from "vue";
import { Carousel, Navigation, Slide } from "vue3-carousel";

import "vue3-carousel/dist/carousel.css";

export default defineComponent({
  name: "Breakpoints",
  components: {
    Carousel,
    Slide,
    Navigation,
    Link,
  },
  data: () => ({
    // carousel settings
    settings: {
      itemsToShow: 1,
      snapAlign: "center",
    },
    // breakpoints are mobile first
    // any settings not specified will fallback to the carousel settings
    breakpoints: {
      // 700px and up
      700: {
        itemsToShow: 2,
        snapAlign: "start",
      },
      // 1024 and up
      992: {
        itemsToShow: 3,
        snapAlign: "start",
      },
      // 1024 and up
      1200: {
        itemsToShow: 4,
        snapAlign: "start",
      },
    },
  }),
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
