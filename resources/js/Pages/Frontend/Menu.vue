<template>
  <Head :title="title" />
  <FrontEndLayout>

    <Breadcrumbs
      :current-page="menu.name"
      middle-page="Menus"
      :middle-page-link="route('frontend.menus')" />

    <MenuPreviewSection :menu="menu" />

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
                  <h5 class="text-xl text-start font-semibold tracking-tight text-gray-900 dark:text-white">{{ slider.name
                  }}</h5>
                </div>
              </Link>
              <div class="px-5 pb-5">
                <div class="flex flex-col items-start space-y-3">
                  <span class="text-xl font-bold text-gray-900 dark:text-white">₦{{ slider.price.toLocaleString() }}</span>
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
import { computed, toRef } from 'vue';
import FrontEndLayout from '../../Layouts/FrontEndLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import MenuCarousel from '@/Components/Frontend/MenuCarousel.vue';
import { Slide } from 'vue3-carousel';

import { useCartStore } from '@/Store/cart';
import { storeToRefs } from 'pinia';
import Breadcrumbs from '@/Components/Frontend/Breadcrumbs.vue';
import HowItWorksSection from '@/Components/Frontend/HowItWorksSection.vue';
import MapSection from '@/Components/Frontend/MapSection.vue';
import SliderMenuSection from '@/Components/Frontend/SliderMenuSection.vue';
import Card from '@/Components/Frontend/Card.vue';
import AddToCartButton from '@/Components/Frontend/AddToCartButton.vue';
import MenuPreviewSection from '@/Components/Frontend/MenuPreviewSection.vue';

const cartStore = useCartStore();
const { cart } = storeToRefs(cartStore);

const props = defineProps({
  menu: {
    type: Object,
    default: () => ({}),
  },
  title: {
    type: String,
    default: 'Menu',
  }
});

const menu = toRef(props.menu);

const addToCart = (menu) => {
  cart.value.push({
    id: menu.id,
    slug: menu.slug,
    name: menu.name,
    price: menu.price,
    quantity: 1,
    thumbnail: menu.thumbnail,
  });
};

const isAlreadyInCart = (value) => {
  let res = cart.value.find(c => c.id === value);
  if (res) return true;
  return false
};

</script>

<style scoped>
.carousel__slide {
  padding: 5px;
}
</style>