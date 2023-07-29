<template>
  <Head :title="title" />
  <FrontEndLayout>

    <section class="bg-gray-50 dark:bg-gray-900">
      <div class="pt-8 px-2 mx-auto max-w-screen-xl md:px-0">
        <Breadcrumbs class="shadow-md" current-page="Our Menu" middle-page="Menus"
          :middle-page-link="route('frontend.menus')" />
      </div>
    </section>

    <section class="bg-gray-50 dark:bg-gray-900">
      <div class="py-8 px-2 mx-auto max-w-screen-xl md:px-0">
        <div class="w-full">
          <!-- Start coding here -->
          <div class="relative bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
            <div class="flex-row items-center justify-between p-4 space-y-3 sm:flex sm:space-y-0 sm:space-x-4">
              <div>
                <h5 class="mr-3 font-semibold dark:text-white">Our Menu</h5>
                <p class="text-gray-500 dark:text-gray-400">Select a category to view relating menu.</p>
              </div>
              <AllMenuFilters :myfilters="props.filters" :categories="all_categories" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="bg-orange-50 dark:bg-gray-900">
      <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
        <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
          <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Our Menus</h2>
          <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">Take a quick peek at our featured
            food menus. Add all food menu of your choice to cart and proceed.</p>
        </div>
        <div class="grid gap-8 mb-6 lg:mb-16 lg:grid-cols-3 md:grid-cols-2">
          <div v-for="menu in all_menus" :key="menu.id">
            <the-card class="mx-auto" variant="image" :img-src="menu.thumbnail" img-alt="Food Menu">
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ menu.name }}</h5>
              <p class="font-normal text-gray-700 dark:text-gray-400 py-5">
                {{ menu.description.substring(0, 55) }}...
              </p>
              <div class="flex items-center justify-between">
                <span class="text-3xl font-bold text-gray-900 dark:text-white">₦{{ menu.price.toLocaleString() }}</span>
                <button :disabled="isAlreadyInCart(menu.id)" @click="addToCart(menu)" 
                  class="text-white inline-flex items-center justify-center bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">
                  <svg class="w-[20px] h-[20px] shrink-0 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1" />
                  </svg>

                  <span v-if="isAlreadyInCart(menu.id)">Item Added</span>
                  <span v-else>Add to cart</span>
                </button>
              </div>
            </the-card>
          </div>
        </div>
      </div>
    </section>

    <section class="bg-gray-50 dark:bg-gray-900">
      <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
          <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">How It Works</h2>
          <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">Take a quick peek at our featured
            food menus. Add all food menu of your choice to cart and proceed.</p>
        </div>
        <div class="space-y-8 text-center md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
          <div>
            <div
              class="mx-auto hover:shadow-lg dark:hover:shadow-lg-light max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
              <a href="#">
                <FoodOrder />
                <!-- <a href="https://storyset.com/online">Online illustrations by Storyset</a> -->
              </a>
              <div class="p-5 text-center">
                <a href="#">
                  <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Add Meal To Cart</h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Browser through our menus and add your
                  desired meal to cart.</p>
              </div>
            </div>
          </div>
          <div>
            <div
              class="mx-auto hover:shadow-lg dark:hover:shadow-lg-light max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
              <a href="#">
                <OrderCheckout />
                <!-- <a href="https://storyset.com/online">Online illustrations by Storyset</a> -->
              </a>
              <div class="p-5 text-center">
                <a href="#">
                  <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Proceed To Check Out
                  </h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Browser through our menus and add your
                  desired meal to cart.</p>
              </div>
            </div>
          </div>
          <div>
            <div
              class="mx-auto hover:shadow-lg dark:hover:shadow-lg-light max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
              <a href="#">
                <OrderPickUp />
                <!-- <a href="https://storyset.com/online">Online illustrations by Storyset</a> -->
              </a>
              <div class="p-5 text-center">
                <a href="#">
                  <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Come For Quick PickUp
                  </h5>
                </a>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Follow the address on the map below to pick
                  up your order.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="bg-gray-50 dark:bg-gray-900">
      <div class="py-8 px-4 mx-auto max-w-full h-screen sm:py-16 lg:px-6">
        <iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" title="map" scrolling="no"
          src="https://maps.google.com/maps?width=100%&height=600&hl=en&q=%C4%B0zmir+(My%20Business%20Name)&ie=UTF8&t=&z=14&iwloc=B&output=embed"
          style=""></iframe>
      </div>
    </section>

    <section class="bg-gray-50 dark:bg-gray-900">
      <div class="py-20 px-4 mx-auto max-w-screen-xl sm:py-20 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center mb-12 lg:mb-16">
          <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Menu Slider</h2>
          <p class="font-light text-gray-500 lg:mb-16 sm:text-xl dark:text-gray-400">Take a quick peek at our featured
            food menus. Add all food menu of your choice to cart and proceed.</p>
        </div>
        <div class="">
          <MenuCarousel>
            <Slide v-for="slider in $page.props.slider_menues" :key="slider.id">
              <div class="carousel__item">
                <div
                  class="mx-auto max-w-sm border border-orange-50 rounded-lg shadow dark:bg-orange-50 dark:border-orange-50">
                  <Link :href="route('frontend.menu.index', { id: slider.slug })">
                  <img class="p-0 rounded-t-lg" :src="slider.thumbnail" alt="product image" />
                  </Link>
                  <div class="px-5 py-5">
                    <Link :href="route('frontend.menu.index', { id: slider.slug })">
                    <h5 class="text-xl text-start font-semibold tracking-tight text-gray-900 dark:text-white">{{
                      slider.name }}</h5>
                    </Link>
                    <div class="flex items-center justify-between py-4">
                      <span class="text-xl font-bold text-gray-900 dark:text-white">₦{{ slider.price.toLocaleString()
                      }}</span>
                      <button :disabled="isAlreadyInCart(slider.id)" @click="addToCart(slider)"
                        class="text-white inline-flex items-center justify-center bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-orange-800">
                        <svg class="w-[20px] h-[20px] shrink-0 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                          fill="none" viewBox="0 0 18 20">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1" />
                        </svg>
                        <span v-if="isAlreadyInCart(slider.id)">Item Added</span>
                        <span v-else>Add to cart</span>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </Slide>
          </MenuCarousel>
        </div>
      </div>
    </section>
  </FrontEndLayout>
</template>

<script setup>
import FrontEndLayout from '../../Layouts/FrontEndLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import FoodOrder from '@/Components/Frontend/Svg/FoodOrder.vue';
import OrderCheckout from '@/Components/Frontend/Svg/OrderCheckout.vue';
import OrderPickUp from '@/Components/Frontend/Svg/OrderPickUp.vue';
import MenuCarousel from '@/Components/Frontend/MenuCarousel.vue';
import Breadcrumbs from '@/Components/Frontend/Breadcrumbs.vue';
import { TheCard } from 'flowbite-vue';
import AllMenuFilters from './AllMenuFilters.vue';
import { Slide } from 'vue3-carousel';

import { useCartStore } from '@/Store/cart';
import { storeToRefs } from 'pinia';

const cartStore = useCartStore();
const { cart } = storeToRefs(cartStore);

const props = defineProps({
  category: {
    String,
  },
  all_menus: {
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
  },
  filters: {
    type: Object,
    default: () => ({}),
  },
});

// const menus = toRef(props.all_menus);

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