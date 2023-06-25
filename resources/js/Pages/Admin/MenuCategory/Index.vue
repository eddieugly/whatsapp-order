<template>
    <Head :title="title" />

    <AuthenticatesLayout>
        <Section>
            <Card>
                <SearchAddButton :href="route(`admin.${props.routeResourceName}.create`)"
                    :search-link="route(`admin.${props.routeResourceName}.index`)">
                    Add Category
                </SearchAddButton>

                <Table :headers="headers" :items="items">
                    <template v-slot="{ item }">
                        <Td>
                            {{ item.name }}
                        </Td>
                        <Td>
                            {{ item.description }}
                        </Td>
                        <Td>
                            {{ item.thumbnail }}
                        </Td>
                        <Td class="">
                            <Actions @deleteClicked="showModal(item)"
                                :edit-link="route(`admin.${props.routeResourceName}.edit`, { id: item.id })" />
                        </Td>
                    </template>
                </Table>
            </Card>
        </Section>

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
import { Modal, Button } from 'flowbite-vue';

import useDeleteItem from '@/Composables/useDeleteItem';

let props = defineProps({
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
</script>