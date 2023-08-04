<template>
  <header>
    <nav class="bg-transparent border-gray-200 px-4 lg:px-6 py-4 dark:bg-gray-800">
      <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
        <Link href="/" class="flex items-center">
        <Logo class="" />
        <!-- Company Name -->
        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">
          {{ $page.props.general.company_name }}
        </span>
        </Link>
        <div class="flex items-center lg:order-2">
          <!-- Phone Number -->
          <div class="ml-auto mx-2 py-2 md:w-48 flex flex-col place-items-end">
            <span class="font-bold md:text-xl">{{ $page.props.general.company_phone }}</span>
            <span class="font-semibold text-sm text-gray-400">24/7 Support</span>
          </div>
          <!-- Login Link -->
          <Link :href="route('login')"
            class="hidden lg:inline-flex hover:bg-orange-200 focus:ring-4 focus:ring-gray-300 text-gray-800 dark:text-white hover:text-yellow-700 font-medium rounded-lg px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
          <UserIcon class="w-6 h-6" />
          </Link>
          <!-- Cart Link -->
          <Link :href="route('frontend.cart.index')"
            class="relative hidden lg:inline-flex hover:bg-orange-200 focus:ring-4 focus:ring-gray-300 text-gray-800 dark:text-white hover:text-yellow-700 font-medium rounded-lg px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
          <CartIcon class="w-6 h-6" />
          <div
            class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-yellow-600 border-2 border-white rounded-full -top-2 right-2 dark:border-gray-900">
            {{ cartStore.cart.length }}
          </div>
          </Link>
        </div>
        <!-- NavBar LG -->
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
      <!-- NavBar Mobile -->
      <MobileNavBar />

    </nav>
  </header>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Logo from './Svg/Logo.vue';
import UserIcon from '../Icons/UserIcon.vue';
import CartIcon from '../Icons/CartIcon.vue';
import NavLink from './NavLink.vue';
import MobileNavBar from './MobileNavBar.vue';

import { useCartStore } from '@/Store/cart';
import { storeToRefs } from 'pinia';

const cartStore = useCartStore();
const { cart } = storeToRefs(cartStore);


</script>