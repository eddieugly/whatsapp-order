<template>
  <Section class="bg-white">
    <div v-if="!cart.length" class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
      <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
          Your Cart Is Empty
        </h2>
      </div>
      <div class="mx-auto max-w-screen-xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
        <div
          class="mx-auto w-1/3 max-w-sm border border-orange-50 rounded-lg shadow dark:bg-orange-50 dark:border-orange-50">
          <Link :href="route('frontend.menus')">
          <FolderSearch />
          <!-- <a href="https://storyset.com/online">Online illustrations by Storyset</a> -->

          <button
            class="w-full text-white inline-flex items-center justify-center bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-orange-800">
            <AddToCartIcon />
            Continue Shopping
          </button>
          </Link>
        </div>
      </div>
    </div>

    <div v-else class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
      <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
        <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
          Checkout
        </h2>
      </div>
      <div class="grid sm:px-10 lg:grid-cols-2 px-6 xl:px-0">
        <div class="px-4 pt-8">
          <p class="text-xl font-medium">Order Summary</p>
          <p class="text-gray-400">
            Check your items. And select a suitable shipping method.
          </p>

          <div class="mt-8 space-y-3 rounded-lg border bg-white px-2 py-4 sm:px-6">
            <div v-for="menu in cart" :key="menu.id" class="flex flex-col rounded-lg bg-white sm:flex-row">
              <img class="m-2 h-24 w-28 rounded-md border object-cover object-center" :src="menu.thumbnail"
                alt="Menu Thumbnail" />
              <div class="flex w-full flex-col px-4 py-4 items-end">
                <span class="font-semibold">{{ menu.name }}</span>
                <span class="float-right text-gray-400">#{{ menu.id.substring(8, 14) }}</span>
                <p class="font-semibold">
                  <span>{{ menu.quantity }} x </span>₦{{ menu.price.toLocaleString() }}
                </p>
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
          <p class="text-gray-400">
            Complete your order by providing your payment details.
          </p>
          <div class="">
            <form @submit.prevent="submit">
              <label for="customer-name" class="mt-4 mb-2 block text-sm font-medium">FullName</label>
              <div class="relative">
                <input v-model="form.customer_name" type="text" id="customer-name"
                  class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-yellow-500 focus:ring-yellow-500"
                  placeholder="Ahmed Hassan" required />
                <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                  <CheckoutInputUserIcon />
                </div>
              </div>
              <label for="customer-email" class="mt-4 mb-2 block text-sm font-medium">Email</label>
              <div class="relative">
                <input v-model="form.customer_email" type="email" id="customer-email"
                  class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-yellow-500 focus:ring-yellow-500"
                  placeholder="johndoe@example.com" required />
                <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                  <CheckoutInputEmailIcon />
                </div>
              </div>
              <label for="customer-phone" class="mt-4 mb-2 block text-sm font-medium">Phone Number</label>
              <div class="relative">
                <input v-model="form.customer_phone" type="text" id="customer-phone"
                  class="w-full rounded-md border border-gray-200 px-4 py-3 pl-11 text-sm shadow-sm outline-none focus:z-10 focus:border-yellow-500 focus:ring-yellow-500"
                  placeholder="08133001122" />
                <div class="pointer-events-none absolute inset-y-0 left-0 inline-flex items-center px-3">
                  <CheckoutInputPhoneIcon />
                </div>
              </div>
              <input v-model="form.payment_method" type="hidden" id="payment_method" />
              <input v-model="form.amount" type="hidden" id="amount" />
            </form>
            <!-- Total -->
            <div class="mt-6 border-t border-b py-2">
              <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-900">Subtotal</p>
                <p class="font-semibold text-gray-900">
                  ₦ {{ subTotal.toLocaleString() }}
                </p>
              </div>
              <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-900">VAT</p>
                <p class="font-semibold text-gray-900">₦ {{ vatTax.toLocaleString() }}</p>
              </div>
            </div>
            <div class="mt-6 flex items-center justify-between">
              <p class="text-sm font-medium text-gray-900">Total</p>
              <p class="text-2xl font-semibold text-gray-900">
                ₦ {{ total.toLocaleString() }}
              </p>
            </div>
          </div>
          <PayButton v-if="payButton" />

          <button v-show="orderButton" type="submit" @click="submit"
            class="inline-flex items-center justify-center mt-4 mb-8 w-full rounded-md bg-yellow-700 px-6 py-3 font-medium text-white hover:bg-yellow-800">
            <CheckoutNowIcon />
            Order Now
          </button>
        </div>
      </div>
    </div>
  </Section>
</template>

<script setup>
import { computed, ref } from "vue";
import { Link, usePage, useForm } from "@inertiajs/vue3";
import Section from "./Section.vue";
import FolderSearch from "./Svg/FolderSearch.vue";
import CartWalletIcon from "./Icon/CartWalletIcon.vue";
import CartDeleteIcon from "./Icon/CartDeleteIcon.vue";
import AddToCartIcon from "./Icon/AddToCartIcon.vue";
import CheckoutInputUserIcon from "./Icon/CheckoutInputUserIcon.vue";
import CheckoutInputEmailIcon from "./Icon/CheckoutInputEmailIcon.vue";
import CheckoutInputPhoneIcon from "./Icon/CheckoutInputPhoneIcon.vue";

import { useCartStore } from "@/Store/cart";
import { storeToRefs } from "pinia";
import Flutterwave from "./Svg/Flutterwave.vue";
import OrderNow from "./Svg/OrderNow.vue";
import PayButton from "./PayButton.vue";
import CheckoutNowIcon from "./Icon/CheckoutNowIcon.vue";

const cartStore = useCartStore();
const { cart } = storeToRefs(cartStore);

const page = usePage().props;

const form = useForm({
  customer_name: page.auth.user?.name ?? "",
  customer_email: page.auth.user?.email ?? "",
  customer_phone: "",
  amount: "",
  txRef: "",
  payment_method: 1,
  cart: cart,
});

const submit = () => {
  form.post(route("frontend.checkout.store"), {
    preserveScroll: true,
  });
};

const payButton = ref(true);
const orderButton = ref(false);

const payNow = () => {
  payButton.value = true;
  orderButton.value = false;
  form.payment_method = 1;
};
const orderNow = () => {
  payButton.value = false;
  orderButton.value = true;
  form.payment_method = 0;
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

form.amount = total;

let script = document.createElement("script");
script.setAttribute("src", "https://checkout.flutterwave.com/v3.js");
document.head.appendChild(script);

const makePayment = () => {
  const modal = FlutterwaveCheckout({
    public_key: "FLWPUBK_TEST-d30c862a0ea73db4c237c312716c8fae-X",
    tx_ref: generateReference(),
    amount: total,
    currency: "NGN",
    payment_options: "card, banktransfer, ussd",
    callback: function (payment) {
      // Send AJAX verification request to backend
      form.txRef = payment.tx_ref;
      submit();
      verifyTransactionOnBackend(payment.id);
    },
    onclose: function (incomplete) {
      if (incomplete === true) {
        usePage().props.flash.success = "Payment Failed! Try Again";
      }
      modal.close();
    },
    customer: {
      email: "rose@unsinkableship.com",
      phone_number: "08102909304",
      name: "Rose DeWitt Bukater",
    },
    customizations: {
      title: "The Titanic Store",
      description: "Payment for an awesome cruise",
      logo:
        "https://www.logolynx.com/images/logolynx/22/2239ca38f5505fbfce7e55bbc0604386.jpeg",
    },
  });
};

const generateReference = () => {
  let date = new Date();
  return date.getTime().toString();
};
</script>
