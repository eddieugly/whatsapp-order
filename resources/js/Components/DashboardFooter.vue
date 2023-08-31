<template>
    <footer class="bg-white rounded-lg shadow sm:flex sm:items-center sm:justify-between p-4 sm:p-6 xl:p-8 dark:bg-gray-800 mt-5">
        <p class="mb-4 text-sm text-center text-gray-500 dark:text-gray-400 sm:mb-0">
            &copy; {{ new Date().getFullYear() }}
            <Link href="/" class="hover:underline">{{ $page.props.general.company_name }}</Link>. All rights reserved.
        </p>
    </footer>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';


</script>

<style lang="scss" scoped></style>