<template>
  <Head :title="title" />
  <FrontEndLayout>

    <Breadcrumbs
      current-page="Cart Items"
      :middle-page="title"
      :middle-page-link="route('frontend.cart.index')" />

    <!-- Cart Section -->
    <CartSection />
    <!-- End of Cart Section -->

    <!-- How It Works Section -->
    <HowItWorksSection />
    <!-- End Of How It Works Section -->

    <!-- Map Section -->
    <MapSection />
    <!-- End of Map Section -->

    <!-- Menu Slider Section -->
    <SliderMenuSection>
      <MenuCarousel>
        <Slide v-for="slider in $page.props.slider_menues" :key="slider.id">
          <div class="carousel__item">
            <Card>
              <Link :href="route('frontend.menu.index', { id: slider.slug })">
                <img class="p-0 rounded-t-lg" :src="slider.thumbnail" alt="product image" />
                <div class="p-5">
                  <h5 class="text-xl text-start font-semibold tracking-tight text-gray-900 dark:text-white">{{ slider.name
                  }}</h5>
                </div>
              </Link>
              <div class="px-5 pb-5">
                <div class="flex items-center justify-between py-4">
                  <span class="text-xl font-bold text-gray-900 dark:text-white">₦{{ slider.price.toLocaleString() }}</span>
                  <AddToCartButton :menu="slider" />
                </div>
              </div>
              
            </Card>
          </div>
        </Slide>
      </MenuCarousel>
    </SliderMenuSection>
    <!-- End of Menu Slider Section -->

  </FrontEndLayout>
</template>

<script setup>
import { computed, toRef } from 'vue';
import FrontEndLayout from '../../Layouts/FrontEndLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import MenuCarousel from '@/Components/Frontend/MenuCarousel.vue';
import { Slide } from 'vue3-carousel';
import FolderSearch from '@/Components/Frontend/Svg/FolderSearch.vue';
import Breadcrumbs from '@/Components/Frontend/Breadcrumbs.vue';
import CartSection from '@/Components/Frontend/CartSection.vue';
import HowItWorksSection from '@/Components/Frontend/HowItWorksSection.vue';
import MapSection from '@/Components/Frontend/MapSection.vue';
import SliderMenuSection from '@/Components/Frontend/SliderMenuSection.vue';
import Card from '@/Components/Frontend/Card.vue';
import AddToCartButton from '@/Components/Frontend/AddToCartButton.vue';


const props = defineProps({
  title: {
    type: String,
    default: 'Cart',
  }
});
</script>

<style scoped>
.carousel__slide {
  padding: 5px;
}
</style>