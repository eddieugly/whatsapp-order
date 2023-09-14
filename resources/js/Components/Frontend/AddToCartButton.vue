<template>
  <button
    :disabled="isAlreadyInCart(menu.id)"
    @click="addToCart(menu)"
    class="w-full text-white inline-flex items-center justify-center bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-orange-800"
  >
    <AddToCartIcon />
    <span v-if="isAlreadyInCart(menu.id)">Item Added</span>
    <span v-else>Add to cart</span>
  </button>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import AddToCartIcon from "./Icon/AddToCartIcon.vue";
import { useCartStore } from "@/Store/cart";
import { storeToRefs } from "pinia";

const cartStore = useCartStore();
const { cart } = storeToRefs(cartStore);

defineProps({
  menu: Object,
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
  usePage().props.flash.success = "Menu Added To Cart";
};

const isAlreadyInCart = (value) => {
  let res = cart.value.find((c) => c.id === value);
  if (res) return true;
  return false;
};
</script>
