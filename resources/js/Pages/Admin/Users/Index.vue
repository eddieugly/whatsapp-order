<template>
    <Head :title="title" />

    <AuthenticatesLayout>
        <Card>

            

            <Filters  v-model="filters" :roles="roles" :href="route(`admin.${routeResourceName}.create`)" :can-create="can.create">
                Add {{ title }}
            </Filters>

            <Table :headers="headers" :items="items">
                <template v-slot="{ item }">
                    <Td>
                        {{ item.name }}
                    </Td>
                    <Td>
                        {{ item.email }}
                    </Td>
                    <Td>
                        <Badge v-for="role in item.roles" :key="role.id" type="green">
                            {{ role.name }}
                        </Badge>
                    </Td>
                    <Td>
                        {{ item.created_at_formatted }}
                    </Td>
                    <Td class="flex items-center">
                        <Actions v-if="can.edit || can.delete" @deleteClicked="showModal(item)"
                            :edit-link="route(`admin.${routeResourceName}.edit`, { id: item.id })" :show-delete="can.delete"
                            :show-edit="can.edit" />
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
import Card from '@/Components/Card/Card.vue'
import Table from '@/Components/Table/Table.vue';
import Td from '@/Components/Table/Td.vue';
import Actions from '@/Components/Table/Actions.vue';
import { Badge, Button, Modal } from 'flowbite-vue';
import Filters from './Filters.vue';

import useDeleteItem from '@/Composables/useDeleteItem';
import useFilters from '@/Composables/useFilters';

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
    roles: Array,
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