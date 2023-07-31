<template>
  <Head :title="title" />
  <FrontEndLayout>

    <section class="bg-gray-50 dark:bg-gray-900">
      <div class="py-8 px-2 mx-auto max-w-screen-xl md:px-0">
        <CategoriesBreadcrumbs class="shadow-md" current-page="Checkout Page" :middle-page="title"
          :middle-page-link="route('frontend.checkout.index')" />
      </div>
    </section>

    <section class="bg-gray-50 dark:bg-gray-900">
      <div class="py-8 px-2 mx-auto max-w-screen-xl md:px-0">
        <div class="flex flex-col items-center border-b bg-white py-4 sm:flex-row px-5 rounded-lg shadow-md">
          <div class="mt-4 py-2 text-xs sm:mt-0 sm:ml-auto sm:text-base">
            <div class="relative">
              <ul class="relative flex w-full items-center justify-between space-x-2 sm:space-x-4">
                <li class="flex items-center space-x-3 text-left sm:space-x-4">
                  <a class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-200 text-xs font-semibold text-emerald-700"
                    href="#"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                      stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg></a>
                  <span class="font-semibold text-gray-900">Shop</span>
                </li>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
                <li class="flex items-center space-x-3 text-left sm:space-x-4">
                  <a class="flex h-6 w-6 items-center justify-center rounded-full bg-yellow-600 text-xs font-semibold text-white ring ring-yellow-600 ring-offset-2"
                    href="#">2</a>
                  <span class="font-semibold text-gray-900">Order</span>
                </li>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
                <li class="flex items-center space-x-3 text-left sm:space-x-4">
                  <a class="flex h-6 w-6 items-center justify-center rounded-full bg-orange-200 text-xs font-semibold text-gray-500"
                    href="#">3</a>
                  <span class="font-semibold text-gray-500">Payment</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
      <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
          <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Checkout</h2>
        </div>
        <div class="grid sm:px-10 lg:grid-cols-2 px-6 xl:px-0">
          <div class="px-4 pt-8">
            <p class="text-xl font-medium">Order Summary</p>
            <p class="text-gray-400">Check your items. And select a suitable shipping method.</p>
            <div class="mt-8 space-y-3 rounded-lg border bg-white px-2 py-4 sm:px-6">
              <div v-for="menu in cart" :key="menu.id" class="flex flex-col rounded-lg bg-white sm:flex-row">
                <img class="m-2 h-24 w-28 rounded-md border object-cover object-center"
                  :src="menu.thumbnail"
                  alt="Menu Thumbnail" />
                <div class="flex w-full flex-col px-4 py-4 items-end">
                  <span class="font-semibold">{{ menu.name }}</span>
                  <span class="float-right text-gray-400">#{{ menu.id.substring(8, 14) }}</span>
                  <p class="font-semibold"><span>{{ menu.quantity }} x </span>₦{{ menu.price.toLocaleString() }}</p>
                </div>
              </div>
            </div>

            <p class="mt-8 text-lg font-medium">Payment Methods</p>
            <form class="mt-5 grid gap-6">
              <div class="relative">
                <input @input="payNow" class="peer hidden" id="radio_1" type="radio" name="radio" checked />
                <span
                  class="peer-checked:border-yellow-500 absolute right-4 top-1/2 box-content block h-3 w-3 -translate-y-1/2 rounded-full border-8 border-yellow-100 bg-white"></span>
                <label
                  class="peer-checked:border-2 peer-checked:border-yellow-500 peer-checked:bg-gray-50 flex cursor-pointer select-none rounded-lg border border-yellow-300 p-4"
                  for="radio_1">
                  <Flutterwave />
                  <div class="ml-5">
                    <span class="mt-2 font-semibold">Pay Now</span>
                    <p class="text-slate-500 text-sm leading-6">Pickup at location</p>
                  </div>
                </label>
              </div>
              <div class="relative">
                <input @input="orderNow" class="peer hidden" id="radio_2" type="radio" name="radio" />
                <span
                  class="peer-checked:border-yellow-500 absolute right-4 top-1/2 box-content block h-3 w-3 -translate-y-1/2 rounded-full border-8 border-yellow-100 bg-white"></span>
                <label
                  class="peer-checked:border-2 peer-checked:border-yellow-500 peer-checked:bg-gray-50 flex cursor-pointer select-none rounded-lg border border-yellow-300 p-4"
                  for="radio_2">
                  <OrderNow />
                  <div class="ml-5">
                    <span class="mt-2 font-semibold">Pay on Pickup</span>
                    <p class="text-slate-500 text-sm leading-6">Pay & Pickup at location</p>
                  </div>
                </label>
              </div>
            </form>
          </div>
          <div class="mt-10 bg-gray-50 px-4 pt-8 lg:mt-0">
            <p class="text-xl font-medium">Payment Details</p>
            <p class="text-gray-400">Complete your order by providing your payment details.</p>
            <div class="">
              <form @submit.prevent="submit">
                <label for="customer-name" class="mt-4 mb-2 block text-sm font-medium">FullName</label>
                <div class="relative">
                  <input type="text" id="customer-name" name="customer-name"
                    class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-yellow-500 focus:ring-yellow-500"
                    placeholder="Ahmed Hassan" required />
                  <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                    <svg class="w-4 h-4 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 18">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-2 3h4a4 4 0 0 1 4 4v2H1v-2a4 4 0 0 1 4-4Z"/>
                    </svg>
                  </div>
                </div>
                <label for="customer-email" class="mt-4 mb-2 block text-sm font-medium">Email</label>
                <div class="relative">
                  <input type="email" id="customer-email" name="customer-email"
                    class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-yellow-500 focus:ring-yellow-500"
                    placeholder="johndoe@example.com" required />
                  <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                      stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                  </div>
                </div>
                <label for="customer-phone" class="mt-4 mb-2 block text-sm font-medium">Phone Number</label>
                <div class="relative">
                  <input type="text" id="customer-phone" name="customer-phone"
                    class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-yellow-500 focus:ring-yellow-500"
                    placeholder="08133001122" />
                  <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                    <svg class="w-4 h-4 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 20">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 14h12M1 4h12M6.5 16.5h1M2 1h10a1 1 0 0 1 1 1v16a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Z"/>
                    </svg>
                  </div>
                </div>
              </form>
              <!-- Total -->
              <div class="mt-6 border-t border-b py-2">
                <div class="flex items-center justify-between">
                  <p class="text-sm font-medium text-gray-900">Subtotal</p>
                  <p class="font-semibold text-gray-900">₦ {{ total.toLocaleString() }}</p>
                </div>
                <div class="flex items-center justify-between">
                  <p class="text-sm font-medium text-gray-900">VAT</p>
                  <p class="font-semibold text-gray-900">₦ {{ vatTax.toLocaleString() }}</p>
                </div>
              </div>
              <div class="mt-6 flex items-center justify-between">
                <p class="text-sm font-medium text-gray-900">Total</p>
                <p class="text-2xl font-semibold text-gray-900">₦ {{ (total + vatTax).toLocaleString() }}</p>
              </div>
            </div>
            <button v-show="payButton" class="inline-flex items-center justify-center mt-4 mb-8 w-full rounded-md bg-yellow-700 px-6 py-3 font-medium text-white hover:bg-yellow-800">
              <svg class="w-[20px] h-[20px] shrink-0 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0   20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11.905 1.316 15.633 6M18 10h-5a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h5m0-5a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1m0-5V7a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h15a1 1 0 0 0 1-1v-3m-6.367-9L7.905 1.316 2.352 6h9.281Z" />
              </svg>
              Pay & Order
            </button>

            <button v-show="orderButton" type="submit" class="inline-flex items-center justify-center mt-4 mb-8 w-full rounded-md bg-yellow-700 px-6 py-3 font-medium text-white hover:bg-yellow-800">
              <svg class="w-[20px] h-[20px] shrink-0 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9V4a3 3 0 0 0-6 0v5m9.92 10H2.08a1 1 0 0 1-1-1.077L2 6h14l.917 11.923A1 1 0 0 1 15.92 19Z"/>
              </svg>
              Order Now
            </button>
          </div>
        </div>
      </div>
    </section>

  </FrontEndLayout>
</template>

<script setup>
import { computed, ref } from 'vue';
import FrontEndLayout from '../../Layouts/FrontEndLayout.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import CategoriesBreadcrumbs from '@/Components/Frontend/CategoriesBreadcrumbs.vue';

import { useCartStore } from '@/Store/cart';
import { storeToRefs } from 'pinia';
import Flutterwave from '@/Components/Frontend/Svg/Flutterwave.vue';
import OrderNow from '@/Components/Frontend/Svg/OrderNow.vue';

const cartStore = useCartStore();
const { cart } = storeToRefs(cartStore);

const props = defineProps({
  title: {
    type: String,
    default: 'Cart',
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