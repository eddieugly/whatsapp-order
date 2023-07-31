<template>
  <Head :title="title" />
  <FrontEndLayout>

    <section class="bg-gray-50 dark:bg-gray-900">
      <div class="py-8 px-2 mx-auto max-w-screen-xl md:px-0">
        <CategoriesBreadcrumbs class="shadow-md" current-page="Cart Items" :middle-page="title"
          :middle-page-link="route('frontend.cart.index')" />
      </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
      <div v-if="!cart.length" class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
          <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Your Cart Is Empty</h2>
        </div>
        <div class="mx-auto max-w-screen-xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
          <div class="mx-auto w-1/3 max-w-sm border border-orange-50 rounded-lg shadow dark:bg-orange-50 dark:border-orange-50">
            <Link :href="route('frontend.menus')">
              <FolderSearch />
              <!-- <a href="https://storyset.com/online">Online illustrations by Storyset</a> -->

              <button class="w-full text-white inline-flex items-center justify-center bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-orange-800">
                <svg class="w-[20px] h-[20px] shrink-0 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  fill="none" viewBox="0 0 18 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1" />
                </svg>
                Continue Shopping...
              </button>
            </Link>
          </div>
        </div>
      </div>
      <div v-else class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
          <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Cart Items</h2>
        </div>
        <div class="mx-auto max-w-screen-xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
          <div class="rounded-lg md:w-8/12">
            <div v-for="menu in cart" :key="menu.id" class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
              <img :src="menu.thumbnail" alt="Menu Thumbnail" class="w-full rounded-lg sm:w-40" />
              <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
                <div class="mt-5 sm:mt-0">
                  <h2 class="text-lg font-bold text-gray-900">{{ menu.name }}</h2>
                  <p class="mt-1 text-xs text-gray-700">#{{ menu.id.substring(8, 14) }}</p>
                </div>
                <div class="flex justify-between space-x-4">
                  <div class="flex items-center border-gray-100">
                    <button :disabled="menu.quantity === 1" @click="minusQuantity(menu.id)" class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-yellow-700 hover:text-blue-50">
                      <span>
                        -
                      </span>
                    </button>
                    <input class="h-8 w-8 border bg-white text-center text-xs outline-none" type="numeric" :value="menu.quantity" min="1" />
                    <button @click="addQuantity(menu.id)" class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-yellow-700 hover:text-blue-50">
                      <span>
                        +
                      </span>
                    </button>
                  </div>
                  <div class="flex items-center">
                    <p class="text-base"><span>{{ menu.quantity }} x </span>₦{{ menu.price.toLocaleString() }}</p>
                  </div>
                  <div class="flex items-center space-x-4">
                  <button @click="removeFromCart(menu.id)" class="text-gray-800 dark:text-white cursor-pointer duration-150 hover:text-red-500">
                    <svg
                      class="w-[20px] h-[20px]"
                      aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                    </svg>
                  </button>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <!-- Sub total -->
          <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-4/12">
            <div class="mb-2 flex justify-between">
              <p class="text-gray-700">Items</p>
              <p class="text-gray-700">{{ cart.length }}</p>
            </div>
            <div class="mb-2 flex justify-between">
              <p class="text-gray-700">Subtotal</p>
              <p class="text-gray-700">₦{{ total.toLocaleString() }}</p>
            </div>
            <div class="flex justify-between">
              <p class="text-gray-700">VAT</p>
              <p class="text-gray-700">₦{{ vatTax.toLocaleString() }}</p>
            </div>
            <hr class="my-4" />
            <div class="flex justify-between">
              <p class="text-lg font-bold">Total</p>
              <div class="">
                <p class="mb-1 text-right text-lg font-bold">₦{{ (total + vatTax).toLocaleString() }}</p>
                <p class="text-sm text-red-700">including 7% VAT</p>
              </div>
            </div>
            <Link :href="route('frontend.checkout.index')" class="inline-flex items-center justify-center mt-6 w-full rounded-md bg-yellow-700 py-1.5 font-medium text-white hover:bg-yellow-800">
              <svg class="w-[20px] h-[20px] shrink-0 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0   20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11.905 1.316 15.633 6M18 10h-5a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h5m0-5a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1m0-5V7a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h15a1 1 0 0 0 1-1v-3m-6.367-9L7.905 1.316 2.352 6h9.281Z" />
              </svg>
              Checkout
            </Link>
          </div>
        </div>
      </div>
    </section>

    <!-- How It Works Section -->
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
    <!-- End Of How It Works Section -->

    <!-- Map Section -->
    <section class="bg-gray-50 dark:bg-gray-900">
      <div class="py-8 px-4 mx-auto max-w-full h-screen sm:py-16 lg:px-6">
        <iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" title="map" scrolling="no"
          src="https://maps.google.com/maps?width=100%&height=600&hl=en&q=%C4%B0zmir+(My%20Business%20Name)&ie=UTF8&t=&z=14&iwloc=B&output=embed"
          style=""></iframe>
      </div>
    </section>
    <!-- End of Map Section -->

    <!-- Menu Slider Section -->
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
    <!-- End of Menu Slider Section -->

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
import FolderSearch from '@/Components/Frontend/Svg/FolderSearch.vue';

const cartStore = useCartStore();
const { cart } = storeToRefs(cartStore);

const props = defineProps({
  title: {
    type: String,
    default: 'Cart',
  }
});

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


const removeFromCart = (menuID) => {
  cartStore.removeMenuFromCart(menuID);
};

const addQuantity = (menuID) => {
  cartStore.increaseQuantity(menuID);
};

const minusQuantity = (menuID) => {
  cartStore.decreaseQuantity(menuID);
};

const total = computed(() => {
  let total = 0;
  cart.value.forEach(c => {
    total += c.price * c.quantity;
  });
  if (total > 0) {
    return total
  }
  return 0;
});

const vatTax = computed(() => {
  let vatTax = 0;
  cart.value.forEach(c => {
    vatTax += (c.price * c.quantity) * 0.07;
  });
  if (vatTax > 0) {
    return vatTax
  }
  return 0;
});

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