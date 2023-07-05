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
});

const classes = computed(() =>
    props.active
        ? 'flex items-center p-2 text-gray-900 rounded-lg dark:text-white group bg-gray-100 dark:bg-gray-700'
        : 'flex items-center p-2 text-gray-900 rounded-lg dark:text-white group hover:bg-gray-100 dark:hover:bg-gray-700'
);
</script>

<template>
    <Link :href="href" :class="classes">
    <slot />
    </Link>
</template>
