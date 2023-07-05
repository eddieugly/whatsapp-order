<template>
    <Head :title="title" />

    <AuthenticatesLayout>
            <Card>
                <SearchAddButton v-model="filters" :can-create="can.create" :href="route(`admin.${routeResourceName}.create`)" >
                    Add {{ title }}
                </SearchAddButton>

                <Table :headers="headers" :items="items">
                    <template v-slot="{ item }">
                        <Td class="flex items-center whitespace-nowrap">
                            <img :src="item.thumbnail" alt="Category Thumbnail" class="w-auto h-8 mr-3">
                            {{ item.name }}
                        </Td>
                        <Td>
                            {{ item.price }}
                        </Td>
                        <Td>
                            <Badge type="purple">
                                {{ item.category.name }}
                            </Badge>
                        </Td>
                        <Td>
                            <Badge :type="item.status ? 'green' : 'red'">
                                {{ item.status ? 'Active' : 'InActive' }}
                            </Badge>
                        </Td>
                        <Td>
                            <Badge :type="item.featured ? 'green' : 'red'">
                                {{ item.featured ? 'Featured' : 'NotFeatured' }}
                            </Badge>
                        </Td>
                        <Td>
                            <Badge :type="item.slider ? 'green' : 'red'">
                                {{ item.slider ? 'OnSlider' : 'NotOnSlider' }}
                            </Badge>
                        </Td>
                        <Td class="">
                            <Actions @deleteClicked="showModal(item)"
                                :edit-link="route(`admin.${routeResourceName}.edit`, { id: item.id })" :show-delete="can.delete" :show-edit="can.edit" />
                        </Td>
                    </template>
                </Table>
            </Card>

        <Modal size="lg" v-if="isShowModal" @close="closeModal">
            <template #header>
                <div class="flex items-center text-lg">
                    Delete - {{ itemToDelete.name }}
                </div>
            </template>
            <template #body>
                <p class="text-base leading-relaxed text-red-500 dark:text-red-400">
                    Are You Sure You Want To Delete This - {{ itemToDelete.name }}?
                </p>
            </template>
            <template #footer>
                <div class="flex justify-between">
                    <Button @click="closeModal" color="light">Cancel</Button>
                    <Button @click="handleDeleteItem" color="red" :disabled="isDeleting">
                        <span v-if="isDeleting">Deleting..</span>
                        <span v-else>Delete</span>
                    </Button>
                </div>
            </template>
        </Modal>


    </AuthenticatesLayout>
</template>
<script setup>
import AuthenticatesLayout from '@/Layouts/AuthenticatesLayout.vue';
import { Head } from '@inertiajs/vue3';
import SearchAddButton from '@/Components/Table/SearchAddButton.vue';
import Section from '@/Components/Section.vue';
import Card from '@/Components/Card/Card.vue';
import Table from '@/Components/Table/Table.vue';
import Td from '@/Components/Table/Td.vue';
import Actions from '@/Components/Table/Actions.vue';
import { Modal, Button, Badge } from 'flowbite-vue';

import useDeleteItem from '@/Composables/useDeleteItem';
import useFilters from '@/Composables/useFilters'

const props = defineProps({
    routeResourceName: {
        type: String,
        required: true,
    },
    title: {
        type: String,
        required: true,
    },
    items: {
        type: Object,
        default: () => ({}),
    },
    headers: {
        type: Object,
        default: () => [],
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
    categories: Array,
    can: Object,
});

const {
    itemToDelete,
    isDeleting,
    isShowModal,
    closeModal,
    showModal,
    handleDeleteItem,
} = useDeleteItem({
    routeResourceName: props.routeResourceName,
});

const { filters } = useFilters({
    filters: props.filters,
    routeResourceName: props.routeResourceName,
});
</script>