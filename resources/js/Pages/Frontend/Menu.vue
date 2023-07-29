<template>
  <Head :title="title" />
  <FrontEndLayout>

    <section class="bg-gray-50 dark:bg-gray-900">
      <div class="py-8 px-2 mx-auto max-w-screen-xl md:px-0">
        <CategoriesBreadcrumbs class="shadow-md" :current-page="menu.name" middle-page="Menus"
          :middle-page-link="route('frontend.menus')" />
      </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
      <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">
        <div class="lg:col-gap-12 xl:col-gap-16 mt-8 grid grid-cols-1 gap-12 lg:mt-12 lg:grid-cols-5 lg:gap-16">
          <div class="lg:col-span-3 lg:row-end-1">
            <div class="lg:flex lg:items-start">
              <img class="w-full h-full object-cover" :src="menu.thumbnail" alt="Product Image">
            </div>
          </div>

          <div class="lg:col-span-2 lg:row-span-2 lg:row-end-2">
            <h1 class="sm: text-2xl font-bold text-gray-900 sm:text-3xl">{{ menu.name }}</h1>

            <div class="mt-5 flex items-center">
              <div class="flex items-center">
                <svg class="block h-4 w-4 align-middle text-yellow-500" xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20" fill="currentColor">
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                    class=""></path>
                </svg>
                <svg class="block h-4 w-4 align-middle text-yellow-500" xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20" fill="currentColor">
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                    class=""></path>
                </svg>
                <svg class="block h-4 w-4 align-middle text-yellow-500" xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20" fill="currentColor">
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                    class=""></path>
                </svg>
                <svg class="block h-4 w-4 align-middle text-yellow-500" xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20" fill="currentColor">
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                    class=""></path>
                </svg>
                <svg class="block h-4 w-4 align-middle text-yellow-500" xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20" fill="currentColor">
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                    class=""></path>
                </svg>
              </div>
            </div>

            <h2 class="mt-8 text-base text-gray-900">Side Type</h2>
            <div class="mt-3 flex select-none flex-wrap items-center gap-1">
              <label class="">
                <input type="radio" name="type" value="Powder" class="peer sr-only" checked />
                <p
                  class="peer-checked:bg-yellow-800 peer-checked:text-white px-6 py-2 font-bold text-gray-900 rounded-lg border border-orange-300 hover:bg-orange-200 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 cursor-pointer">
                  Powder</p>
              </label>
              <label class="">
                <input type="radio" name="type" value="Whole Bean" class="peer sr-only" />
                <p
                  class="peer-checked:bg-yellow-800 peer-checked:text-white px-6 py-2 font-bold text-gray-900 rounded-lg border border-orange-300 hover:bg-orange-200 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 cursor-pointer">
                  Whole Bean</p>
              </label>
              <label class="">
                <input type="radio" name="type" value="Groud" class="peer sr-only" />
                <p
                  class="peer-checked:bg-yellow-800 peer-checked:text-white px-6 py-2 font-bold text-gray-900 rounded-lg border border-orange-300 hover:bg-orange-200 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 cursor-pointer">
                  Groud</p>
              </label>
            </div>

            <h2 class="mt-8 text-base text-gray-900">Extra Chicken?</h2>
            <div class="mt-3 flex select-none flex-wrap items-center gap-1">
              <label class="">
                <input type="radio" name="subscription" value="4 Months" class="peer sr-only" />
                <p
                  class="peer-checked:bg-yellow-800 peer-checked:text-white px-6 py-2 font-bold text-gray-900 rounded-lg border border-orange-300 hover:bg-orange-200 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 cursor-pointer">
                  4 Months</p>
                <span class="mt-1 block text-center text-xs">₦1,950</span>
              </label>
              <label class="">
                <input type="radio" name="subscription" value="8 Months" class="peer sr-only" checked />
                <p
                  class="peer-checked:bg-yellow-800 peer-checked:text-white px-6 py-2 font-bold text-gray-900 rounded-lg border border-orange-300 hover:bg-orange-200 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 cursor-pointer">
                  8 Months</p>
                <span class="mt-1 block text-center text-xs">₦2,050</span>
              </label>
              <label class="">
                <input type="radio" name="subscription" value="12 Months" class="peer sr-only" />
                <p
                  class="peer-checked:bg-yellow-800 peer-checked:text-white px-6 py-2 font-bold text-gray-900 rounded-lg border border-orange-300 hover:bg-orange-200 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 cursor-pointer">
                  12 Months</p>
                <span class="mt-1 block text-center text-xs">₦1,800</span>
              </label>
            </div>

            <div
              class="mt-10 flex flex-col items-center justify-between space-y-4 border-t border-b py-4 sm:flex-row sm:space-y-0">
              <div class="flex items-end">
                <h1 class="text-3xl font-bold">₦{{ menu.price.toLocaleString() }}</h1>
              </div>

              <button type="button" :disabled="isAlreadyInCart(menu.id)" @click="addToCart(menu)"
                class="inline-flex items-center justify-center text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm px-12 py-3 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-orange-800 transition-all duration-200 ease-in-out focus:shadow">
                <svg class="w-[20px] h-[20px] shrink-0 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  fill="none" viewBox="0 0 18 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1" />
                </svg>
                <span v-if="isAlreadyInCart">Item Added</span>
                <span v-else>Add to cart</span>
              </button>
            </div>

            <ul class="mt-8 space-y-2">
              <li class="flex items-center text-left text-sm font-medium text-gray-600">
                <svg class="mr-2 block h-5 w-5 align-middle text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                    class=""></path>
                </svg>
                Free shipping worldwide
              </li>

              <li class="flex items-center text-left text-sm font-medium text-gray-600">
                <svg class="mr-2 block h-5 w-5 align-middle text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" class="">
                  </path>
                </svg>
                Cancel Anytime
              </li>
            </ul>
          </div>

          <div class="lg:col-span-3">
            <div class="border-b border-gray-300">
              <nav class="flex gap-4">
                <Link :href="route('frontend.menu.index', { id: menu.slug })" title=""
                  class="border-b-2 border-gray-900 py-4 text-sm font-medium text-gray-900 hover:border-gray-400 hover:text-gray-800">
                Menu Description
                </Link>
              </nav>
            </div>

            <div class="mt-8 flow-root sm:mt-12">
              {{ menu.description }}
            </div>
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
import { computed, toRef } from 'vue';
import FrontEndLayout from '../../Layouts/FrontEndLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import FoodOrder from '@/Components/Frontend/Svg/FoodOrder.vue';
import OrderCheckout from '@/Components/Frontend/Svg/OrderCheckout.vue';
import OrderPickUp from '@/Components/Frontend/Svg/OrderPickUp.vue';
import { TheCard } from 'flowbite-vue';
import MenuCarousel from '@/Components/Frontend/MenuCarousel.vue';
import CategoriesBreadcrumbs from '@/Components/Frontend/CategoriesBreadcrumbs.vue';
import MenuPageCarousel from '@/Components/Frontend/MenuPageCarousel.vue';
import { Slide } from 'vue3-carousel';

import { useCartStore } from '@/Store/cart';
import { storeToRefs } from 'pinia';

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