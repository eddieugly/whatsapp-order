<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import SubMenuArrow from './Icons/SubMenuArrow.vue';
import Roles from './Icons/Roles.vue';
import Permissions from './Icons/Permissions.vue';
import Users from './Icons/Users.vue';
import Category from './Icons/Category.vue';


const props = defineProps({

    bactive: {
        type: Boolean,
    },
    label: {
        type: String,
    },
    areaExpand: {
        type: Boolean,
    },
});

const dropId = "dropdown-sales-" + parseInt(Math.random() * 10000000).toString();

const classes = computed(() =>
    props.bactive
        ? 'flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group bg-gray-100 dark:text-white dark:bg-gray-700'
        : 'flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700'
);
</script>

<template>
    <button type="button" :class="classes" :aria-controls="dropId" :data-collapse-toggle="dropId" :aria-expanded="areaExpand">
        <slot name="menuIcon" />
        
        <span class="flex-1 ml-3 text-left whitespace-nowrap">{{ label }}</span>
        <SubMenuArrow />
    </button>
    <ul :id="dropId" class="py-2 space-y-2" :class="areaExpand ? '' : 'hidden'">

        <slot />
    </ul>
</template>
