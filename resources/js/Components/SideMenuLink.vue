<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
        default: false,
    },
    linkName: {
        type: String,
        required: true,
    },
});

const classes = computed(() =>
    props.active
        ? 'flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group bg-gray-100 dark:text-white dark:bg-gray-700'
        : 'flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700'
);
</script>

<template>
    <Link :href="href" :class="classes">
        {{ linkName }}
    </Link>
</template>
