<template>
  <div class="antialiased">
    <!-- NavBar -->
    <header>
      <nav class="bg-transparent border-gray-200 px-4 lg:px-6 py-4 dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
          <Link href="/" class="flex items-center">
          <Logo class="" />
          <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">{{
            $page.props.general.company_name }}</span>
          </Link>
          <div class="flex items-center lg:order-2">
            <!-- phone number -->
            <div class="ml-auto mx-2 py-2 md:w-48 flex flex-col place-items-end">
              <span class="font-bold md:text-xl">8 800 332 65-66</span>
              <span class="font-semibold text-sm text-gray-400">Support 24/7</span>
            </div>
            <Link :href="route('login')"
              class="hidden lg:inline-flex hover:bg-orange-200 focus:ring-4 focus:ring-gray-300 text-gray-800 dark:text-white hover:text-yellow-700 font-medium rounded-lg px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
            <UserIcon class="w-6 h-6" />
            </Link>
            <Link :href="route('frontend.cart.index')"
              class="relative hidden lg:inline-flex hover:bg-orange-200 focus:ring-4 focus:ring-gray-300 text-gray-800 dark:text-white hover:text-yellow-700 font-medium rounded-lg px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
              <CartIcon class="w-6 h-6" />
              <div
                class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-yellow-600 border-2 border-white rounded-full -top-2 right-2 dark:border-gray-900">
                {{ cartStore.cart.length }}
              </div>
            </Link>
          </div>
          <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
            <ul class="flex flex-col mt-4 font-semibold lg:flex-row lg:space-x-8 lg:mt-0">
              <li>
                <NavLink :href="route('home')" :active="route().current('home')">
                  Home
                </NavLink>
              </li>
              <li>
                <NavLink :href="route('frontend.categories')"
                  :active="route().current('frontend.categories') || route().current('frontend.category.index')">
                  Categories
                </NavLink>
              </li>
              <li>
                <NavLink :href="route('frontend.menus')"
                  :active="route().current('frontend.menus') || route().current('frontend.menu.index')">
                  Menus
                </NavLink>
              </li>
              <li>
                <NavLink :href="route('frontend.faq')" :active="route().current('frontend.faq')">
                  FAQ
                </NavLink>
              </li>
              <li>
                <NavLink :href="route('frontend.contact.index')" :active="route().current('frontend.contact.index')">
                  Contact
                </NavLink>
              </li>
            </ul>
          </div>
        </div>

        <MobileNavBar />

      </nav>
    </header>

    <!-- Main -->
    <main class="h-auto">

      <slot />
      <Footer />
    </main>

    <Alert />
  </div>
</template>

<script setup>
import Alert from '@/Components/Alert.vue';
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import UserIcon from '@/Components/Icons/UserIcon.vue';
import CartIcon from '@/Components/Icons/CartIcon.vue';
import Footer from '@/Components/Frontend/Footer.vue';
import { Link } from '@inertiajs/vue3';
import NavLink from '@/Components/Frontend/NavLink.vue';


import Logo from '@/Components/Frontend/Svg/Logo.vue';
import MobileNavBar from '@/Components/Frontend/MobileNavBar.vue';

import { useCartStore } from '@/Store/cart';
import { storeToRefs } from 'pinia';

const cartStore = useCartStore();
const { cart } = storeToRefs(cartStore);

onMounted(() => {
  initFlowbite();
});

</script>

<style lang="scss" scoped></style>