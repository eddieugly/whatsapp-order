<template>
  <Head :title="title" />
  <FrontEndLayout>

    <CheckoutBreadcrumbs
      current-page="Checkout Page"
      :middle-page="title"
      :middle-page-link="route('frontend.checkout.index')" />

    <CheckoutSection />

  </FrontEndLayout>
</template>

<script setup>
import { computed, ref } from 'vue';
import FrontEndLayout from '../../Layouts/FrontEndLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import CheckoutBreadcrumbs from '@/Components/Frontend/CheckoutBreadcrumbs.vue';
import CheckoutSection from '@/Components/Frontend/CheckoutSection.vue';

import { useCartStore } from '@/Store/cart';
import { storeToRefs } from 'pinia';


const cartStore = useCartStore();
const { cart } = storeToRefs(cartStore);

const props = defineProps({
  title: {
    type: String,
    default: 'Checkout',
  }
});

const page = usePage().props;

const form = useForm({
  customer_name: page.auth.user?.name ?? '',
  customer_email: page.auth.user?.email ?? '',
  customer_phone: '',
});

const submit = () => {
    form.post(route(''), {
        forceFormData: true,
    });
};

const payButton = ref(true);
const orderButton = ref(false);

const payNow = () => {
  payButton.value = true;
  orderButton.value = false;
  console.log('Checked PayNow');
};
const orderNow = () => {
  payButton.value = false;
  orderButton.value = true;

  console.log('Checked OrderNow');
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

<style scoped>.carousel__slide {
  padding: 5px;
}</style>