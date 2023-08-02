<template>
  <footer class="p-4 bg-orange-100 pb-6 sm:p-6 dark:bg-gray-800">
    <div class="mx-auto max-w-screen-xl my-10">
        <div class="md:flex md:justify-between">
            <div class="mb-6 md:mb-0">
                <Link href="/" class="flex items-center">
                    <Logo class="" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">{{ $page.props.general.company_name }}</span>
                </Link>
            </div>
            <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Resources</h2>
                    <ul class="text-gray-600 dark:text-gray-400">
                        <li class="mb-4">
                            <Link :href="route('frontend.menus')" class="hover:underline">Menu</Link>
                        </li>
                        <li>
                            <Link :href="route('frontend.categories')" class="hover:underline">Categories</Link>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Follow us</h2>
                    <ul class="text-gray-600 dark:text-gray-400">
                        <li class="mb-4">
                            <a href="#" class="hover:underline ">Github</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">Discord</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Legal</h2>
                    <ul class="text-gray-600 dark:text-gray-400">
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <div class="sm:flex sm:items-center sm:justify-between">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2022 <Link href="/" class="hover:underline">{{ $page.props.general.company_name }}™</Link>. All Rights Reserved.
            </span>
            <div class="flex mt-4 space-x-6 sm:justify-center sm:mt-0">
                <Link :href="$page.props.general.facebook" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                    <FacebookFooterIcon />
                </Link>
                <Link :href="$page.props.general.instagram" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                    <InstagramFooterIcon />
                </Link>
                <Link :href="$page.props.general.twitter" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                    <TwitterFooterIcon />
                </Link>
            </div>
        </div>
    </div>
</footer>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Logo from './Svg/Logo.vue';
import FacebookFooterIcon from './Icon/FacebookFooterIcon.vue';
import InstagramFooterIcon from './Icon/InstagramFooterIcon.vue';
import TwitterFooterIcon from './Icon/TwitterFooterIcon.vue';


</script>

<style lang="scss" scoped></style>