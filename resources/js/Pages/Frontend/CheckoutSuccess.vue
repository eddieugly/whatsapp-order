<template>
  <Head :title="title" />
  <FrontEndLayout>
    <Breadcrumbs
      current-page="Success"
      middle-page="Order"
      :middle-page-link="route('frontend.menus')"
    />

    <!-- Order Success Section -->
    <OrderSuccessSection :order-id="orderId" :order-status="orderStatus" />
    <!-- End of Order Success Section -->

    <!-- How It Works Section -->
    <HowItWorksSection />
    <!-- End Of How It Works Section -->
  </FrontEndLayout>
</template>

<script setup>
import { computed, toRef, onMounted } from "vue";
import FrontEndLayout from "../../Layouts/FrontEndLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import MenuCarousel from "@/Components/Frontend/MenuCarousel.vue";
import { Slide } from "vue3-carousel";
import HowItWorksSection from "@/Components/Frontend/HowItWorksSection.vue";
import MapSection from "@/Components/Frontend/MapSection.vue";
import SliderMenuSection from "@/Components/Frontend/SliderMenuSection.vue";
import Card from "@/Components/Frontend/Card.vue";
import AddToCartButton from "@/Components/Frontend/AddToCartButton.vue";
import OrderSuccessBreadcrumbs from "@/Components/Frontend/OrderSuccessBreadcrumbs.vue";
import OrderSuccessSection from "@/Components/Frontend/OrderSuccessSection.vue";

import { useCartStore } from "@/Store/cart";
import { storeToRefs } from "pinia";
import Breadcrumbs from "@/Components/Frontend/Breadcrumbs.vue";

const cartStore = useCartStore();
const { cart } = storeToRefs(cartStore);

const props = defineProps({
  title: {
    type: String,
    default: "Cart",
  },
  orderId: {
    type: String,
  },
  orderStatus: {
    type: String,
  },
});

onMounted(() => {
  cart.value = [];
});
</script>

<style scoped>
.carousel__slide {
  padding: 5px;
}
</style>
