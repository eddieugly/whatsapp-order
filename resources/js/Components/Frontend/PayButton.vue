<template>
  <button
    @click="makePayment"
    class="inline-flex items-center justify-center mt-4 mb-8 w-full rounded-md bg-yellow-700 px-6 py-3 font-medium text-white hover:bg-yellow-800"
  >
    <svg
      class="w-[20px] h-[20px] shrink-0 mr-3"
      aria-hidden="true"
      xmlns="http://www.w3.org/2000/svg"
      fill="none"
      viewBox="0 0   20 20"
    >
      <path
        stroke="currentColor"
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="M11.905 1.316 15.633 6M18 10h-5a2 2 0 0 0-2 2v1a2 2 0 0 0 2 2h5m0-5a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1m0-5V7a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h15a1 1 0 0 0 1-1v-3m-6.367-9L7.905 1.316 2.352 6h9.281Z"
      />
    </svg>
    Pay & Order
  </button>
</template>

<script setup>
import { computed } from "vue";
import { useCartStore } from "@/Store/cart";
import { storeToRefs } from "pinia";

const cartStore = useCartStore();
const { cart } = storeToRefs(cartStore);

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
      verifyTransactionOnBackend(payment.id);
    },
    onclose: function (incomplete) {
      modal.close();
    },
    meta: {
      consumer_id: 23,
      consumer_mac: "92a3-912ba-1192a",
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

<style lang="scss" scoped></style>
