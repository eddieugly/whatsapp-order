<template>

  <Head :title="title" />

  <FrontEndLayout>

    <CategoriesBreadcrumbs :show-dropdown-button="true" :show-dropdown="true" :categories="all_categories" :current-page="category.name" middle-page="Categories" :middle-page-link="route('frontend.categories')" />

    <CategoryMenuSection :category="category" />

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

  </FrontEndLayout>

</template>

<script setup>
import FrontEndLayout from '../../Layouts/FrontEndLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import MenuCarousel from '@/Components/Frontend/MenuCarousel.vue';
import CategoriesBreadcrumbs from '@/Components/Frontend/CategoriesBreadcrumbs.vue';
import { Slide } from 'vue3-carousel';
import CategoryMenuSection from '@/Components/Frontend/CategoryMenuSection.vue';
import HowItWorksSection from '@/Components/Frontend/HowItWorksSection.vue';
import MapSection from '@/Components/Frontend/MapSection.vue';
import SliderMenuSection from '@/Components/Frontend/SliderMenuSection.vue';
import AddToCartButton from '@/Components/Frontend/AddToCartButton.vue';
import Card from '@/Components/Frontend/Card.vue';

defineProps({
  category: {
    type: Object,
    default: () => ({}),
  },
  all_categories: {
    type: Object,
    default: () => ({}),
  },
  title: {
    type: String,
    default: 'Category',
  }
});

</script>

<style scoped>
.carousel__slide {
  padding: 5px;
}
</style>