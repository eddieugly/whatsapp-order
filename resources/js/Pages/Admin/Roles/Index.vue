<template>
    <Head :title="title" />

    <AuthenticatesLayout>

        <Section>
            <Card>
                <SearchAddButton :href="route(`admin.${routeResourceName}.create`)"
                    :search-link="route(`admin.${routeResourceName}.index`)">
                    Add {{ title }}
                </SearchAddButton>

                <Table :headers="headers" :items="items">
                    <template v-slot="{ item }">
                        <Td>
                            {{ item.name }}
                        </Td>
                        <Td>
                            {{ item.created_at_formatted }}
                        </Td>
                        <Td class="flex items-center">
                            <Actions @deleteClicked="showModal(item)"
                                :edit-link="route(`admin.${routeResourceName}.edit`, { id: item.id })" />
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
                    Are You Sure You Want To Delete - {{ itemToDelete.name }}?
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
import Section from '@/Components/Section.vue';
import Card from '@/Components/Card/Card.vue'
import Table from '@/Components/Table/Table.vue';
import Td from '@/Components/Table/Td.vue';
import Actions from '@/Components/Table/Actions.vue';
import { Button, Modal } from 'flowbite-vue';
import SearchAddButton from '@/Components/Table/SearchAddButton.vue';

import useDeleteItem from '@/Composables/useDeleteItem';

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
        default: () => [],
    },
    headers: {
        type: Object,
        default: () => [],
    },
    can: {
        type: Boolean,
    }
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