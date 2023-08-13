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
        itemsToShow: 1.95,
        snapAlign: "center",
      },
      // 1024 and up
      992: {
        itemsToShow: 2.95,
        snapAlign: "center",
      },
      // 1024 and up
      1200: {
        itemsToShow: 3.95,
        snapAlign: "center",
      },
    },
  }),
});
</script>

<style scoped>
.carousel__slide {
  padding: 5px;
}
</style>
