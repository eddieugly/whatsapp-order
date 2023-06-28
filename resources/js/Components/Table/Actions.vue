<script setup>

import { Link } from '@inertiajs/vue3';
import Edit from '@/Components/Icons/Edit.vue';
import Trash from '@/Components/Icons/Trash.vue';
import Action from '@/Components/Icons/Action.vue'
import { Dropdown, ListGroup, ListGroupItem } from 'flowbite-vue';

defineProps({
    editLink: {
        type: String,
        default: () => "",
    },
    showEdit: {
        type: Boolean,
        default: () => true,
    },
    showDelete: {
        type: Boolean,
        default: () => true,
    },
    showDelete: {
        type: Boolean,
        default: () => true,
    },
});
</script>

<template>
    <div class=" ">
        <dropdown placement="left" text="Actions">
            <template #trigger>
                <span>
                    <Action class="w-5 h-5" />
                </span>
            </template>
            <list-group>
                <Link v-if="showEdit" :href="editLink">
                <list-group-item>
                    <template #prefix>
                        <Edit class="w-4 h-4" />
                    </template>
                    Edit
                </list-group-item>
                </Link>
                <list-group-item class="text-red-700 hover:text-red-700" v-if="showDelete" @click="$emit('deleteClicked', $event)">
                    <template #prefix>
                        <Trash class="w-4 h-4 text-red-700" />
                    </template>
                    Delete
                </list-group-item>
            </list-group>
        </dropdown>
    </div>
</template>