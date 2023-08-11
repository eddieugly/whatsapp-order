<template>
  <Section class="bg-white">
    <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
      <div class="mx-auto max-w-screen-sm text-center mb-8 lg:mb-16">
        <h2
          class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white"
        >
          Order Successfull
        </h2>
      </div>
      <div
        class="mx-auto max-w-screen-xl justify-center px-6 md:flex md:space-x-6 xl:px-0"
      >
        <div
          class="mx-auto w-1/3 max-w-sm border border-orange-50 rounded-lg shadow dark:bg-orange-50 dark:border-orange-50"
        >
          <OrderSuccess />
          <!-- <a href="https://storyset.com/online">Online illustrations by Storyset</a> -->
          <Button color="yellow"> Home </Button>
        </div>
      </div>
    </div>
  </Section>
</template>

<script setup>
import { computed } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import Section from "./Section.vue";
import OrderSuccess from "./Svg/OrderSuccess.vue";
import { Button } from "flowbite-vue";
</script>
