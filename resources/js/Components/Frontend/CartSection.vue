<template>
  <Section class="bg-white">
    <div v-if="!cart.length" class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
      <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
        <h2
          class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white"
        >
          Your Cart Is Empty
        </h2>
      </div>
      <div
        class="mx-auto max-w-screen-xl justify-center px-6 md:flex md:space-x-6 xl:px-0"
      >
        <div
          class="mx-auto w-1/3 max-w-sm border border-orange-50 rounded-lg shadow dark:bg-orange-50 dark:border-orange-50"
        >
          <Link :href="route('frontend.menus')">
            <FolderSearch />
            <!-- <a href="https://storyset.com/online">Online illustrations by Storyset</a> -->

            <button
              class="w-full text-white inline-flex items-center justify-center bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-orange-800"
            >
              <AddToCartIcon />
              Continue Shopping
            </button>
          </Link>
        </div>
      </div>
    </div>

    <div v-else class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
      <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
        <h2
          class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white"
        >
          Cart Items
        </h2>
      </div>
      <div
        class="mx-auto max-w-screen-xl justify-center px-6 md:flex md:space-x-6 xl:px-0"
      >
        <div class="rounded-lg md:w-8/12">
          <div
            v-for="menu in cart"
            :key="menu.id"
            class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start"
          >
            <img
              :src="menu.thumbnail"
              alt="Menu Thumbnail"
              class="w-full rounded-lg sm:w-40"
            />
            <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
              <div class="mt-5 sm:mt-0">
                <h2 class="text-lg font-bold text-gray-900">{{ menu.name }}</h2>
                <p class="mt-1 text-xs text-gray-700">#{{ menu.id.substring(8, 14) }}</p>
              </div>
              <div class="flex justify-between space-x-4">
                <div class="flex items-center border-gray-100">
                  <button
                    :disabled="menu.quantity === 1"
                    @click="minusQuantity(menu.id)"
                    class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-yellow-700 hover:text-blue-50"
                  >
                    <span> - </span>
                  </button>
                  <input
                    class="h-8 w-8 border bg-white text-center text-xs outline-none"
                    type="numeric"
                    :value="menu.quantity"
                    min="1"
                  />
                  <button
                    @click="addQuantity(menu.id)"
                    class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-yellow-700 hover:text-blue-50"
                  >
                    <span> + </span>
                  </button>
                </div>
                <div class="flex items-center">
                  <p class="text-base">
                    <span>{{ menu.quantity }} x </span>₦{{ menu.price.toLocaleString() }}
                  </p>
                </div>
                <div class="flex items-center space-x-4">
                  <button
                    @click="removeFromCart(menu.id)"
                    class="text-gray-800 dark:text-white cursor-pointer duration-150 hover:text-red-500"
                  >
                    <CartDeleteIcon />
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Sub total -->
        <div
          class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-4/12"
        >
          <div class="mb-2 flex justify-between">
            <p class="text-gray-700">Items</p>
            <p class="text-gray-700">{{ cart.length }}</p>
          </div>
          <div class="mb-2 flex justify-between">
            <p class="text-gray-700">Subtotal</p>
            <p class="text-gray-700">₦{{ subTotal.toLocaleString() }}</p>
          </div>
          <div class="flex justify-between">
            <p class="text-gray-700">VAT</p>
            <p class="text-gray-700">₦{{ vatTax.toLocaleString() }}</p>
          </div>
          <hr class="my-4" />
          <div class="flex justify-between">
            <p class="text-lg font-bold">Total</p>
            <div class="">
              <p class="mb-1 text-right text-lg font-bold">
                ₦{{ total.toLocaleString() }}
              </p>
              <p class="text-sm text-red-700">including 7% VAT</p>
            </div>
          </div>
          <Link
            :href="route('frontend.checkout.index')"
            class="inline-flex items-center justify-center mt-6 w-full rounded-md bg-yellow-700 py-1.5 font-medium text-white hover:bg-yellow-800"
          >
            <CartWalletIcon />
            Checkout
          </Link>
        </div>
      </div>
    </div>
  </Section>
</template>

<script setup>
import { computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import Section from "./Section.vue";
import FolderSearch from "./Svg/FolderSearch.vue";
import CartWalletIcon from "./Icon/CartWalletIcon.vue";
import CartDeleteIcon from "./Icon/CartDeleteIcon.vue";

import { useCartStore } from "@/Store/cart";
import { storeToRefs } from "pinia";
import AddToCartIcon from "./Icon/AddToCartIcon.vue";

const cartStore = useCartStore();
const { cart } = storeToRefs(cartStore);

const removeFromCart = (menuID) => {
  cartStore.removeMenuFromCart(menuID);
  usePage().props.flash.error = "Menu Removed To Cart";
};

const addQuantity = (menuID) => {
  cartStore.increaseQuantity(menuID);
};

const minusQuantity = (menuID) => {
  cartStore.decreaseQuantity(menuID);
};

const subTotal = computed(() => {
  let subTotal = 0;
  cart.value.forEach((c) => {
    subTotal += c.price * c.quantity;
  });
  if (subTotal > 0) {
    return subTotal;
  }
  return 0;
});

const vatTax = computed(() => {
  let vatTax = 0;
  cart.value.forEach((c) => {
    vatTax += c.price * c.quantity * 0.07;
  });
  if (vatTax > 0) {
    return vatTax;
  }
  return 0;
});

const total = computed(() => {
  let vatTax = 0;
  let total = 0;
  cart.value.forEach((c) => {
    vatTax += c.price * c.quantity * 0.07;
    total += c.price * c.quantity + vatTax;
  });
  if (total > 0) {
    return total;
  }
  return 0;
});
</script>
