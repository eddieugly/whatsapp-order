<template>
  <Section class="bg-white -mt-24 py-14 bg-[url('/assets/svg/hero-pattern.svg')] dark:bg-[url('/assets/svg/hero-pattern-dark.svg')]" >

    <div class="pt-14 px-4 mx-auto max-w-screen-xl text-center lg:pt-20 lg:px-12 z-10 relative">

      <Link :href="route('frontend.menus')" class="inline-flex justify-between items-center py-1 px-1 pr-4 mb-7 text-sm text-gray-700 bg-orange-100 rounded-full dark:bg-gray-800 dark:text-white hover:bg-orange-200 dark:hover:bg-gray-700" role="alert">
        <span class="text-xs bg-yellow-700 rounded-full text-white px-4 py-1.5 mr-3">New</span>
        <span class="text-sm font-medium text-yellow-700">Checkout our menu! See what's new</span>
        <HeroRightIcon class="text-yellow-700" />
      </Link>

      <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-blue-900 md:text-5xl lg:text-6xl dark:text-white">
        Fast Order & <span class="text-yellow-700">Quick Pick</span> Up
      </h1>

      <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">
        Here at {{ $page.props.general.company_name }}, we focus on making it easy for customers to order food online. Our
        meals are tasty and can be ready with a few clicks.
      </p>

      <div class="flex flex-col mb-8 lg:mb-16 space-y-4 sm:flex-row sm:justify-center sm:space-y-0 sm:space-x-4">

        <Link :href="route('frontend.faq')" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-yellow-700 hover:bg-blue-900 focus:ring-4 focus:ring-yellow-300 dark:focus:ring-yellow-900">
          About {{ $page.props.general.company_name }}
          <HeroLearnMoreIcon />
        </Link>

        <Link :href="route('frontend.menus')" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-yellow-900 rounded-lg border border-orange-300 hover:bg-orange-200 focus:ring-4 focus:ring-orange-300 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-yellow-800">
          <HeroCategoryIcon />
          Menu Categories
        </Link>

      </div>

      <HeroOrderProcess />
      
    </div>

    <div class="bg-gradient-to-b from-orange-50 to-transparent dark:from-orange-900 w-full h-full absolute top-0 left-0 z-0"></div>
    
  </Section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Section from './Section.vue';
import HeroRightIcon from './Icon/HeroRightIcon.vue';
import HeroLearnMoreIcon from './Icon/HeroLearnMoreIcon.vue';
import HeroCategoryIcon from './Icon/HeroCategoryIcon.vue';
import HeroOrderProcess from './HeroOrderProcess.vue';


</script>