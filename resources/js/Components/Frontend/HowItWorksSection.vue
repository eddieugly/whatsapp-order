<template>
  <Section class="bg-gray-50">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6 ">

      <SectionHeader header="How It Works"
        description="Take a quick peek at our featured food menus. Add all food menu of your choice to cart and proceed." />

      <div class="grid gap-8 mb-6 lg:mb-16 lg:grid-cols-3 md:grid-cols-2">
        <Card>
          <FoodOrder />
          <!-- <a href="https://storyset.com/online">Online illustrations by Storyset</a> -->
          <div class="p-5 text-center">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Add Meal To Cart</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Take a quick peek at our featured
            food menus. Add all food menu of your choice to cart and proceed.</p>
          </div>
        </Card>

        <Card>
          <OrderCheckout />
          <!-- <a href="https://storyset.com/online">Online illustrations by Storyset</a> -->
          <div class="p-5 text-center">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Proceed To Check Out</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Browser through our menus and add your desired meal to cart.</p>
          </div>
        </Card>

        <Card>
          <OrderPickUp />
          <!-- <a href="https://storyset.com/online">Online illustrations by Storyset</a> -->
          <div class="p-5 text-center">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Come For Quick PickUp</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Follow the address on the map below to pick up your order.</p>
          </div>
        </Card>
      </div>
    </div>
  </Section>
</template>

<script setup>
import Section from './Section.vue';
import SectionHeader from './SectionHeader.vue';
import Card from './Card.vue';
import FoodOrder from './Svg/FoodOrder.vue';
import OrderCheckout from './Svg/OrderCheckout.vue';
import OrderPickUp from './Svg/OrderPickUp.vue';
</script>